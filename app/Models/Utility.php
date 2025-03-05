<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Artisan;
use Jenssegers\Date\Date;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class Utility extends Model
{
    use HasFactory;

    public static function addNewData()
    {

        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:clear');
        $usr            = Auth::user();
        $arrPermissions = [
            "manage location",
            "create location",
            "edit location",
            "delete location",
            "manage role",
            "create role",
            "edit role",
            "delete role",
            "manage client",
            "create client",
            "edit client",
            "delete client",
            "manage user",
            "create user",
            "edit user",
            "delete user",
            "manage assets",
            "create assets",
            "edit assets",
            "delete assets",
            "associate assets",
            "manage parts",
            "create parts",
            "edit parts",
            "delete parts",
            "associate parts",
            "manage pms",
            "create pms",
            "edit pms",
            "delete pms",
            "associate pms",
            "manage vendor",
            "create vendor",
            "edit vendor",
            "delete vendor",
            "associate vendor",
            "manage pos",
            "create pos",
            "edit pos",
            "delete pos",
            "associate pos",
            "manage wos",
            "create wos",
            "edit wos",
            "delete wos",
            "associate wos",
            "manage logtime",
            "create logtime",
            "edit logtime",
            "delete logtime",
        ];

        $companyRole        = Role::where('name', 'LIKE', 'company')->first();
        $companyPermissions = $companyRole->getPermissionNames()->toArray();

        foreach ($arrPermissions as $ap) {
            // check if permission is not created then create it.
            $permission = Permission::where('name', 'LIKE', $ap)->first();
            if (empty($permission)) {
                Permission::create(['name' => $ap]);
            }

            // check if permission is not assign to company then assign.
            if (!in_array($ap, $companyPermissions)) {
                $permission = Permission::findByName($ap);
                $companyRole->givePermissionTo($permission);
            }
        }
    }

    public function createSlug($table, $title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title, '-');
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($table, $slug, $id);
        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception(__('Can not create a unique slug'));
    }

    protected function getRelatedSlugs($table, $slug, $id = 0)
    {
        return DB::table($table)->select()->where('slug', 'like', $slug . '%')->where('id', '<>', $id)->get();
    }

    public static function getLocationBySlug($slug)
    {
        $objUser = Auth::user();

        if ($objUser && $objUser->current_location) {

            $rs = location::where(['id' => $objUser->current_location])->first();
        } elseif ($objUser && !empty($slug)) {
            $loaction_id = [];
            if ($objUser->location_id != "" && $objUser->location_id != null) {
                $loaction_id = explode($objUser->location_id);
            }
            $rs = location::where('slug', '=', $slug)->whereIn('id', $loaction_id)->first();
        } elseif ($objUser) {
            $loaction_id = [];
            if ($objUser->location_id != "" && $objUser->location_id != null) {
                $loaction_id = explode($objUser->location_id);
            }

            $rs = location::whereIn('id', $loaction_id)->limit(1)->first();
        } else {
            $rs = location::where('slug', '=', $slug)->limit(1)->first();
        }
        if ($rs) {
            Utility::setLang($rs);

            return $rs;
        }
    }

    public static function setLang($location)
    {
        $dir = base_path() . '/resources/lang/' . $location->id . "/";
        if (is_dir($dir)) {
            $lang = $location->id . "/" . $location->lang;
        } else {
            $lang = $location->lang;
        }

        Date::setLocale(basename($lang));
        \App::setLocale($lang);
    }

    public static function addCustomFields()
    {
        $AssetsFields = [
            'Asset Tag' => 'text',
            'Category' => 'text',
            'Assigned Date' => 'date',
            'Description' => 'text',
            'Link' => 'text',
            'Model' => 'text',
            'Brand' => 'text',
            'Operating Hours' => 'time',
            'Original Cost' => 'number',
            'Purchase Cost' => 'number',
            'Serial Number' => 'number',
            'Service Contact' => 'text',
            'Warranty Exp Date' => 'date',
            'Waste Disposal National Regulations' => 'file/document',
            'Documents and Picture' => 'multiple_files/document',
        ];

        foreach ($AssetsFields as $key => $value) {
            $data = [
                'name' => $key,
                'type' => $value,
                'module' => 'Assets'
            ];
            $checkIfExist = AssetsField::where(['name' => $key, 'type' => $value, 'module' => 'Assets'])->first();
            if (is_null($checkIfExist)) {
                AssetsField::create($data);
            }
        }
    }


    public static function settings()
    {
        $data = DB::table('settings')->where('created_by', '=',0)->get();

        $settings = [
            "footer_text" => "© 2022 CMMSGo SaaS",
            "cookie_text" => "We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it. ",
            "gdpr_cookie"=>"",
            "display_landing_page"=>"on",
            "default_language"=>"en",
            "SIGNUP" => '',
            "color" => '',
            "cust_theme_bg" => '',
            "cust_darklayout" => '',
            "header_text" => 'CMMSGo SaaS',
            "favicon" => 'favicon.png'

        ];

        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function getValByName($key)
    {
        $setting = self::settings();
       
        if (!isset($setting[$key]) || empty($setting[$key])) {
            $setting[$key] = '';
        }

        return $setting[$key];
    }


    public static function languages()
    {

        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir) {
                return str_replace($dir, '', $value);
            },
            $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir) {
                return preg_replace('/[0-9]+/', '', $value);
            },
            $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }
    public function changeLangWorkspace($workspaceID, $lang)
    {
        dd($workspaceID, $lang);
        $workspace       = Workspace::find($workspaceID);
        $workspace->lang = $lang;
        $workspace->save();

        return redirect()->back()->with('success', __('Workspace Language Change Successfully!'));
    }





    public static function getPaymentSetting($loaction_id)
    {
        $data     = DB::table('payment_settings');
        $settings = [
            'is_paystack_enabled' => 'off',
            'paystack_public_key' => '',
            'paystack_secret_key' => '',
            'is_flutterwave_enabled' => 'off',
            'flutterwave_public_key' => '',
            'flutterwave_secret_key' => '',
            'is_razorpay_enabled' => 'off',
            'razorpay_public_key' => '',
            'razorpay_secret_key' => '',
            'is_mercado_enabled' => 'off',
            'mercado_app_id' => '',
            'mercado_secret_key' => '',
            'is_paytm_enabled' => 'off',
            'paytm_mode' => 'local',
            'paytm_merchant_id' => '',
            'paytm_merchant_key' => '',
            'paytm_industry_type' => '',
            'is_mollie_enabled' => 'off',
            'mollie_api_key' => '',
            'mollie_profile_id' => '',
            'mollie_partner_id' => '',
            'is_skrill_enabled' => 'off',
            'skrill_email' => '',
            'is_coingate_enabled' => 'off',
            'coingate_mode' => 'sandbox',
            'coingate_auth_token' => '',

        ];


        if(!empty($loaction_id))
        {
            $data = $data->where('created_by', '=', $loaction_id);
            $data = $data->get();
            foreach($data as $row)
            {
                $settings[$row->name] = $row->value;
            }
        }

        return $settings;
    }


    public static function getFirstSeventhWeekDay($week = null)
    {
        $first_day = $seventh_day = null;

        if (isset($week)) {
            $first_day   = Carbon::now()->addWeeks($week)->startOfWeek();
            $seventh_day = Carbon::now()->addWeeks($week)->endOfWeek();
        }

        $dateCollection['first_day']   = $first_day;
        $dateCollection['seventh_day'] = $seventh_day;

        $period = CarbonPeriod::create($first_day, $seventh_day);

        foreach ($period as $key => $dateobj) {
            $dateCollection['datePeriod'][$key] = $dateobj;
        }

        return $dateCollection;
    }

    // Payment setting

    public static function set_payment_settings()
    {
        $data = DB::table('admin_payment_settings');

        if (Auth::check()) {
            $data->where('created_by', '=', Auth::user()->creatorId());
        } else {
            $data->where('created_by', '=', 1);
        }
        $data = $data->get();
        $res = [];
        foreach ($data as $key => $value) {
            $res[$value->name] = $value->value;
        }

        return $res;
    }

    public static function getAdminPaymentSetting()
    {

        $data = DB::table('admin_payment_settings');
        if (Auth::check()) {
            $data->where('created_by', '=', Auth::user()->createById());
        } else {
            $data->where('created_by', '=', 1);
        }
        $data = $data->get();
        $res = [];
        foreach ($data as $key => $value) {
            $res[$value->name] = $value->value;
        }
        return $res;
    }

    public static function LocationSetting()
    {

            $CurrentLocation = User::userCurrentLocation();
            return LocationSetting::where('location_id', $CurrentLocation)->pluck('value', 'name')->toArray();

    }
    public static function add_landing_page_data()
    {
        $section_data   = [];
        $section_data[] = [
            'section_name' => 'section-1',
            'section_order' => 1,
            'default_content' => '{"logo":"landing_logo.png","image":"top-banner.png","button":{"text":"Login"},"menu":[{"menu":"Features","href":"#"},{"menu":"Pricing","href":"#"}],"text":{"text-1":"Taskly SaaS","text-2":"Project Management Tool","text-3":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.","text-4":"get started - its free","text-5":"no creadit card reqired "},"custom_class_name":""}',
            'content' => '{"logo":"landing_logo.png","image":"top-banner.png","button":{"text":"Login"},"menu":[{"menu":"Features","href":"#"},{"menu":"Pricing","href":"#"}],"text":{"text-1":"CMMSGO SaaS","text-2":"Maintenance Management System","text-3":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.","text-4":"get started - its free","text-5":"no creadit card reqired"},"custom_class_name":""}',
            'section_demo_image' => 'top-header-section.png',
            'section_blade_file_name' => 'custome-top-header-section',
            'section_type' => 'section-1',
        ];
        $section_data[] = [
            'section_name' => 'section-2',
            'section_order' => 2,
            'default_content' => '{"image":"cal-sec.png","button":{"text":"try our system","href":"#"},"text":{"text-1":"Features","text-2":"Lorem Ipsum is simply dummy","text-3":"text of the printing","text-4":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"image_array":[{"id":1,"image":"nexo.png"},{"id":2,"image":"edge.png"},{"id":3,"image":"atomic.png"},{"id":4,"image":"brd.png"},{"id":5,"image":"trust.png"},{"id":6,"image":"keep-key.png"},{"id":7,"image":"atomic.png"},{"id":8,"image":"edge.png"}],"custom_class_name":""}',
            'content' => '{"image":"cal-sec.png","button":{"text":"try our system","href":"#"},"text":{"text-1":"Features","text-2":"Lorem Ipsum is simply dummy","text-3":"text of the printing","text-4":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"image_array":[{"id":1,"image":"nexo.png"},{"id":2,"image":"edge.png"},{"id":3,"image":"atomic.png"},{"id":4,"image":"brd.png"},{"id":5,"image":"trust.png"},{"id":6,"image":"keep-key.png"},{"id":7,"image":"atomic.png"},{"id":8,"image":"edge.png"}],"custom_class_name":""}',
            'section_demo_image' => 'logo-part-main-back-part.png',
            'section_blade_file_name' => 'custome-logo-part-main-back-part',
            'section_type' => 'section-2',
        ];
        $section_data[] = [
            'section_name' => 'section-3',
            'section_order' => 3,
            'default_content' => '{"image": "sec-2.png","button": {"text": "try our system","href": "#"},"text": {"text-1": "Features","text-2": "Lorem Ipsum is simply dummy","text-3": "text of the printing","text-4": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"custom_class_name":""}',
            'section_demo_image' => 'simple-sec-even.png',
            'section_blade_file_name' => 'custome-simple-sec-even',
            'section_type' => 'section-3',
        ];
        $section_data[] = [
            'section_name' => 'section-4',
            'section_order' => 4,
            'default_content' => '{"image": "sec-3.png","button": {"text": "try our system","href": "#"},"text": {"text-1": "Features","text-2": "Lorem Ipsum is simply dummy","text-3": "text of the printing","text-4": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting"},"custom_class_name":""}',
            'section_demo_image' => 'simple-sec-odd.png',
            'section_blade_file_name' => 'custome-simple-sec-odd',
            'section_type' => 'section-4',
        ];
        $section_data[] = [
            'section_name' => 'section-5',
            'section_order' => 5,
            'default_content' => '{"button": {"text": "TRY OUR SYSTEM","href": "#"},"text": {"text-1": "See more features","text-2": "All Features","text-3": "in one place","text-4": "Attractive Dashboard Customer & Vendor Login Multi Languages","text-5":"Invoice, Billing & Transaction Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting","text-6":"Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting","text-7":"Multi User & Permission Paypal & Stripe for Invoice User Friendly Invoice Theme Make your own setting User Friendly Invoice Theme Make your own setting","text-8":"Multi User & Permission Paypal & Stripe for Invoice"},"custom_class_name":""}',
            'section_demo_image' => 'features-inner-part.png',
            'section_blade_file_name' => 'custome-features-inner-part',
            'section_type' => 'section-5',
        ];
        $section_data[] = [
            'section_name' => 'section-6',
            'section_order' => 6,
            'default_content' => '{"system":[{"id":1,"name":"Dashboard","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":5,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":2,"name":"Functions","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"}]},{"id":3,"name":"Reports","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":4,"name":"Tables","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]},{"id":5,"name":"Settings","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":6,"name":"Contact","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]}],"custom_class_name":""}',
            'content' => '{"system":[{"id":1,"name":"Dashboard","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":5,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":2,"name":"Functions","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"}]},{"id":3,"name":"Reports","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":4,"name":"Tables","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"},{"data_id":3,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-3.png"},{"data_id":4,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]},{"id":5,"name":"Settings","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"},{"data_id":2,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-2.png"}]},{"id":6,"name":"Contact","data":[{"data_id":1,"text":{"text_1":"Dashboard","text_2":"Main Page"},"button":{"text":"LIVE DEMO","href":"#"},"image":"tab-1.png"}]}],"custom_class_name":""}',
            'section_demo_image' => 'container-our-system-div.png',
            'section_blade_file_name' => 'custome-container-our-system-div',
            'section_type' => 'section-6',
        ];
        $section_data[] = [
            'section_name' => 'section-7',
            'section_order' => 7,
            'default_content' => '{"testimonials":[{"id":1,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":2,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":3,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":4,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"},{"id":5,"text":{"text_1":"We have been building AI projects for a long time and we decided it was time to build a platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.","text_2":"Lorem Ipsum","text_3":"Founder and CEO at Rajodiya Infotech"},"image":"testimonials-img.png"}],"custom_class_name":""}',
            'section_demo_image' => 'testimonials-section.png',
            'section_blade_file_name' => 'custome-testimonials-section',
            'section_type' => 'section-7',
        ];
        $section_data[] = [
            'section_name' => 'section-plan',
            'section_order' => 8,
            'default_content' => 'plan',
            'content' => 'plan',
            'section_demo_image' => 'plan-section.png',
            'section_blade_file_name' => 'plan-section',
            'section_type' => 'section-plan',
        ];
        $section_data[] = [
            'section_name' => 'section-8',
            'section_order' => 9,
            'default_content' => '{"button":{"text":"Subscribe"},"text":{"text-1":"Try for free","text-2":"Lorem Ipsum is simply dummy text","text-3":"of the printing and typesetting industry","text-4":"Type your email address and click the button"},"custom_class_name":""}',
            'content' => '{"button":{"text":"Subscribe"},"text":{"text-1":"Try for free","text-2":"Lorem Ipsum is simply dummy text","text-3":"of the printing and typesetting industry","text-4":"Type your email address and click the button"},"custom_class_name":""}',
            'section_demo_image' => 'subscribe-part.png',
            'section_blade_file_name' => 'custome-subscribe-part',
            'section_type' => 'section-8',
        ];
        $section_data[] = [
            'section_name' => 'section-9',
            'section_order' => 10,
            'default_content' => '{"menu":[{"menu":"Facebook","href":"#"},{"menu":"LinkedIn","href":"#"},{"menu":"Twitter","href":"#"},{"menu":"Discord","href":"#"}],"custom_class_name":""}',
            'content' => '{"menu":[{"menu":"Facebook","href":"#"},{"menu":"LinkedIn","href":"#"},{"menu":"Twitter","href":"#"},{"menu":"Discord","href":"#"}],"custom_class_name":""}',
            'section_demo_image' => 'social-links.png',
            'section_blade_file_name' => 'custome-social-links',
            'section_type' => 'section-9',
        ];
        $section_data[] = [
            'section_name' => 'section-10',
            'section_order' => 11,
            'default_content' => '{"footer":{"logo":{"logo":"landing_logo.png"},"footer_menu":[{"id":1,"menu":"FIO Protocol","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":2,"menu":"Learn","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":3,"menu":"Foundation","data":[{"menu_name":"About Us","menu_href":"#"},{"menu_name":"Customers","menu_href":"#"},{"menu_name":"Resources","menu_href":"#"},{"menu_name":"Blog","menu_href":"#"}]}],"contact_app":[{"menu":"Contact","data":[{"id":1,"image":"app-store.png","image_href":"#"},{"id":2,"image":"google-pay.png","image_href":"#"}]}],"bottom_menu":{"text":"All rights reserved.","data":[{"menu_name":"Privacy Policy","menu_href":"#"},{"menu_name":"Github","menu_href":"#"},{"menu_name":"Press Kit","menu_href":"#"},{"menu_name":"Contact","menu_href":"#"}]}},"custom_class_name":""}',
            'content' => '{"footer":{"logo":{"logo":"landing_logo.png"},"footer_menu":[{"id":1,"menu":"FIO Protocol","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":2,"menu":"Learn","data":[{"menu_name":"Feature","menu_href":"#"},{"menu_name":"Download","menu_href":"#"},{"menu_name":"Integration","menu_href":"#"},{"menu_name":"Extras","menu_href":"#"}]},{"id":3,"menu":"Foundation","data":[{"menu_name":"About Us","menu_href":"#"},{"menu_name":"Customers","menu_href":"#"},{"menu_name":"Resources","menu_href":"#"},{"menu_name":"Blog","menu_href":"#"}]}],"contact_app":[{"menu":"Contact","data":[{"id":1,"image":"app-store.png","image_href":"#"},{"id":2,"image":"google-pay.png","image_href":"#"}]}],"bottom_menu":{"text":"All rights reserved.","data":[{"menu_name":"Privacy Policy","menu_href":"#"},{"menu_name":"Github","menu_href":"#"},{"menu_name":"Press Kit","menu_href":"#"},{"menu_name":"Contact","menu_href":"#"}]}},"custom_class_name":""}',
            'section_demo_image' => 'footer-section.png',
            'section_blade_file_name' => 'custome-footer-section',
            'section_type' => 'section-10',
        ];


        foreach($section_data as $section_key => $section_value)
        {

            LandingPageSection::create($section_value);
        }

        return true;
    }

    public static function dateFormat($date)
    {
        $lang = \App::getLocale();
        \App::setLocale(basename($lang));
        $date = Date::parse($date)->format('d M Y');

        return $date;
    }
    public static function getDateFormated($date, $time = false)
    {
        if(!empty($date) && $date != '0000-00-00')
        {
            if($time == true)
            {
                return date("d M Y H:i A", strtotime($date));
            }
            else
            {
                return date("d M Y", strtotime($date));
            }
        }
        else
        {
            return '';
        }
    }


    // public static function SettingDateFormat()
    // {
    //     $date=LocationSetting::
    //     return 0;
    // }

    public static function delete_directory($dir)
    {
        if(!file_exists($dir))
        {
            return true;
        }
        if(!is_dir($dir))
        {
            return unlink($dir);
        }
        foreach(scandir($dir) as $item)
        {
            if($item == '.' || $item == '..')
            {
                continue;
            }
            if(!self::delete_directory($dir . DIRECTORY_SEPARATOR . $item))
            {
                return false;
            }
        }

        return rmdir($dir);
    }

    public static function colorset()
    {

        if(\Auth::user())
        {
            $setting = DB::table('settings')->where('created_by', NULL)->pluck('value','name')->toArray();
        }
        else{
            $setting = DB::table('settings')->pluck('value','name')->toArray();
        }
        return $setting;

        $is_dark_mode = $setting['cust_darklayout'];

        if($is_dark_mode == 'on'){
            return 'logo-light.png';
        }else{
            return 'logo-dark.png';
        }

    }

    public static function get_superadmin_logo(){
        $setting = DB::table('settings')->where('created_by', 0)->pluck('value','name')->toArray();

        $is_dark_mode = $setting['cust_darklayout'];
        if($is_dark_mode == 'on'){
            return 'logo-light.png';
        }else{
            return 'logo-dark.png';
        }
    }

    public static function mode_layout()
    {
        $data = DB::table('settings');
        $data = $data->where('created_by', '=', NULL);
        $data     = $data->get();
        $settings = [
            "cust_darklayout" => "off",
            "cust_theme_bg" => "off",
        ];
        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if(!file_put_contents($envFile, $str))
        {
            return false;
        }

        return true;
    }
}
