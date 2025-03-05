<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\CustomField;
use App\Models\InvoicePayment;
use App\Models\InvoiceProduct;
use App\Models\Mail\CustomerInvoiceSend;
use App\Models\Mail\InvoicePaymentCreate;
use App\Models\Mail\InvoiceSend;
use App\Models\Mail\PaymentReminder;
use App\Models\Milestone;
use App\Models\Products;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\Utility;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\Models\Pos;
use App\Models\PosPart;
use App\Models\Parts;
use App\Models\Vendor;
use App\Models\User;

use Auth;

class PosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['invoice']]);
    }


    public function index(Request $request)
    {

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        if (Auth::user()->user_type == 'company') {
            $pos = DB::table('pos')
                ->join('users', 'pos.user_id', '=', 'users.id')
                ->join('vendors', 'pos.vendor_id', '=', 'vendors.id')
                ->select(DB::raw('pos.*, users.name as user_name, vendors.name as vendor_name'))
                ->where(['pos.location_id' => $objUser->current_location, 'pos.is_active' => 1])
                ->get();

            $invoices = Pos::get();
            return view('pos.index', compact('pos'));
        } else {
            $pos = DB::table('pos')
                ->join('users', 'pos.user_id', '=', 'users.id')
                ->join('vendors', 'pos.vendor_id', '=', 'vendors.id')
                ->select(DB::raw('pos.*, users.name as user_name, vendors.name as vendor_name'))
                ->where(['pos.location_id' => $objUser->location_id, 'pos.is_active' => 1])
                ->get();
            $invoices = Pos::get();
            return view('pos.index', compact('pos'));
        }
    }


    public function create(Request $request)
    {

        $partsid = $request->partsid;
        $wo_id = $request->wo_id;
        $vendor_id = $request->vendor_id;
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();

        if ($vendor_id) {
            $Vendor = Vendor::where('id', $vendor_id)->get()->pluck('name', 'id');
        } else {
            $Vendor = Vendor::get()->where('company_id',$Company_ID)->pluck('name', 'id');
        }


        $Parts = Parts::get()->where('company_id',$Company_ID)->pluck('name', 'id');
        $User = User::where('user_type', 'employee')->where('company_id',$Company_ID)->get()->pluck('name', 'id');

        $invoice_number = 1;
        $customerId = 1;



        return view('pos.create', compact('Parts', 'User', 'Vendor', 'invoice_number', 'customerId', 'partsid', 'wo_id','vendor_id'));
    }


    public function customer(Request $request)
    {

        $customer = Customer::where('id', '=', $request->id)->first();

        return view('pos.customer_detail', compact('customer'));
    }


    public function product(Request $request)
    {

        $data['unit']        = 10;
        $data['taxRate']     = 10;
        $data['taxes']       = 10;
        $salePrice           = 10;
        $quantity            = 1;
        $taxPrice            = (10 / 100) * ($salePrice * $quantity);
        $data['totalAmount'] = 200;

        return json_encode($data);
    }


    public function store(Request $request)
    {

        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();


        $validator = \Validator::make(
            $request->all(),
            [
                'vendor_id' => 'required',
                'user_id' => 'required',
                'pos_date' => 'required',
                'delivery_date' => 'required',
                'items' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $Pos                = new Pos();

        if ($request->partsid) {
            $Pos->parts_id  = $request->partsid;
        }
        if ($request->wo_id) {
            $Pos->wo_id         = $request->wo_id;
        }

        $Pos->vendor_id     = $request->vendor_id;
        $Pos->user_id       = $request->user_id;
        $Pos->budgets_id    = $request->budgets_id;
        $Pos->pos_date      = $request->pos_date;
        $Pos->delivery_date = $request->delivery_date;
        $Pos->location_id   = $currentlocation;
        $Pos->created_by    = $Company_ID;
        $Pos->company_id    = $currentlocation;
        $Pos->save();
        $products = $request->items;

        for ($i = 0; $i < count($products); $i++) {
            $PosProduct              = new PosPart();
            $PosProduct->pos_id      = $Pos->id;
            $PosProduct->parts_id    = $products[$i]['item'];
            $PosProduct->description = $products[$i]['description'];
            $PosProduct->quantity    = $products[$i]['quantity'];
            $PosProduct->price       = $products[$i]['price'];
            $PosProduct->tax         = $products[$i]['tax'];
            $PosProduct->discount    = isset($products[$i]['discount']) ? $products[$i]['discount'] : 0;
            $PosProduct->shipping    = $products[$i]['shipping'];
            $PosProduct->location_id = $currentlocation;
            $PosProduct->created_by  = $Company_ID;
            $PosProduct->company_id  = $currentlocation;
            $PosProduct->save();
        }

        if ($request->partsid) {
            return redirect()->route('parts.show', $request->partsid)->with(['success' => __('POs successfully created.'), 'tab-status' => 'pos']);
        } 
        elseif($request->wo_id)
        {
            return redirect()->route('opentask.show', $request->wo_id)->with(['success' => __('POs successfully created.'), 'tab-status' => 'pos']);
        }
        elseif($request->vendorid)
        {   
            return redirect()->route('vendors.show',$request->vendorid)->with(['success'=>__('PO successfully created.'),'tab-status'=>'pos']);
        }else {
            return redirect()->back()->with(['success' => __('POs successfully created.')]);
        }
    }


    public function edit($ids)
    {
        $id      = Crypt::decrypt($ids);
        $parts = Parts::get()->pluck('name', 'id');
        $vendor = Vendor::get()->pluck('name', 'id');
        $user = User::where('user_type', 'employee')->get()->pluck('name', 'id');

        $invoice_number = 1;
        $customerId = 1;

        $invoice = Pos::find($id);
        $product_services = PosPart::where('pos_id', $id)->get();
        // dd($invoice->items);

        return view('pos.edit', compact('parts', 'user', 'vendor', 'invoice_number', 'customerId', 'invoice', 'product_services'));
    }


    public function update(Request $request, $id)
    {
        $objUser            = Auth::user();
        $Company_ID = $objUser->Company_ID();
        $currentlocation = User::userCurrentLocation();

        $validator = \Validator::make(
            $request->all(),
            [
                'vendor_id' => 'required',
                'user_id' => 'required',
                'pos_date' => 'required',
                'delivery_date' => 'required',
                'items' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->route('pos.index')->with('error', $messages->first());
        }

        $Pos                = Pos::find($id);
        $Pos->vendor_id     = $request->vendor_id;
        $Pos->user_id       = $request->user_id;
        $Pos->budgets_id    = $request->budgets_id;
        $Pos->pos_date      = $request->pos_date;
        $Pos->delivery_date = $request->delivery_date;
        $Pos->location_id   = $currentlocation;
        $Pos->created_by    = $Company_ID;
        $Pos->company_id    = $currentlocation;
        $Pos->save();

        $products = $request->items;

        for ($i = 0; $i < count($products); $i++) {
            $PosProduct = PosPart::find($products[$i]['id']);

            if ($PosProduct == null) {
                $PosProduct             = new PosPart();
                $PosProduct->pos_id = $Pos->id;
            }

            if (isset($products[$i]['item'])) {
                $PosProduct->parts_id = $products[$i]['item'];
            }

            $PosProduct->description = $products[$i]['description'];
            $PosProduct->quantity    = $products[$i]['quantity'];
            $PosProduct->price       = $products[$i]['price'];
            $PosProduct->tax         = $products[$i]['tax'];
            $PosProduct->discount    = isset($products[$i]['discount']) ? $products[$i]['discount'] : 0;
            $PosProduct->shipping    = $products[$i]['shipping'];
            $PosProduct->location_id = $currentlocation;
            $PosProduct->created_by  = $Company_ID;
            $PosProduct->company_id  = $currentlocation;
            $PosProduct->save();
        }

        return redirect()->back()->with(['success' => __('POs successfully updated.'), 'tab-status' => 'pos']);
    }


    function invoiceNumber()
    {
        $latest = Pos::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if (!$latest) {
            return 1;
        }

        return $latest->invoice_id + 1;
    }


    public function show($ids)
    {

        if (\Auth::user()->can('show invoice')) {
            $id      = Crypt::decrypt($ids);
            $invoice = Invoice::find($id);
            if ($invoice->created_by == \Auth::user()->creatorId()) {
                $invoicePayment = InvoicePayment::where('invoice_id', $invoice->id)->first();

                $customer = $invoice->customer;
                $iteams   = $invoice->items;

                $invoice->customField = CustomField::getData($invoice, 'invoice');
                $customFields         = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'invoice')->get();


                return view('pos.view', compact('invoice', 'customer', 'iteams', 'invoicePayment', 'customFields'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Request $request, $id)
    {
        $pos = Pos::find($id);

        if ($pos) {
            if (\Auth::user()->type == 'super admin') {
                $pos->delete();
            } else {
                $pos_parts = PosPart::where('pos_id', $id)->delete();
                $pos->delete();
            }
            return redirect()->back()->with(['success' => __('POs successfully deleted .'), 'tab-status' => 'pos']);
        } else {
            return redirect()->back()->with(['error' => __('Something is wrong.'), 'tab-status' => 'pos']);
        }
    }


    public function productDestroy(Request $request)
    {

        if (\Auth::user()->can('delete invoice product')) {
            InvoiceProduct::where('id', '=', $request->id)->delete();

            return redirect()->back()->with('success', __('Bill Product successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function customerInvoice(Request $request)
    {

        if (\Auth::user()->can('manage customer invoice')) {

            $status = Invoice::$statues;

            $query = Invoice::where('customer_id', '=', \Auth::user()->id)->where('status', '!=', '0')->where('created_by', \Auth::user()->creatorId());

            if (!empty($request->issue_date)) {
                $date_range = explode(' - ', $request->issue_date);
                $query->whereBetween('issue_date', $date_range);
            }

            if (!empty($request->status)) {
                $query->where('status', '=', $request->status);
            }
            $invoices = $query->get();

            return view('pos.index', compact('invoices', 'status'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function customerInvoiceShow($id)
    {

        if (\Auth::user()->can('show invoice')) {
            $invoice_id = Crypt::decrypt($id);
            $invoice    = Invoice::where('id', $invoice_id)->first();
            if ($invoice->created_by == \Auth::user()->creatorId()) {
                $customer = $invoice->customer;
                $iteams   = $invoice->items;
                $company_payment_setting = Utility::getCompanyPaymentSetting();

                return view('pos.view', compact('invoice', 'customer', 'iteams', 'company_payment_setting'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function sent($id)
    {

        if (\Auth::user()->can('send invoice')) {
            $invoice            = Invoice::where('id', $id)->first();
            $invoice->send_date = date('Y-m-d');
            $invoice->status    = 1;
            $invoice->save();

            $customer         = Customer::where('id', $invoice->customer_id)->first();
            $invoice->name    = !empty($customer) ? $customer->name : '';
            $invoice->invoice = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

            $invoiceId    = Crypt::encrypt($invoice->id);
            $invoice->url = route('pos.pdf', $invoiceId);

            Utility::userBalance('customer', $customer->id, $invoice->getTotal(), 'credit');

            try {
                Mail::to($customer->email)->send(new InvoiceSend($invoice));
            } catch (\Exception $e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            return redirect()->back()->with('success', __('Invoice successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function resent($id)
    {

        if (\Auth::user()->can('send invoice')) {
            $invoice = Invoice::where('id', $id)->first();

            $customer         = Customer::where('id', $invoice->customer_id)->first();
            $invoice->name    = !empty($customer) ? $customer->name : '';
            $invoice->invoice = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

            $invoiceId    = Crypt::encrypt($invoice->id);
            $invoice->url = route('pos.pdf', $invoiceId);

            try {
                Mail::to($customer->email)->send(new InvoiceSend($invoice));
            } catch (\Exception $e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            return redirect()->back()->with('success', __('Invoice successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function payment($invoice_id)
    {

        if (\Auth::user()->can('create payment invoice')) {
            $invoice = Invoice::where('id', $invoice_id)->first();

            $customers  = Customer::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $categories = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('pos.payment', compact('customers', 'categories', 'accounts', 'invoice'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function createPayment(Request $request, $invoice_id)
    {


        if (\Auth::user()->can('create payment invoice')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'date' => 'required',
                    'amount' => 'required',
                    'account_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $invoicePayment                 = new InvoicePayment();
            $invoicePayment->invoice_id     = $invoice_id;
            $invoicePayment->date           = $request->date;
            $invoicePayment->amount         = $request->amount;
            $invoicePayment->account_id     = $request->account_id;
            $invoicePayment->payment_method = 0;
            $invoicePayment->reference      = $request->reference;
            $invoicePayment->description    = $request->description;
            $invoicePayment->save();

            $invoice = Invoice::where('id', $invoice_id)->first();
            $due     = $invoice->getDue();
            $total   = $invoice->getTotal();
            if ($invoice->status == 0) {
                $invoice->send_date = date('Y-m-d');
                $invoice->save();
            }

            if ($due <= 0) {
                $invoice->status = 4;
                $invoice->save();
            } else {
                $invoice->status = 3;
                $invoice->save();
            }
            $invoicePayment->user_id    = $invoice->customer_id;
            $invoicePayment->user_type  = 'Customer';
            $invoicePayment->type       = 'Partial';
            $invoicePayment->created_by = \Auth::user()->id;
            $invoicePayment->payment_id = $invoicePayment->id;
            $invoicePayment->category   = 'Invoice';
            $invoicePayment->account    = $request->account_id;

            Transaction::addTransaction($invoicePayment);

            $customer = Customer::where('id', $invoice->customer_id)->first();

            $payment            = new InvoicePayment();
            $payment->name      = $customer['name'];
            $payment->date      = \Auth::user()->dateFormat($request->date);
            $payment->amount    = \Auth::user()->priceFormat($request->amount);
            $payment->invoice   = 'invoice ' . \Auth::user()->invoiceNumberFormat($invoice->invoice_id);
            $payment->dueAmount = \Auth::user()->priceFormat($invoice->getDue());

            Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

            Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

            try {
                Mail::to($customer['email'])->send(new InvoicePaymentCreate($payment));
            } catch (\Exception $e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            return redirect()->back()->with('success', __('Payment successfully added.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        }
    }


    public function paymentDestroy(Request $request, $invoice_id, $payment_id)
    {

        if (\Auth::user()->can('delete payment invoice')) {
            $payment = InvoicePayment::find($payment_id);

            InvoicePayment::where('id', '=', $payment_id)->delete();

            $invoice = Invoice::where('id', $invoice_id)->first();
            $due     = $invoice->getDue();
            $total   = $invoice->getTotal();

            if ($due > 0 && $total != $due) {
                $invoice->status = 3;
            } else {
                $invoice->status = 2;
            }

            $invoice->save();
            $type = 'Partial';
            $user = 'Customer';
            Transaction::destroyTransaction($payment_id, $type, $user);

            Utility::userBalance('customer', $invoice->customer_id, $payment->amount, 'credit');

            Utility::bankAccountBalance($payment->account_id, $payment->amount, 'debit');

            return redirect()->back()->with('success', __('Payment successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function paymentReminder($invoice_id)
    {

        $invoice            = Invoice::find($invoice_id);
        $customer           = Customer::where('id', $invoice->customer_id)->first();
        $invoice->dueAmount = \Auth::user()->priceFormat($invoice->getDue());
        $invoice->name      = $customer['name'];
        $invoice->date      = \Auth::user()->dateFormat($invoice->send_date);
        $invoice->invoice   = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

        try {
            Mail::to($customer['email'])->send(new PaymentReminder($invoice));
        } catch (\Exception $e) {
            $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
        }

        return redirect()->back()->with('success', __('Payment reminder successfully send.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }


    public function customerInvoiceSend($invoice_id)
    {

        return view('customer.invoice_send', compact('invoice_id'));
    }


    public function customerInvoiceSendMail(Request $request, $invoice_id)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $email   = $request->email;
        $invoice = Invoice::where('id', $invoice_id)->first();

        $customer         = Customer::where('id', $invoice->customer_id)->first();
        $invoice->name    = !empty($customer) ? $customer->name : '';
        $invoice->invoice = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

        $invoiceId    = Crypt::encrypt($invoice->id);
        $invoice->url = route('pos.pdf', $invoiceId);

        try {
            Mail::to($email)->send(new CustomerInvoiceSend($invoice));
        } catch (\Exception $e) {
            $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
        }

        return redirect()->back()->with('success', __('Invoice successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }


    public function shippingDisplay(Request $request, $id)
    {

        $invoice = Invoice::find($id);

        if ($request->is_display == 'true') {
            $invoice->shipping_display = 1;
        } else {
            $invoice->shipping_display = 0;
        }
        $invoice->save();

        return redirect()->back()->with('success', __('Shipping address status successfully changed.'));
    }


    public function duplicate($invoice_id)
    {

        if (\Auth::user()->can('duplicate invoice')) {
            $invoice                            = Invoice::where('id', $invoice_id)->first();
            $duplicateInvoice                   = new Invoice();
            $duplicateInvoice->invoice_id       = $this->invoiceNumber();
            $duplicateInvoice->customer_id      = $invoice['customer_id'];
            $duplicateInvoice->issue_date       = date('Y-m-d');
            $duplicateInvoice->due_date         = $invoice['due_date'];
            $duplicateInvoice->send_date        = null;
            $duplicateInvoice->category_id      = $invoice['category_id'];
            $duplicateInvoice->ref_number       = $invoice['ref_number'];
            $duplicateInvoice->status           = 0;
            $duplicateInvoice->shipping_display = $invoice['shipping_display'];
            $duplicateInvoice->created_by       = $invoice['created_by'];
            $duplicateInvoice->save();

            if ($duplicateInvoice) {
                $invoiceProduct = InvoiceProduct::where('invoice_id', $invoice_id)->get();
                foreach ($invoiceProduct as $product) {
                    $duplicateProduct             = new InvoiceProduct();
                    $duplicateProduct->invoice_id = $duplicateInvoice->id;
                    $duplicateProduct->product_id = $product->product_id;
                    $duplicateProduct->quantity   = $product->quantity;
                    $duplicateProduct->tax        = $product->tax;
                    $duplicateProduct->discount   = $product->discount;
                    $duplicateProduct->price      = $product->price;
                    $duplicateProduct->save();
                }
            }

            return redirect()->back()->with('success', __('Invoice duplicate successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function previewInvoice($template, $color)
    {

        $objUser  = \Auth::user();
        $settings = Utility::settings();
        $invoice  = new Invoice();

        $customer                   = new \stdClass();
        $customer->email            = '<Email>';
        $customer->shipping_name    = '<Customer Name>';
        $customer->shipping_country = '<Country>';
        $customer->shipping_state   = '<State>';
        $customer->shipping_city    = '<City>';
        $customer->shipping_phone   = '<Customer Phone Number>';
        $customer->shipping_zip     = '<Zip>';
        $customer->shipping_address = '<Address>';
        $customer->billing_name     = '<Customer Name>';
        $customer->billing_country  = '<Country>';
        $customer->billing_state    = '<State>';
        $customer->billing_city     = '<City>';
        $customer->billing_phone    = '<Customer Phone Number>';
        $customer->billing_zip      = '<Zip>';
        $customer->billing_address  = '<Address>';

        $totalTaxPrice = 0;
        $taxesData     = [];

        $items = [];
        for ($i = 1; $i <= 3; $i++) {
            $item           = new \stdClass();
            $item->name     = 'Item ' . $i;
            $item->quantity = 1;
            $item->tax      = 5;
            $item->discount = 50;
            $item->price    = 100;

            $taxes = [
                'Tax 1',
                'Tax 2',
            ];

            $itemTaxes = [];
            foreach ($taxes as $k => $tax) {
                $taxPrice         = 10;
                $totalTaxPrice    += $taxPrice;
                $itemTax['name']  = 'Tax ' . $k;
                $itemTax['rate']  = '10 %';
                $itemTax['price'] = '$10';
                $itemTaxes[]      = $itemTax;
                if (array_key_exists('Tax ' . $k, $taxesData)) {
                    $taxesData['Tax ' . $k] = $taxesData['Tax 1'] + $taxPrice;
                } else {
                    $taxesData['Tax ' . $k] = $taxPrice;
                }
            }
            $item->itemTax = $itemTaxes;
            $items[]       = $item;
        }

        $invoice->invoice_id = 1;
        $invoice->issue_date = date('Y-m-d H:i:s');
        $invoice->due_date   = date('Y-m-d H:i:s');
        $invoice->itemData   = $items;

        $invoice->totalTaxPrice = 60;
        $invoice->totalQuantity = 3;
        $invoice->totalRate     = 300;
        $invoice->totalDiscount = 10;
        $invoice->taxesData     = $taxesData;
        $invoice->customField   = [];
        $customFields           = [];

        $preview    = 1;
        $color      = '#' . $color;
        $font_color = Utility::getFontColor($color);

        $logo         = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        return view('pos.templates.' . $template, compact('invoice', 'preview', 'color', 'img', 'settings', 'customer', 'font_color', 'customFields'));
    }


    public function invoice($invoice_id)
    {

        $settings = Utility::settings();

        $invoiceId = Crypt::decrypt($invoice_id);
        $invoice   = Invoice::where('id', $invoiceId)->first();

        $data  = DB::table('settings');
        $data  = $data->where('created_by', '=', $invoice->created_by);
        $data1 = $data->get();

        foreach ($data1 as $row) {
            $settings[$row->name] = $row->value;
        }

        $customer      = $invoice->customer;
        $items         = [];
        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        foreach ($invoice->items as $product) {
            $item              = new \stdClass();
            $item->name        = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity    = $product->quantity;
            $item->tax         = $product->tax;
            $item->discount    = $product->discount;
            $item->price       = $product->price;
            $item->description = $product->description;

            $totalQuantity += $item->quantity;
            $totalRate     += $item->price;
            $totalDiscount += $item->discount;

            $taxes = Utility::tax($product->tax);

            $itemTaxes = [];
            if (!empty($item->tax)) {
                foreach ($taxes as $tax) {
                    $taxPrice      = Utility::taxRate($tax->rate, $item->price, $item->quantity);
                    $totalTaxPrice += $taxPrice;

                    $itemTax['name']  = $tax->name;
                    $itemTax['rate']  = $tax->rate . '%';
                    $itemTax['price'] = Utility::priceFormat($settings, $taxPrice);
                    $itemTaxes[]      = $itemTax;


                    if (array_key_exists($tax->name, $taxesData)) {
                        $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                    } else {
                        $taxesData[$tax->name] = $taxPrice;
                    }
                }
                $item->itemTax = $itemTaxes;
            } else {
                $item->itemTax = [];
            }
            $items[] = $item;
        }

        $invoice->itemData      = $items;
        $invoice->totalTaxPrice = $totalTaxPrice;
        $invoice->totalQuantity = $totalQuantity;
        $invoice->totalRate     = $totalRate;
        $invoice->totalDiscount = $totalDiscount;
        $invoice->taxesData     = $taxesData;
        $invoice->customField   = CustomField::getData($invoice, 'invoice');
        $customFields           = [];
        if (!empty(\Auth::user())) {
            $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'invoice')->get();
        }


        //Set your logo
        $logo         = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        if ($invoice) {
            $color      = '#' . $settings['invoice_color'];
            $font_color = Utility::getFontColor($color);

            return view('pos.templates.' . $settings['invoice_template'], compact('invoice', 'color', 'settings', 'customer', 'img', 'font_color', 'customFields'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function saveTemplateSettings(Request $request)
    {

        $post = $request->all();
        unset($post['_token']);

        if (isset($post['invoice_template']) && (!isset($post['invoice_color']) || empty($post['invoice_color']))) {
            $post['invoice_color'] = "ffffff";
        }

        foreach ($post as $key => $data) {
            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                [
                    $data,
                    $key,
                    \Auth::user()->creatorId(),
                ]
            );
        }

        return redirect()->back()->with('success', __('Invoice Setting updated successfully'));
    }


    public function items(Request $request)
    {

        $items = PosPart::where('pos_id', $request->invoice_id)->where('parts_id', $request->product_id)->first();
        return json_encode($items);
    }


    public function get_parts(Request $request){

        $id = $request->vendor_id;
        $vander_parts = \DB::table('vendors')->find($id);
        $parts = \DB::table('parts')->whereIn('id',explode(',',$vander_parts->parts_id))->get();
        return response()->json(['parts' => $parts]);

    }
}
