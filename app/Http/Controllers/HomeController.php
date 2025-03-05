<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Utility;
use App\Models\location;
use App\Models\WorkOrder;
use App\Models\Assets;
use App\Models\LandingPageSection;
use App\Models\LocationSetting;
use App\Models\Pms;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function landingPage()
    {
       
        if(!file_exists(storage_path() . "/installed"))
        {
            header('location:install');
            die;
        }

        $setting = Utility::settings();
        
        if($setting['display_landing_page']=='on')
        {
            $plans       = Plan::where('status', '1')->orderBy('id', 'asc')->take(4)->get();
            $get_section = LandingPageSection::orderBy('section_order', 'ASC')->get();
           
            return view('layouts.landing', compact('get_section'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function index()
    {


        $objUser = Auth::user();
        $currentlocation = User::userCurrentLocation();
        if (Auth::check()) {


            if ($objUser->user_type == "super admin") {

                $totalUsers       = User::where('user_type', 'company')->count();
                $totalPaidUsers   = User::where('user_type', 'company')->where('plan','!=','0')->count();
                $totalOrderAmount = Order::sum('price');
                $totalOrders      = Order::count();
                $totalPlans       = Plan::count();
                $mostPlans        = Plan::where('id', function ($query) {
                    $query->select('plan_id')->from('orders')->groupBy('plan_id')->orderBy(\DB::raw('COUNT(plan_id)'))->limit(1);
                })->first();

                $chartData = $this->getOrderChart(['duration' => 'week']);

                return view('dashboard.index', compact('totalUsers', 'totalPaidUsers', 'totalOrders', 'totalOrderAmount', 'totalPlans', 'mostPlans', 'chartData'));
            } elseif ($objUser->user_type == "company") {

                $open_workOrder = WorkOrder::where('status', 1)->where('location_id', $currentlocation)->count();
                $complete_workOrder = WorkOrder::where('status', 2)->where('location_id', $currentlocation)->count();
                $total_assets = Assets::where('is_active', 1)->where('location_id', $currentlocation)->count();
                $total_pms = Pms::where('is_active', 1)->where('location_id', $currentlocation)->count();

                $locationsetting=LocationSetting::where('location_id',$currentlocation)->pluck('value','name')->toArray();

                $chartData = $this->getChartData(['duration' => 'week', 'current_location' => $currentlocation]);



                $totalProject   = WorkOrder::where("created_by", "=", $objUser->id)->where('location_id', '=', $currentlocation)->count();

                $projectProcess = WorkOrder::where("created_by", "=", $objUser->id)->where('location_id', '=', $currentlocation)->groupBy('status')->selectRaw('count(id) as count ')->pluck('count');

                $arrProcessPer   = [];
                $arrProcessLabel = [];

                if (count($projectProcess) <= 0) {

                   $arrProcessLabel[]=['panding'];
                   $arrProcessLabel[]=['Complete'];

                } else {

                    foreach ($projectProcess as $lable => $process) {

                        if ($lable == 1) {

                            $arrProcessLabel[] = 'Complete';
                        } else {
                            $arrProcessLabel[] = 'Pandding';
                        }

                        if ($totalProject == 0) {
                            $arrProcessPer[] = 0.00;
                        } else {
                            $arrProcessPer[] = round(($process * 100) / $totalProject, 2);
                        }
                    }
                }

                $arrProcessClass = [
                    'text-success',
                    'text-primary'
                ];




                $tasks = WorkOrder::where('status', 2)->where('location_id', $currentlocation)->limit(4)->get();
                $completeTask = WorkOrder::where('status', 2)->where('location_id', $currentlocation)->count();
                $totalTask = WorkOrder::where('location_id', $currentlocation)->count();
                return view('dashboard.index', compact('open_workOrder', 'complete_workOrder','locationsetting' ,'total_assets', 'total_pms', 'arrProcessPer', 'arrProcessLabel', 'arrProcessClass', 'currentlocation', 'chartData', 'tasks', 'completeTask', 'totalTask'));
            }
            else if($objUser->user_type == "employee"){
                $user_id=Auth::user()->id;
                $assign_work_order=WorkOrder::whereRaw("FIND_IN_SET(".$user_id.",sand_to)")->count();
                $created_work_order=WorkOrder::where("created_by",Auth::user()->id)->get();
                $complete_workorder=WorkOrder::where('status','2')->where('created_by',$objUser->id)->count();
                $open_workorder=WorkOrder::where('status','1')->where('created_by',$objUser->id)->count();

                $chartData = $this->getChartData(['duration' => 'week', 'current_location' => $objUser->location_id]);

                $totalProject   = WorkOrder::where("created_by", "=", $objUser->id)->where('location_id', '=', $objUser->location_id)->count();

                $projectProcess = WorkOrder::where("created_by", "=", $objUser->id)->where('location_id', '=', $objUser->location_id)->groupBy('status')->selectRaw('count(id) as count ')->pluck('count');
                $arrProcessPer   = [];
                $arrProcessLabel = [];

                if (count($projectProcess) <= 0) {

                    $arrProcessLabel[]=['panding'];
                    $arrProcessLabel[]=['Complete'];

                 } else {

                     foreach ($projectProcess as $lable => $process) {

                         if ($lable == 1) {

                             $arrProcessLabel[] = 'Complete';
                         } else {
                             $arrProcessLabel[] = 'Pandding';
                         }

                         if ($totalProject == 0) {
                             $arrProcessPer[] = 0.00;
                         } else {
                             $arrProcessPer[] = round(($process * 100) / $totalProject, 2);
                         }
                     }
                 }

                 $arrProcessClass = [
                     'text-success',
                     'text-primary'
                 ];
                 $tasks = WorkOrder::where('status', 2)->where('location_id', $objUser->location_id)->where("created_by", "=", $objUser->id)->limit(4)->get();
                 $completeTask = WorkOrder::where('status', 2)->where('location_id', $objUser->location_id)->where("created_by", "=", $objUser->id)->count();
                 $totalTask = WorkOrder::where('location_id', $objUser->location_id)->where("created_by", "=", $objUser->id)->count();

                return view('dashboard.employee_dashboard',compact('assign_work_order','tasks','completeTask','totalTask','chartData','arrProcessPer', 'arrProcessLabel', 'arrProcessClass','created_work_order','complete_workorder','open_workorder'));
            }
            else {
                $settings = Utility::settings();
                if($settings['display_landing_page'] == 'on')
                {
                    $plans = Plan::get();
                    $get_section = LandingPageSection::orderBy('section_order', 'ASC')->get();

                    return view('layouts.landing', compact('plans','get_section'));
                }
                else
                {
                    return redirect('login');
                }

            }





        } else {
            return redirect()->route('login');
        }
    }


    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-1 week +1 day");
                for ($i = 0; $i < 7; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('D', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }
        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach ($arrDuration as $date => $label) {
            $data               = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }
        return $arrTask;
    }


    public function getChartData($arrParam)
    {
        $currentlocation = $arrParam['current_location'];
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-1 week +1 day");
                for ($i = 0; $i < 7; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('D', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }
        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach ($arrDuration as $date => $label) {

            $data               = WorkOrder::select(\DB::raw('count(*) as total'))->whereDate('created_at', $date)->where('location_id', $currentlocation)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }
        return $arrTask;
    }
}
