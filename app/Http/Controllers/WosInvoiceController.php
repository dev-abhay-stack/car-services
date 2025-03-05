<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\WosInvoice;
use App\Models\User;

use Auth;


class WosInvoiceController extends Controller
{
    public function create(Request $request){
        $wo_id = $request->wo_id; 
        return view('workorder.woinvoice_create', compact('wo_id'));
    }

    public function store(Request $request){

            $objUser            = Auth::user();
            $Company_ID = $objUser->Company_ID();
            $currentlocation = User::userCurrentLocation();
            if($currentlocation == 0){
                return redirect()->back()->with('error', __('Current location is not available.'));
            }
            
            $valid = [
                'invoice_cost' => 'required',
                'invoice'      => 'required|mimes:jpeg,jpg,svg,png,doc,docx,pdf'    
            ];

            $validator = Validator::make($request->all(), $valid);
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

             $attached_invoice = '';
            if($request->hasFile('invoice')){

                $attach_invoice = $request->file('invoice');
                $attached_invoice = md5(time()) . "_" . $attach_invoice->getClientOriginalName();
                
                $attach_invoice->storeAs('wos_invoice', $attached_invoice);
            }
            
            $wosinvoice = WosInvoice::create([
                'wo_id' => $request->wo_id,
                'invoice_cost' => $request->invoice_cost,
                'description' => $request->description,
                'invoice_file' => $attached_invoice,
                'location_id' => $currentlocation,
                'created_by' => $objUser->id,
                'company_id' => $objUser->Company_ID(),
            ]);

            if($wosinvoice){
                return redirect()->back()->with(['success'=> __('Invoice created successfully.'),'tab-status'=> 'invoice']);
            }

        }
           


    public function edit($id){
        $wosinvoice = WosInvoice::find($id);
        return view('workorder.woinvoice_edit', compact('wosinvoice'));
    }

    public function update(Request $request, $id){
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();
        if($currentlocation == 0){
            return redirect()->back()->with(['error'=> __('Current location is not available.'),'tab-status'=> 'invoice']);
        }

        $attached_invoice = '';
        if($request->hasFile('invoice')){
            $attach_invoice = $request->file('invoice');
            $attached_invoice = md5(time()) . "_" . $attach_invoice->getClientOriginalName();
            $attach_invoice->storeAs('wos_invoice', $attached_invoice);
        }
        if(!empty($attached_invoice) && $request->hasFile('invoice') != ""){
            $wosinvoice['invoice_file']     = $attached_invoice;
        }

             $wosinvoices               = WosInvoice::where('id', $id)->first();
             $wosinvoices->wo_id        = $wosinvoices->wo_id;
             $wosinvoices->invoice_cost = $request->invoice_cost;
             $wosinvoices->description  = $request->description;
             $wosinvoices->location_id  = $currentlocation;
             $wosinvoices->created_by   = $objUser->id;
             $wosinvoices->company_id   = $objUser->Company_ID();
             $wosinvoices->save();
           

             return redirect()->back()->with(['success'=> __('Invoice update successfully.'),'tab-status'=> 'invoice']);
           

    }

    public function destroy($id){
        $wosinvoice = WosInvoice::find($id);

        if($wosinvoice)
        {
            if(\Auth::user()->type == 'super admin')
            {
                $wosinvoice->delete();
            }
            else
            {
                if($wosinvoice->invoice_file)
                {
                    $d=\File::delete(storage_path('wos_invoice/'.$wosinvoice->invoice_file));
                    $wosinvoice->delete();
                }
                
            }
            return redirect()->back()->with(['success'=> __('Work order Invoice successfully deleted.'),'tab-status'=> 'invoice']);
        }
        else
        {
            return redirect()->back()->with(['error'=> __('Something is wrong.'),'tab-status'=> 'invoice']);
        }
    }
}
