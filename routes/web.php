<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\PmsController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\PmsLogTimeController;
use App\Http\Controllers\PmsInvoiceController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorLogTimeController;
use App\Http\Controllers\PartsLogTimeController;
use App\Http\Controllers\AssetsLogTimeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\VideoModelController;
use App\Http\Controllers\WosLogTimeController;
use App\Http\Controllers\WosInvoiceController;
use App\Http\Controllers\WosCommentController;
use App\Http\Controllers\WorkrequestController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanRequestController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\LandingPageSectionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PaystackPaymentController;
use App\Http\Controllers\FlutterwavePaymentController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\PaytmPaymentController;
use App\Http\Controllers\MercadoPaymentController;
use App\Http\Controllers\SkrillPaymentController;
use App\Http\Controllers\CoingatePaymentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormValueController;
use App\Http\Controllers\MolliePaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\LanguageController;

// use App\Models\Utility;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', [HomeController::class, 'landingPage']);
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['XSS', 'auth']);


//================================= Location route ===============================================//
Route::resource('location', LocationController::class)->middleware(['XSS', 'auth', 'CheckPlan']);
Route::get('/workrequest/{id}', [LocationController::class, 'work_request_portal'])->name('work_request.portal');
Route::get('/workrequest/QRCode/{id}', [LocationController::class, 'QRCode'])->name('work_request.QRCode');
Route::get('/change-location/{id}', [LocationController::class, 'changeCurrentLocation'])->name('change-location')->middleware(['XSS', 'auth']);

//================================= Role route ===================================================//
Route::resource('roles', RoleController::class)->middleware(['auth', 'XSS']);

//=================================user route ===============================================//
Route::resource('users', UserController::class)->middleware(['auth', 'CheckPlan', 'XSS']);

//================================= work order request route =============================//
Route::post('/workrequestsend', [WorkrequestController::class, 'store'])->name('work_request.sand');

//==================================== Assets route ====================================//
Route::resource('asset', AssetsController::class)->middleware(['auth', 'XSS']);
Route::resource('assetslogtime', AssetsLogTimeController::class)->middleware(['auth', 'XSS']);
Route::get('/assets/file/{fid}', [AssetsController::class, 'fileDownload'])->name('assets.file.download')->middleware(['auth', 'XSS']);
Route::delete('/assets/file/delete/{fid}', [AssetsController::class, 'fileDelete'])->name('assets.file.delete')->middleware(['auth', 'XSS']);
Route::post('/assets/{id}/file', [AssetsController::class, 'fileUpload'])->name('assets.file.upload')->middleware(['auth', 'XSS']);

//==================================================== Associate Vendor ============================================================//
Route::get('/vendors/associate/create/{module}/{id}', [VendorController::class, 'associateVendorsView'])->name('vendors.associate.create');
Route::post('/vendors/associate_remove/{module}/{id}', [VendorController::class, 'removeAssociateVendors'])->name('vendors.associate_remove');
Route::post('/vendors/associate/{module}/{id}', [VendorController::class, 'associateVendors'])->name('vendors.associate');


//==================================================== Associate Assets =====================================================//
Route::get('/assets/associate/create/{module}/{id}', [AssetsController::class, 'associateAssetsView'])->name('assets.associate.create');
Route::post('/assets/associate_remove/{module}/{id}', [AssetsController::class, 'removeAssociateAssets'])->name('assets.associate_remove');
Route::post('/assets/associate/{module}/{id}', [AssetsController::class, 'associateAssets'])->name('assets.associate');

//======================================================= Video =====================================================//
Route::resource('videos', VideoModelController::class)->middleware(['auth', 'XSS']);
// Route::get('vedios', [VedioModelController::class, 'index'])->name('videos.index')->middleware(['auth', 'XSS']);

//==================================================== PMs ==========================================================//
Route::resource('pms', PmsController::class)->middleware(['auth', 'XSS']);
Route::resource('pmslogtime', PmsLogTimeController::class)->middleware(['auth', 'XSS']);
Route::resource('pmsinvoice', PmsInvoiceController::class)->middleware(['auth', 'XSS']);
Route::get('pms/create/{id?}', [PmsController::class, 'create'])->name('pms.create')->middleware(['auth', 'XSS']);

//=================================================== Form Builder =====================================================//
Route::put('/forms/design/{id}', [FormController::class, 'designUpdate'])->name('forms.design.update')->middleware(['auth', 'XSS']);
Route::post('ckeditor/upload', [FormController::class, 'upload'])->name('ckeditor.upload');
Route::post('ckeditors/upload', [FormController::class, 'ckupload'])->name('ckeditors.upload')->middleware('auth');

//======================================================= Parts =====================================================//
Route::resource('parts', PartsController::class)->middleware(['auth', 'XSS']);
Route::resource('partslogtime', PartsLogTimeController::class)->middleware(['auth', 'XSS']);
Route::get('parts/create/{id?}', [PartsController::class, 'create'])->name('parts.create')->middleware(['auth', 'XSS']);


//============================================= work order route ===============================================//

Route::resource('opentask', WorkOrderController::class)->middleware(['auth', 'XSS',]);
Route::get('/opentask/complete/task', [WorkOrderController::class, 'completetask'])->name('opentask.complete.task')->middleware(['auth', 'XSS',]);
Route::get('/opentask/task/complete', [WorkOrderController::class, 'taskcomplete'])->name('opentask.task.complete')->middleware(['auth', 'XSS',]);
Route::post('/opentask/task/reopen/{id}', [WorkOrderController::class, 'taskreopen'])->name('opentask.task.reopen')->middleware(['auth', 'XSS',]);
Route::resource('woscomment', WosCommentController::class)->middleware(['auth', 'XSS']);
Route::resource('wosinvoice', WosInvoiceController::class)->middleware(['auth', 'XSS']);
Route::resource('woslogtime', WosLogTimeController::class)->middleware(['auth', 'XSS']);
Route::get('/wos/assetsedit/{id}', [WorkOrderController::class, 'assetsedit'])->name('wos.assetsedit')->middleware(['auth', 'XSS']);
Route::post('/wos/assetsupdate', [WorkOrderController::class, 'assetsupdate'])->name('wos.assetsupdate')->middleware(['auth', 'XSS']);
Route::post('/wos/workstatus', [WorkOrderController::class, 'workstatus'])->name('wos.workstatus')->middleware(['auth', 'XSS']);
Route::get('/opentask/file/{fid}', [WorkOrderController::class, 'fileDownload'])->name('opentask.file.download')->middleware(['auth', 'XSS']);
Route::delete('/opentask/file/delete/{fid}', [WorkOrderController::class, 'fileDelete'])->name('opentask.file.delete')->middleware(['auth', 'XSS']);
Route::post('/opentask/{id}/file', [WorkOrderController::class, 'fileUpload'])->name('opentask.file.upload')->middleware(['auth', 'XSS']);
Route::post('/opentask/task/updatecomplete', [WorkOrderController::class, 'updatetaskcomplete'])->name('opentask.task.updatecomplete')->middleware(['auth', 'XSS']);

Route::get('/opentask_import', [WorkOrderController::class, 'wosimport'])->name('opentask_import')->middleware(['auth', 'XSS',]);
Route::post('/opentask/importcreate', [WorkOrderController::class, 'wosimportCreate'])->name('opentask.importcreate')->middleware(['auth', 'XSS',]);


//====================================================== parts associate =================================================//
Route::post('/parts/associate/{module}/{id}', [PartsController::class, 'associateParts'])->name('parts.associate');
Route::get('/parts/associate/create/{module}/{id}', [PartsController::class, 'associatePartsView'])->name('parts.associate.create');
Route::any('/parts/associate_remove/{module}/{id}', [PartsController::class, 'removeAssociateParts'])->name('parts.associate_remove');

//========================================================== Vendor ======================================================//
Route::resource('vendors', VendorController::class)->middleware(['auth', 'XSS']);
Route::resource('vendorlogtime', VendorLogTimeController::class)->middleware(['auth', 'XSS']);


//=================================================== POs ===========================================================//
Route::resource('pos', PosController::class)->middleware(['auth', 'XSS',]);
Route::post('pos/customer', [PosController::class, 'customer'])->name('pos.customer');
Route::post('pos/product', [PosController::class, 'product'])->name('pos.product');
Route::POST('pos/items', [PosController::class, 'items'])->name('pos.items');
Route::post('pos/product/destroy', [PosController::class, 'productDestroy'])->name('pos.product.destroy');
Route::get('pos/create', [PosController::class, 'create'])->name('pos.create');
Route::get('invoice/index', [PosController::class, 'index'])->name('invoice.index');


Route::post('get_parts',[PosController::class,'get_parts'])->name('get_parts')->middleware(['XSS']);

//=========================================== Calender =========================================//
Route::get('/calender', [CalenderController::class, 'index'])->name('calender')->middleware(['auth', 'XSS']);


//=========================================== Plan Request =====================================================//

Route::get('plan_request', [PlanRequestController::class, 'index'])->name('plan_request.index')->middleware(['auth', 'XSS']);

//=============================================== Languages ==================================================//
Route::get('/super_admin/change_lang/{lang}', [LocationController::class, 'changeLangAdmin'])->name('change_lang_admin')->middleware(['auth', 'XSS']);
Route::get('manage-language/{lang}', [LanguageController::class , 'manageLanguage'])->name('manage.language')->middleware(['auth','XSS']);
Route::get('create-language', [LanguageController::class , 'createLanguage'])->name('create.language')->middleware(['auth','XSS']);
Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language')->middleware(['auth','XSS']);
Route::delete('/lang/{lang}', [LanguageController::class , 'destroyLang'])->name('lang.destroy')->middleware(['auth','XSS']);
Route::post('store-language-data/{lang}', [LanguageController::class ,' storeLanguageData'])->name('store.language.data')->middleware(['auth','XSS']);

//=================================  location Settings ====================================//
Route::get('/user/settings', [LocationController::class, 'settings'])->name('user.settings')->middleware(['auth', 'XSS']);
Route::post('/user/settings', [LocationController::class, 'settingsStore'])->name('user.settings.store')->middleware(['auth', 'XSS']);
Route::post('/user/email/settings', [LocationController::class, 'emailSettingStore'])->name('user.email.settings.store')->middleware(['auth', 'XSS']);
Route::any('/user/test/mail', [LocationController::class, 'testmail'])->name('user.test.mail')->middleware(['auth', 'XSS']);
Route::any('/user/test/mail/send', [LocationController::class, 'testmailstore'])->name('users.test.email.send')->middleware(['auth', 'XSS']);


//========================================== Super AdminSetting ======================================================//

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index')->middleware(['auth', 'XSS']);
Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store')->middleware(['auth', 'XSS']);
Route::post('/email-settings', [SettingsController::class, 'emailSettingStore'])->name('email.settings.store')->middleware(['auth', 'XSS']);
Route::post('/pusher-settings', [SettingsController::class, 'pusherSettingStore'])->name('pusher.settings.store')->middleware(['auth', 'XSS']);
Route::post('/test', [SettingsController::class, 'testEmail'])->name('test.email')->middleware(['auth', 'XSS']);
Route::post('/test/send', [SettingsController::class, 'testEmailSend'])->name('test.email.send')->middleware(['auth', 'XSS']);
Route::post('payment-setting', [SettingsController::class, 'savePaymentSettings'])->name('payment.setting')->middleware(['auth', 'XSS']);



//================================= Custom Landing Page ====================================//

Route::get('/landingpage', [LandingPageSectionController::class, 'index'])->name('custom_landing_page.index')->middleware(['auth', 'XSS']);
Route::get('/LandingPage/show/{id}', [LandingPageSectionController::class, 'show']);
Route::post('/LandingPage/setConetent', [LandingPageSectionController::class, 'setConetent'])->middleware(['auth', 'XSS']);
Route::get('/get_landing_page_section/{name}', function ($name) {
    $plans = \DB::table('plans')->get();
    return view('custom_landing_page.' . $name, compact('plans'));
});
Route::post('/LandingPage/removeSection/{id}', [LandingPageSectionController::class, 'removeSection'])->middleware(['auth', 'XSS']);
Route::post('/LandingPage/setOrder', [LandingPageSectionController::class, 'setOrder'])->middleware(['auth', 'XSS']);
Route::post('/LandingPage/copySection', [LandingPageSectionController::class, 'copySection'])->middleware(['auth', 'XSS']);



//================================= Plan Payment Gateways Route ====================================//

Route::group(['middleware' => ['auth', 'XSS',],], function () {
    Route::get('order', [StripePaymentController::class, 'index'])->name('order.index')->middleware(['auth', 'XSS']);;
    Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post')->middleware(['auth', 'XSS']);
    Route::get('/stripe-payment-status', [StripePaymentController::class, 'planGetStripePaymentStatus'])->name('stripe.payment.status');
    Route::get('/orders', [StripePaymentController::class, 'index'])->name('order.index');
    Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
    Route::post('/webhook-stripe', [StripePaymentController::class, 'webhookStripe'])->name('webhook.stripe');
});

Route::group(['middleware' => ['auth', 'XSS',],], function () {
    Route::post('plan-pay-with-paypal', [PaypalController::class, 'planPayWithPaypal'])->name('plan.pay.with.paypal');
    Route::get('{id}/plan-get-payment-status', [PaypalController::class, 'planGetPaymentStatus'])->name('plan.get.payment.status');
});

Route::post('/plan-pay-with-paystack', [PaystackPaymentController::class, 'planPayWithPaystack'])->name('plan.pay.with.paystack')->middleware(['auth', 'XSS']);
Route::get('/plan/paystack/{pay_id}/{plan_id}', [PaystackPaymentController::class, 'getPaymentStatus'])->name('plan.paystack');

Route::post('/plan-pay-with-flaterwave', [FlutterwavePaymentController::class, 'planPayWithFlutterwave'])->name('plan.pay.with.flaterwave')->middleware(['auth', 'XSS']);
Route::get('/plan/flaterwave/{txref}/{plan_id}', [FlutterwavePaymentController::class, 'getPaymentStatus'])->name('plan.flaterwave');

Route::post('/plan-pay-with-razorpay', [RazorpayPaymentController::class, 'planPayWithRazorpay'])->name('plan.pay.with.razorpay')->middleware(['auth', 'XSS']);
Route::get('/plan/razorpay/{txref}/{plan_id}', [RazorpayPaymentController::class, 'getPaymentStatus'])->name('plan.razorpay');

Route::post('/plan-pay-with-paytm', [PaytmPaymentController::class, 'planPayWithPaytm'])->name('plan.pay.with.paytm')->middleware(['auth', 'XSS']);
Route::post('/plan/paytm/{plan}', [PaytmPaymentController::class, 'getPaymentStatus'])->name('plan.paytm');

Route::post('/plan-pay-with-mercado', [MercadoPaymentController::class, 'planPayWithMercado'])->name('plan.pay.with.mercado')->middleware(['auth', 'XSS']);
Route::get('/plan/mercado/{plan_id}', [MercadoPaymentController::class, 'getPaymentStatus'])->name('plan.mercado');

Route::post('/plan-pay-with-mollie', [MolliePaymentController::class, 'planPayWithMollie'])->name('plan.pay.with.mollie')->middleware(['auth', 'XSS']);
Route::get('/plan/mollie/{plan}', [MolliePaymentController::class, 'getPaymentStatus'])->name('plan.mollie');

Route::post('/plan-pay-with-skrill', [SkrillPaymentController::class, 'planPayWithSkrill'])->name('plan.pay.with.skrill')->middleware(['auth', 'XSS']);
Route::get('/plan/skrill/{plan}', [SkrillPaymentController::class, 'getPaymentStatus'])->name('plan.skrill');

Route::post('/plan-pay-with-coingate', [CoingatePaymentController::class, 'planPayWithCoingate'])->name('plan.pay.with.coingate')->middleware(['auth', 'XSS']);
Route::get('/plan/coingate/{plan}', [CoingatePaymentController::class, 'getPaymentStatus'])->name('plan.coingate');

//================================================ Employee profile ====================================================//
Route::get('/my-account',[UserController::class,'account'])->name('my.account')->middleware(['auth','XSS']);
Route::post('/my-account',[UserController::class,'accountupdate'])->name('account.update')->middleware(['auth','XSS']);
Route::post('/my-account/password',[UserController::class,'updatePassword'])->name('update.password')->middleware(['auth','XSS']);
Route::delete('/my-account',[UserController::class,'deleteAvatar'])->name('delete.avatar')->middleware(['auth','XSS']);















Route::get('invoice', [PosController::class, 'customerInvoice'])->name('invoice')->middleware(['auth', 'XSS']);
Route::get('invoice/{id}/send', [PosController::class, 'customerInvoiceSend'])->name('invoice.send')->middleware(['auth', 'XSS']);
Route::post('invoice/{id}/send/mail', [PosController::class, 'customerInvoiceSendMail'])->name('invoice.send.mail')->middleware(['auth', 'XSS']);
Route::get('invoice/{id}/show', [PosController::class, 'customerInvoiceShow'])->name('invoice.show')->middleware(['auth', 'XSS']);


Route::get('invoice/{id}/duplicate', [PosController::class, 'duplicate'])->name('invoice.duplicate');
Route::get('invoice/{id}/shipping/print', [PosController::class, 'shippingDisplay'])->name('invoice.shipping.print');
Route::get('invoice/{id}/payment/reminder', [PosController::class, 'paymentReminder'])->name('invoice.payment.reminder');

Route::get('invoice/{id}/sent', [PosController::class, 'sent'])->name('invoice.sent');
Route::get('invoice/{id}/resent', [PosController::class, 'resent'])->name('invoice.resent');
Route::get('invoice/{id}/payment', [PosController::class, 'payment'])->name('invoice.payment');
Route::post('invoice/{id}/payment', [PosController::class, 'createPayment'])->name('invoice.payment');
Route::post('invoice/{id}/payment/{pid}/destroy', [PosController::class, 'paymentDestroy'])->name('invoice.payment.destroy');



Route::get('/plans', [PlanController::class, 'index'])->name('plans.index')->middleware(['auth', 'XSS']);
Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create')->middleware(['auth', 'XSS']);
Route::post('/plans', [PlanController::class, 'store'])->name('plans.store')->middleware(['auth', 'XSS']);
Route::get('/plans/{id}/edit', [PlanController::class, 'edit'])->name('plans.edit')->middleware(['auth', 'XSS']);
Route::post('/plans/{id}/update', [PlanController::class, 'update'])->name('plans.update')->middleware(['auth', 'XSS']);
Route::post('/user-plans/', [PlanController::class, 'userPlan'])->name('update.user.plan')->middleware(['auth', 'XSS']);
Route::get('/payment/{frequency}/{code}', [PlanController::class, 'payment'])->name('payment')->middleware(['auth', 'XSS']);

Route::get('/take-a-plan-trial/{plan_id}', [PlanController::class, 'takeAPlanTrial'])->name('take.a.plan.trial')->middleware(['auth', 'XSS']);
Route::get('/change-user-plan/{plan_id}', [PlanController::class, 'changeUserPlan'])->name('change.user.plan')->middleware(['auth', 'XSS']);



Route::get('request_frequency/{id}', [PlanRequestController::class, 'requestView'])->name('request.view')->middleware(['auth', 'XSS',]);
Route::get('request_send/{id}', [PlanRequestController::class, 'userRequest'])->name('send.request')->middleware(['auth', 'XSS',]);
Route::get('request_response/{id}/{response}', [PlanRequestController::class, 'acceptRequest'])->name('response.request')->middleware(['auth', 'XSS',]);
Route::get('request_cancel/{id}', [PlanRequestController::class, 'cancelRequest'])->name('request.cancel')->middleware(['auth', 'XSS',]);


Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon')->middleware(['auth', 'XSS']);
Route::resource('coupons', CouponController::class)->middleware(['auth', 'XSS',]);

Route::get('/paln/change/{id}', [UserController::class, 'changePlan'])->name('users.change.plan')->middleware(['auth', 'XSS']);
Route::get('user/{id}/plan/{pid}/{duration}', [UserController::class, 'manuallyActivatePlan'])->name('manually.activate.plan')->middleware(['auth', 'XSS',]);

//================================= Super Admin Order ====================================//

Route::get('/orders', [StripePaymentController::class, 'index'])->name('order.index')->middleware(['auth', 'XSS']);
Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post')->middleware(['auth', 'XSS']);
Route::get('/stripe-payment-status', [StripePaymentController::class, 'planGetStripePaymentStatus'])->name('stripe.payment.status')->middleware(['auth', 'XSS',]);
Route::post('/webhook-stripe', [StripePaymentController::class, 'webhookStripe'])->name('webhook.stripe')->middleware(['auth', 'XSS',]);





//================================= End Plan Payment Gateways Route ====================================//







require __DIR__ . '/auth.php';
