<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractType;
use App\Models\User;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            [
                'auth',
                'XSS',
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Contracts'))
        {
            $contracts   = Contract::where('created_by', '=', \Auth::user()->ownerId())->get();
            $curr_month  = Contract::where('created_by', '=', \Auth::user()->ownerId())->whereMonth('start_date', '=', date('m'))->get();
            $curr_week   = Contract::where('created_by', '=', \Auth::user()->ownerId())->whereBetween(
                'start_date', [
                                \Carbon\Carbon::now()->startOfWeek(),
                                \Carbon\Carbon::now()->endOfWeek(),
                            ]
            )->get();
            $last_30days = Contract::where('created_by', '=', \Auth::user()->ownerId())->whereDate('start_date', '>', \Carbon\Carbon::now()->subDays(30))->get();

            // Contracts Summary
        $cnt_contract                = [];
            $cnt_contract['total']       = \App\Models\Contract::getContractSummary($contracts);
            $cnt_contract['this_month']  = \App\Models\Contract::getContractSummary($curr_month);
            $cnt_contract['this_week']   = \App\Models\Contract::getContractSummary($curr_week);
            $cnt_contract['last_30days'] = \App\Models\Contract::getContractSummary($last_30days);

            return view('contracts.index', compact('contracts', 'cnt_contract'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Contract'))
        {
            $client       = User::where('type', '=', 'Client')->get()->pluck('name', 'id');
            $contractType = ContractType::where('created_by', '=', \Auth::user()->ownerId())->get()->pluck('name', 'id');

            return view('contracts.create', compact('contractType', 'client'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Contract'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required|max:20',
                                   'subject' => 'required',
                                   'value' => 'required',
                                   'type' => 'required',
                                   'date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('contract.index')->with('error', $messages->first());
            }

            $date = explode(' to ', $request->date);

            $contract              = new Contract();
            $contract->name        = $request->name;
            $contract->client_name = $request->client_name;
            $contract->subject     = $request->subject;
            $contract->value       = $request->value;
            $contract->type        = $request->type;
            $contract->start_date  = $date[0];
            $contract->end_date    = $date[1];
            $contract->notes       = $request->notes;
            $contract->created_by  = \Auth::user()->ownerId();
            $contract->status      = $request->status;
            $contract->save();

            $settings  = \Utility::settings(\Auth::user()->ownerId());
              
            if(isset($settings['contract_notification']) && $settings['contract_notification'] ==1){
                $msg = ucfirst($request->name).' created by '.\Auth::user()->name.'.';
               
                \Utility::send_slack_msg($msg);    
            }
            if(isset($settings['telegram_contract_notification']) && $settings['telegram_contract_notification'] ==1){
                    $resp = ucfirst($request->name).' created by '.\Auth::user()->name.'.';
                    \Utility::send_telegram_msg($resp);    
                }

            return redirect()->route('contract.index')->with('success', __('Contract successfully created!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contract $contract
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        return redirect()->route('contracts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Contract $contract
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        if(\Auth::user()->can('Edit Contract'))
        {
            if($contract->created_by == \Auth::user()->ownerId())
            {
                $client       = User::where('type', '=', 'Client')->get()->pluck('name', 'id');
                $contractType = ContractType::where('created_by', '=', \Auth::user()->ownerId())->get()->pluck('name', 'id');
                $date         = $contract->start_date . ' to ' . $contract->end_date;
                unset($contract->start_date);
                unset($contract->end_date);
                $contract->setAttribute('date', $date);

                return view('contracts.edit', compact('contract', 'contractType', 'client'));
            }
            else
            {
                return response()->json(['error' => __('Permission Denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contract $contract
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        if(\Auth::user()->can('Edit Contract'))
        {
            if($contract->created_by == \Auth::user()->ownerId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required|max:20',
                                       'subject' => 'required',
                                       'value' => 'required',
                                       'type' => 'required',
                                       'date' => 'required',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('contract.index')->with('error', $messages->first());
                }

                $date = explode(' to ', $request->date);

                $contract->name        = $request->name;
                $contract->client_name = $request->client_name;
                $contract->subject     = $request->subject;
                $contract->value       = $request->value;
                $contract->type        = $request->type;
                $contract->start_date  = $date[0];
                $contract->end_date    = $date[1];
                $contract->notes       = $request->notes;
                $contract->status      = $request->status;
                $contract->save();

                return redirect()->route('contract.index')->with('success', __('Contract successfully updated!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contract $contract
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        if(\Auth::user()->can('Delete Contract'))
        {
            if($contract->created_by == \Auth::user()->ownerId())
            {
                $contract->delete();

                return redirect()->route('contract.index')->with('success', __('Contract successfully deleted!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
