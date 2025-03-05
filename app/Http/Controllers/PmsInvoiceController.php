<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PmsInvoice;
use App\Models\User;

use Auth;


class PmsInvoiceController extends Controller
{

    public function index()
    {
    }


    public function create(Request $request)
    {

        $pms_id = $request->pms_id;
        return view('pms.pmsinvoice_create', compact('pms_id'));
    }


    public function store(Request $request)
    {

        if (Auth::user()->can('create parts')) {
            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if ($currentlocation == 0) {
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            $valid = [
                'invoice_cost' => 'required',
            ];

            $validator = Validator::make($request->all(), $valid);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $attached_invoice = '';
            if ($request->hasFile('invoice')) {
                $attach_invoice = $request->file('invoice');
                $attached_invoice = md5(time()) . "_" . $attach_invoice->getClientOriginalName();
                $attach_invoice->storeAs('pms_invoice', $attached_invoice);
            }

            $pmsinvoice = PmsInvoice::create([
                'pms_id' => $request->pms_id,
                'invoice_cost' => $request->invoice_cost,
                'description' => $request->description,
                'invoice_file' => $attached_invoice,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if ($pmsinvoice) {
                return redirect()->back()->with('success', __('Invoice created successfully.'));
            } else {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }
    }


    public function show(AssetsField $assetsField)
    {
    }


    public function edit($id)
    {

        $pmsinvoice = PmsInvoice::find($id);
        return view('pms.pmsinvoice_edit', compact('pmsinvoice'));
    }


    public function update(Request $request, $id)
    {

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();
        if ($currentlocation == 0) {
            return redirect()->back()->with('error', __('Current location is not available.'));
        }

        $attached_invoice = '';
        if ($request->hasFile('invoice')) {
            // dd($request->all(),$id);

            $pms_invoice = PmsInvoice::find($id);
            $uploaded_invoice = storage_path('pms_invoice/' . $pms_invoice->invoice_file);
            if (file_exists($uploaded_invoice)) {
                unlink($uploaded_invoice);



                $attach_invoice = $request->file('invoice');
                $attached_invoice = md5(time()) . "_" . $attach_invoice->getClientOriginalName();
                $attach_invoice->storeAs('pms_invoice', $attached_invoice);
            }
            if (!empty($attached_invoice) && $request->hasFile('invoice') != "") {
                $pmsinvoice['invoice_file']     = $attached_invoice;
            }


            $pmsinvoice['pms_id']        = $request->pms_id;
            $pmsinvoice['invoice_cost']  = $request->invoice_cost;
            $pmsinvoice['description']   = $request->description;
            $pmsinvoice['location_id']   = $currentlocation;
            $pmsinvoice['created_by']    = $objUser->id;
            $pmsinvoice['company_id']    = $objUser->Company_ID();

            $pmsinvoices = PmsInvoice::where('id', $id)->update($pmsinvoice);

            return redirect()->back()->with('success', __('Invoice update successfully.'));
        }
    }
    public function destroy($id)
    {

        $pmsinvoice = PmsInvoice::find($id);
        if ($pmsinvoice) {
            if (\Auth::user()->type == 'super admin') {
                $pmsinvoice->delete();
            } else {
                $uploaded_invoice = storage_path('pms_invoice/' . $pmsinvoice->invoice_file);
                if (file_exists($uploaded_invoice)) {
                    unlink($uploaded_invoice);
                }
                $pmsinvoice->delete();
            }
            return redirect()->back()->with('success', __('Pms Invoice successfully deleted .'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }
}
