<?php

namespace App\Http\Controllers;

use App\DataTables\FormsDataTable;
use App\Mail\FormSubmitEmail;
use App\Mail\Thanksmail;
use App\Models\Form;
use App\Models\FormValue;
use App\Models\Order;
use App\Models\UserForm;
use App\Rules\CommaSeparatedEmails;
use Exception;
use Illuminate\Http\Request;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Stripe\Charge;
use Stripe\Stripe as StripeStripe;

use Mail;

class FormController extends Controller
{
    public function index(FormsDataTable $dataTable)
    {
        if (\Auth::user()->can('manage-form')) {
            return $dataTable->render('form.index');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('create-form')) {
            $roles = Role::pluck('name', 'id');
            return view('form.create', compact('roles'));
        } else {
            return response()->json(['failed' => __('Permission Denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create-form')) {
            $rules = [
                'title' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $request->validate([
                'email' => ['nullable', new CommaSeparatedEmails],
            ]);
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('failed', $messages->first());
            }
            $filename = '';
            if (request()->file('form_logo')) {
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $file = $request->file('form_logo');
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = $file->store('form_logo');
                } else {
                    return redirect()->route('forms.index')->with('failed', __('File type not valid'));
                }
            }
            if (isset($request->email) and !empty($request->email)) {
                $emails = implode(',', $request->email);
            }
            $form = Form::create([
                'title' => $request->title,
                'logo' => $filename,
                'email' => $emails,
                'json' => '',
                'html' => '',
                'success_msg' => $request->success_msg,
                'thanks_msg' => $request->thanks_msg,
                'payment_status' => ($request->payment == 'on') ? '1' : '0',
                'amount' => $request->amount,
                'currency_symbol' => $request->currency_symbol,
                'currency_name' => $request->currency_name,
            ]);
            $form->assignFormRoles($request->roles);

            return redirect()->route('forms.index')->with('success', __('Form successfully created!'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function edit($id)
    {
        $usr = \Auth::user();
        $user_role = $usr->roles->first()->id;
        $formallowededit = UserForm::where('role_id', $user_role)->where('form_id', $id)->count();
        if (\Auth::user()->can('edit-form') && $usr->type == 'Admin') {
            $form = Form::find($id);
            $form_roles = $form->Roles->pluck('id')->toArray();
            $roles = Role::pluck('name', 'id');
            return view('form.edit', compact('form', 'form_roles', 'roles'));
        } else {
            if (\Auth::user()->can('edit-form') && $formallowededit > 0) {

                $form = Form::find($id);
                $form_roles = $form->Roles->pluck('id')->toArray();
                $roles = Role::pluck('name', 'id');
                return view('form.edit', compact('form', 'form_roles', 'roles'));
            } else {
                return redirect()->back()->with('failed', __('Permission Denied.'));
            }
        }
    }

    public function update(Request $request, Form $form)
    {
        if (\Auth::user()->can('edit-form')) {

            $rules = [
                'title' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $request->validate([
                'email' => ['nullable', new CommaSeparatedEmails],
            ]);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('failed', $messages->first());
            }
            $filename = $form->logo;
            $emails = $form->logo;
            if (request()->file('form_logo')) {
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $file = $request->file('form_logo');
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = $file->store('form_logo');
                } else {
                    return redirect()->route('forms.index')->with('failed', __('File type not valid'));
                }
            }

            if (isset($request->email) and !empty($request->email)) {
                $emails = implode(',', $request->email);
            }
            $form->title = $request->title;
            $form->success_msg = $request->success_msg;
            $form->thanks_msg = $request->thanks_msg;
            $form->logo = $filename;
            $form->email = $emails;
            $form->payment_status = ($request->payment == 'on') ? '1' : '0';
            $form->amount = $request->amount;
            $form->currency_symbol = $request->currency_symbol;
            $form->currency_name = $request->currency_name;
            $form->save();
            $form->assignFormRoles($request->roles);

            return redirect()->route('forms.index')->with('success', __('Form successfully updated!'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function destroy(Form $form)
    {
        if (\Auth::user()->can('delete-form')) {
            $form->delete();
            return redirect()->back()->with('success', __('Form successfully deleted!'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function design($id)
    {
        if (\Auth::user()->can('design-form')) {
            $form = Form::find('pms_id', $id);
            if ($form) {
                return view('form.design', compact('form'));
            } else {
                return redirect()->back()->with('failed', __('Form not found'));
            }
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function designUpdate(Request $request, $pms_id)
    {
        $json_data = json_decode($request->json);
        $all_json_data = [];
        foreach ($json_data as $key => $data) {
            $json = $data;
            if ($data->type == 'file') {
                $Form = Form::where('pms_id', $pms_id)->first();
                if (!(empty($Form))) {
                    $updated_name = $data->name . '-preview';
                    if (!empty($request->$updated_name) && !empty($data->name)) {
                        // if file added then existing json in file uploaded data add
                        $data->orijanal_name = $request->$updated_name->getClientOriginalName();
                        $data->extension = $request->$updated_name->extension();
                        $data->timestamp_name = time() . '_' . $data->orijanal_name;
                        $data->path = $request->$updated_name->storeAs('instruction', time() . '_' . $data->orijanal_name);
                        $json = $data;
                    } else {
                        //  if file not added then existing json get and replace
                        $json = json_decode($Form->json, true)[$key];
                    }
                }
            }
            $json_data[$key] =  $json;
        }
        $request_json['json'] = json_encode($json_data);
        $request->merge($request_json);

        if (Form::where('pms_id', $pms_id)->exists()) {

            $form['json'] = $request->json;
            $user['created_by'] = Auth::user()->creatorId();
            $user['company_id'] = Auth::user()->Company_ID();
            Form::where('pms_id', $pms_id)->update($form);
            return redirect()->back()->with(['success' => __('Form successfully updated!'), 'tab-status' => 'instraction']);
        } else {

            $user               = new Form();
            $user['pms_id']     = $pms_id;
            $user['json']       = $request->json;
            $user['created_by'] = Auth::user()->creatorId();
            $user['company_id'] = Auth::user()->Company_ID();
            $user->save();


            return redirect()->back()->with(['success' => __('Instraction form successfully Add'), 'tab-status' => 'instraction']);
        }
    }

    public function fill($id)
    {
        if (\Auth::user()->can('fill-form')) {
            $form = Form::find($id);
            $user = \Auth::user();
            $form_value = null;
            if ($form) {
                $array = $form->getFormArray();
                return view('form.fill', compact('form', 'form_value', 'array'));
            } else {
                return redirect()->back()->with('failed', __('Form not found'));
            }
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function publicFill($id)
    {
        $hashids = new Hashids('', 20);
        $id = $hashids->decodeHex($id);
        if ($id) {
            $form = Form::find($id);
            $form_value = null;
            if ($form) {
                $array = $form->getFormArray();
                return view('form.public_fill', compact('form', 'form_value', 'array'));
            } else {
                return redirect()->back()->with('failed', __('Form not found'));
            }
        } else {
            abort(404);
        }
    }

    public function fillStore(Request $request, $id)
    {
        if (setting('captcha') == 'hcaptcha') {
            if (empty($_POST['h-captcha-response'])) {
                if (isset($request->ajax)) {
                    return response()->json(['is_success' => false, 'message' => __('Please check Hcaptch')], 200);
                } else {
                    return redirect()->back()->with('failed', __('Please check Hcaptch'));
                }
            }
        }
        if (setting('captcha') == 'recaptcha') {
            if (empty($_POST['g-recaptcha-response'])) {
                if (isset($request->ajax)) {
                    return response()->json(['is_success' => false, 'message' => __('Please check Recaptch')], 200);
                } else {
                    return redirect()->back()->with('failed', __('Please check Recaptch'));
                }
            }
        }
        $form = Form::find($id);
        if ($form) {
            $questions = [];
            $client_emails = [];
            if ($request->form_value_id) {
                $form_value = FormValue::find($request->form_value_id);
                $array = json_decode($form_value->json);
            } else {
                $array = $form->getFormArray();
            }
            foreach ($array as &$row) {
                if ($row->type == 'checkbox-group') {
                    foreach ($row->values as &$value) {
                        if (is_array($request->{$row->name}) && in_array($value->value, $request->{$row->name})) {
                            $value->selected = 1;
                        } else {
                            if (isset($value->selected)) {
                                unset($value->selected);
                            }
                        }
                    }
                } elseif ($row->type == 'file') {
                    if (isset($row->multiple)) {

                        if ($request->hasFile($row->name)) {
                            $values = [];
                            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                            $files = $request->file($row->name);
                            foreach ($files as $file) {
                                $extension = $file->getClientOriginalExtension();
                                $check = in_array($extension, $allowedfileExtension);
                                if ($check) {
                                    $filename = $file->store('form_values/' . $form->id);
                                    $values[] = $filename;
                                } else {
                                    if (isset($request->ajax)) {
                                        return response()->json(['is_success' => false, 'message' => __('Invalid File type, Please upload jpeg, jpg, png files')], 200);
                                    } else {
                                        return redirect()->back()->with('failed', __('Invalid File type, Please upload jpeg, jpg, png files'));
                                    }
                                }
                            }
                            $row->value = $values;
                        }
                    } else {

                        if ($request->hasFile($row->name)) {
                            $values = '';
                            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                            $file = $request->file($row->name);
                            $extension = $file->getClientOriginalExtension();
                            $check = in_array($extension, $allowedfileExtension);
                            if ($check) {
                                $filename = $file->store('form_values/' . $form->id);
                                $values = $filename;
                            } else {
                                if (isset($request->ajax)) {
                                    return response()->json(['is_success' => false, 'message' => __('Invalid File type, Please upload jpeg, jpg, png files')], 200);
                                } else {
                                    return redirect()->back()->with('failed', __('Invalid File type, Please upload jpeg, jpg, png files'));
                                }
                            }
                            $row->value = $values;
                        }
                    }
                } elseif ($row->type == 'radio-group') {
                    foreach ($row->values as &$value) {
                        if ($value->value == $request->{$row->name}) {
                            $value->selected = 1;
                        } else {
                            if (isset($value->selected)) {
                                unset($value->selected);
                            }
                        }
                    }
                } elseif ($row->type == 'autocomplete') {
                    if (isset($row->multiple)) {
                        foreach ($row->values as &$value) {
                            if (is_array($request->{$row->name}) && in_array($value->value, $request->{$row->name})) {
                                $value->selected = 1;
                            } else {
                                if (isset($value->selected)) {
                                    unset($value->selected);
                                }
                            }
                        }
                    } else {


                        foreach ($row->values as &$value) {
                            if ($value->value == $request->{$row->name}) {
                                $value->selected = 1;
                            } else {
                                if (isset($value->selected)) {
                                    unset($value->selected);
                                }
                            }
                        }
                    }
                } elseif ($row->type == 'select') {
                    if (isset($row->multiple) & !empty($row->multiple)) {
                        foreach ($row->values as &$value) {

                            if (is_array($request->{$row->name}) && in_array($value->value, $request->{$row->name})) {
                                $value->selected = 1;
                            } else {
                                if (isset($value->selected)) {
                                    unset($value->selected);
                                }
                            }
                        }
                    } else {


                        foreach ($row->values as &$value) {
                            if ($value->value == $request->{$row->name}) {
                                $value->selected = 1;
                            } else {
                                if (isset($value->selected)) {
                                    unset($value->selected);
                                }
                            }
                        }
                    }
                } elseif ($row->type == 'date') {
                    $row->value = $request->{$row->name};
                } elseif ($row->type == 'number') {
                    $row->value = $request->{$row->name};
                } elseif ($row->type == 'textarea') {
                    $row->value = $request->{$row->name};
                } elseif ($row->type == 'text') {
                    $client_email = '';

                    if ($row->subtype == 'email') {
                        if (isset($row->is_client_email) && $row->is_client_email) {

                            $client_emails[] = $request->{$row->name};
                        }
                    }
                    $row->value = $request->{$row->name};
                } elseif ($row->type == 'starRating') {
                    $row->value = $request->{$row->name};
                }
            }

            if ($request->form_value_id) {
                $form_value->json = json_encode($array);
                $form_value->save();
            } else {
                if (\Auth::user()) {
                    $user_id = \Auth::user()->id;
                } else {
                    $user_id = NULL;
                }
                $data = [];
                if ($form->payment_status == 1) {
                    StripeStripe::setApiKey(setting('stripe_secret'));
                    try {
                        $charge = Charge::create([
                            "amount" => $form->amount * 100,
                            "currency" => $form->currency_name,
                            "source" => $request->stripeToken,
                            "description" => "Payment from " . config('app.name')
                        ]);
                    } catch (Exception $e) {
                        return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
                    }
                    if ($charge) {
                        $data['transaction_id'] = $charge->id;
                        $data['currency_symbol'] = $form->currency_symbol;
                        $data['currency_name'] = $form->currency_name;
                        $data['amount'] = $form->amount;
                    }
                }
                $data['form_id'] = $form->id;
                $data['user_id'] = $user_id;
                $data['json'] = json_encode($array);
                $form_value = FormValue::create($data);
            }


            $emails = explode(',', $form->email);
            try {
                Mail::to($emails)->send(new FormSubmitEmail($form_value));
            } catch (\Exception $e) {
            }
            foreach ($client_emails as $client_email) {
                try {
                    Mail::to($client_email)->send(new Thanksmail($form_value));
                } catch (\Exception $e) {
                }
            }
            $success_msg = strip_tags($form->success_msg);


            if (isset($request->ajax)) {
                return response()->json(['is_success' => true, 'message' => __($success_msg), 'redirect' => route('edit.form.values', $form_value->id)], 200);
            } else {
                return redirect()->back()->with('success', __($success_msg));
            }
        } else {
            if (isset($request->ajax)) {
                return response()->json(['is_success' => false, 'message' => __('Form not found')], 200);
            } else {
                return redirect()->back()->with('failed', __('Form not found'));
            }
        }
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $fileName = $request->upload->store('editor');

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = Storage::url($fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    public function duplicate(Request $request)
    {

        if (\Auth::user()->can('duplicate-form')) {
            $form = Form::find($request->form_id);
            if ($form) {

                $newform = Form::create([
                    'title' => $form->title . ' (copy)',
                    'logo' => $form->logo,
                    'email' => $form->email,
                    'success_msg' => $form->success_msg,
                    'thanks_msg' => $form->thanks_msg,
                    'json' => $form->json,
                    'html' => $form->html,
                    'is_active' => $form->is_active
                ]);


                return redirect()->back()->with('success', __('Form successfully duplicate!'));
            } else {
                return redirect()->back()->with('error', __('Form not found'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
    public function ckupload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);

            $msg = 'Image uploaded successfully';

            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
