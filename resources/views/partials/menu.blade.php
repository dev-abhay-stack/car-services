{{-- @php
if (\Auth::user()->user_type == 'super admin') {
    $logo = asset(Storage::url('logo/logo.png'));
} elseif (\Auth::user()->user_type == 'company') {
    $locationsetting = Utility::LocationSetting();
    $logo = asset(Storage::url('logo/' . (!empty($locationsetting['logo']) ? $locationsetting['logo'] : 'logo.png')));
} else {
    $logo = asset(Storage::url('logo/logo.png'));
}
$users=\Auth::user();
$currantLang = $users->currentLanguage();
@endphp
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ $logo }}" alt="{{ config('app.name', 'CMMS') }}" class="navbar-brand-img">
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin"
                data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}">
                        <i class="fas fa-home"></i>{{ __('Dashboard') }}
                    </a>
                </li>

                @if (Auth::user()->user_type == 'super admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'users.index' ? ' active' : '' }}"
                            href="{{ route('users.index', '') }}">
                            <i class="fas fa-users"></i>
                            <span> {{ __('Users') }} </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'plans.index' ? ' active' : '' }}"
                            href="{{ route('plans.index') }}">
                            <i class="fas fa-trophy"></i>
                            <span> {{ __('Plans') }} </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('plan_request.index') }}"
                            class="nav-link {{ request()->is('plan_request*') ? 'active' : '' }}">
                            <i class="fas fa-paper-plane"></i>{{ __('Plan Request') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'language.index' ? ' active' : '' }}"
                            href="{{ route('order.index') }}">
                            <i class="fas fa-credit-card"></i>
                            <span> {{ __('Orders') }} </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  {{ Request::route()->getName() == 'coupons.index' || Request::segment(1) == 'coupons' ? ' active' : '' }}"
                            href="{{ route('coupons.index') }}">
                            <i class="fas fa-tag"></i>
                            <span> {{ __('Coupons') }} </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('manage.language',[$currantLang])}}" class="nav-link {{ (Request::segment(1) == 'manage-language')?'active':''}}">
                            <i class="fas fa-language"></i>{{__('Language')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custom_landing_page.index') }}">
                            <i class="fas fa-clipboard"></i>
                            <span> {{ __('Landing page') }} </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'settings.index' ? ' active' : '' }}"
                            href="{{ route('settings.index') }}">
                            <i class="fas fa-cog"></i>
                            <span> {{ __('Settings') }} </span>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->user_type == 'company')
                    @if (Gate::check('manage location'))
                        @can('create location')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(1) == 'location' ? 'active' : '' }}"
                                    href="{{ route('location.index') }}">
                                    <i class="fas fa-industry"></i>{{ __('Location') }}
                                </a>
                            </li>
                        @endcan
                    @endif
                @endif


                @if (\Auth::user()->user_type == 'company')
                    @if (Gate::check('manage user') || Gate::check('manage role'))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' ? ' active' : 'collapsed' }}"
                                href="#navbar-getting-staff" data-toggle="collapse" role="button" aria-expanded="false"
                                aria-expanded="{{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' ? ' true' : 'false' }}">
                                <i class="fas fa-users"></i>{{ __('Staff') }}
                                <i class="fas fa-sort-up"></i>
                            </a>
                            <div class="collapse {{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' ? ' show' : '' }}"
                                id="navbar-getting-staff">
                                <ul class="nav flex-column submenu-ul">
                                    @can('manage user')
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::route()->getName() == 'users.index' ||Request::route()->getName() == 'users.create' ||Request::route()->getName() == 'users.edit'? ' active': '' }}"
                                                href="{{ route('users.index') }}">{{ __('Users') }}</a>
                                        </li>
                                    @endcan
                                    @can('manage role')
                                        <li
                                            class="nav-item">
                                            <a class="nav-link  {{ Request::route()->getName() == 'roles.index' ||Request::route()->getName() == 'roles.create' ||Request::route()->getName() == 'roles.edit'? ' active': '' }}"
                                                href="{{ route('roles.index') }}">{{ __('Role') }}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endif

                @endif



                @if (Gate::check('manage wos'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'opentask' ? 'active' : '' }}"
                            href="{{ route('opentask.index') }}">
                            <i class="fas fa-tasks"></i>{{ __('Work Order') }}
                        </a>
                    </li>
                @endif


                @if (Gate::check('manage assets'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'asset' ? 'active' : '' }}"
                            href="{{ route('asset.index') }}">
                            <i class="fas fa-boxes"></i>{{ __('Assets') }}
                        </a>
                    </li>
                @endif

                @if (Gate::check('manage parts'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'parts' ? 'active' : '' }}"
                            href="{{ route('parts.index') }}">
                            <i class="fas fa-cogs"></i>{{ __('Parts') }}
                        </a>
                    </li>
                @endif
                @if (Gate::check('manage parts'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'videos' ? 'active' : '' }}"
                            href="{{ route('videos.index') }}">
                            <i class="fas fa-cogs"></i>{{ __('Videos') }}
                        </a>
                    </li>
                @endif

                @if (Gate::check('manage pms'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'pms' ? 'active' : '' }}"
                            href="{{ route('pms.index') }}">
                            <i class="fas fa-tools"></i>{{ __('PMs') }}
                        </a>
                    </li>
                @endif

                @if (Gate::check('manage vendor'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'vendors' ? 'active' : '' }}"
                            href="{{ route('vendors.index') }}">
                            <i class="far fa-address-card"></i>{{ __('Vendor') }}
                        </a>
                    </li>
                @endif


                @if (Gate::check('manage pos'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'pos' ? 'active' : '' }}"
                            href="{{ route('pos.index') }}">
                            <i class="fas fa-file-invoice-dollar"></i>{{ __('POs') }}
                        </a>
                    </li>
                @endif

                @if (Gate::check('manage pos'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'calender' ? 'active' : '' }}"
                            href="{{ route('calender') }}">
                            <i class="fas fa-calendar-alt"></i>{{ __('Calendar') }}
                        </a>
                    </li>
                @endif

                @if (Auth::user()->user_type == 'company')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::route()->getName() == 'plans.index' ? ' active' : '' }}"
                            href="{{ route('plans.index') }}">
                            <i class="fas fa-trophy"></i>
                            <span> {{ __('Plan') }} </span>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->user_type == 'company')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'user' ? 'active' : '' }}"
                            href="{{ route('user.settings') }}">
                            <i class="fas fa-cog"></i>{{ __('Company Settings') }}
                        </a>
                    </li>
                @endif





            </ul>
        </div>
    </div>
</div> --}}

@php
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');
    $users=\Auth::user();
    $profile=asset(Storage::url('uploads/avatar/'));
    $currantLang = $users->currentLanguage();
    $logo = Utility::get_superadmin_logo();
    
    $mode_setting = \App\Models\Utility::mode_layout();
@endphp
<!-- [ navigation menu ] start -->
<nav
    class="dash-sidebar light-sidebar  {{ isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on' ? 'transprent-bg' : '' }}">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ asset(Storage::url('logo/'.$logo)) }}" alt="{{ env('header_text') }}" alt="" class="logo logo-lg" />
                <img src="{{ asset(Storage::url('logo/'.$logo)) }}" alt="{{ env('header_text') }}" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="dash-navbar">
                <li class="dash-item {{ Request::route()->getName() == 'home' ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-home"></i></span><span class="dash-mtext">{{ __('Dashboard') }}</span></a>

                </li>
                @if (Auth::user()->user_type == 'super admin')
                    <li class="dash-item {{ Request::route()->getName() == 'users.index' ? ' active' : '' }}">
                        <a href="{{ route('users.index', '') }}" class="dash-link  "><span
                                class="dash-micon"><i class="ti ti-user"></i></span><span class="dash-mtext">{{ __('Users') }}</span></a>
                    </li>

                    <li class="dash-item {{ Request::route()->getName() == 'plans.index' ? ' active' : '' }}">
                        <a href="{{ route('plans.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-trophy"></i></span><span class="dash-mtext">{{ __('Plan') }}</span></a>
                    </li>

                    <li class="dash-item {{ request()->is('plan_request*') ? 'active' : '' }}">
                        <a href="{{ route('plan_request.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-brand-telegram"></i></span><span class="dash-mtext">{{ __('Plan Request') }}</span></a>
                    </li>

                    <li class="dash-item {{ Request::route()->getName() == 'order.index' ? ' active' : '' }}">
                        <a href="{{ route('order.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-user"></i></span><span class="dash-mtext">{{ __('Orders') }}</span></a>
                    </li>

                    <li class="dash-item {{ Request::route()->getName() == 'coupons.index' || Request::segment(1) == 'coupons' ? ' active' : '' }}">
                        <a href="{{ route('coupons.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-discount-2"></i></span><span class="dash-mtext">{{ __('Coupon') }}</span></a>
                    </li>

                    <li class="dash-item {{ (Request::segment(1) == 'manage-language')?'active':''}}">
                        <a href="{{route('manage.language',[$currantLang])}}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-language"></i></span><span class="dash-mtext">{{ __('Language') }}</span></a>
                    </li>

                    

                    <li class="dash-item {{ Request::route()->getName() == 'settings.index' ? ' active' : '' }}">
                        <a href="{{ route('settings.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">{{ __('Settings') }}</span></a>
                    </li>
                @endif

                @if (\Auth::user()->user_type == 'company')
                    @if (Gate::check('manage location'))
                        @can('create location')
                            <li class="dash-item {{ Request::segment(1) == 'location' ? 'active' : '' }}">
                                <a href="{{ route('location.index') }}" class="dash-link"><span
                                        class="dash-micon"><i class="ti ti-current-location"></i></span><span class="dash-mtext">{{ __('Location') }}</span></a>
                            </li>
                            @endcan
                    @endif
                @endif




                @if (\Auth::user()->user_type == 'company')
                    @if (Gate::check('manage user') || Gate::check('manage role'))
                        <li class="dash-item dash-hasmenu">
                            <a class="dash-link {{ (Request::segment(1) == 'employee' || Request::segment(1) == 'client')?'active':''}}"
                                data-toggle="collapse" role="button"
                                aria-expanded="{{ (Request::segment(1) == 'employee' || Request::segment(1) == 'client')?'true':'false'}}"
                                aria-controls="navbar-getting-started"><span class="dash-micon"><i
                                        class="ti ti-users"></i></span><span class="dash-mtext">{{ __('Staff') }}</span><span
                                    class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'users')?'active open':''}}">
                                    <a class="dash-link" {{ Request::route()->getName() == 'users.index' ||Request::route()->getName() == 'users.create' ||Request::route()->getName() == 'users.edit'? ' active': '' }} href="{{ route('users.index') }}">{{ __('Users') }}</span></a>

                                </li>
                                <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'roles')?'active open':''}}">
                                    <a class="dash-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>

                                </li>

                            </ul>
                        </li>
                    @endif
                @endif

            @if (Gate::check('manage wos'))
                <li class="dash-item {{ Request::segment(1) == 'opentask' ? 'active' : '' }}">
                    <a href="{{ route('opentask.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-clipboard-check"></i></span><span class="dash-mtext">{{ __('Work Order') }}</span></a>
                </li>
            @endif

            @if (Gate::check('manage assets'))
            <li class="dash-item {{ Request::segment(1) == 'asset' ? 'active' : '' }}">
                <a href="{{ route('asset.index') }}" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-box"></i></span><span class="dash-mtext">{{ __('Assets') }}</span></a>
            </li>

        @endif

        @if (Gate::check('manage parts'))
        <li class="dash-item {{ Request::segment(1) == 'parts' ? 'active' : '' }}">
            <a href="{{ route('parts.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-circles"></i></span><span class="dash-mtext">{{ __('Parts') }}</span></a>
        </li>
        @endif

        @if (Gate::check('manage parts'))
        <li class="dash-item {{ Request::segment(1) == 'videos' ? 'active' : '' }}">
            <a href="{{ route('videos.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-circles"></i></span><span class="dash-mtext">{{ __('Videos') }}</span></a>
        </li>
        @endif

        @if (Gate::check('manage pms'))
        <li class="dash-item {{ Request::segment(1) == 'pms' ? 'active' : '' }}">
            <a href="{{ route('pms.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-tools"></i></span><span class="dash-mtext">{{ __('PMs') }}</span></a>
        </li>
        @endif

        @if (Gate::check('manage vendor'))
        <li class="dash-item {{ Request::segment(1) == 'vendors' ? 'active' : '' }}">
            <a href="{{ route('vendors.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-credit-card"></i></span><span class="dash-mtext">{{ __('Vendor') }}</span></a>
        </li>
        @endif


        @if (Gate::check('manage pos'))
        <li class="dash-item {{ Request::segment(1) == 'pos' ? 'active' : '' }}">
            <a href="{{ route('pos.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-currency-dollar"></i></span><span class="dash-mtext">{{ __('POs') }}</span></a>
        </li>
        @endif

        @if (Gate::check('manage pos'))
        <li class="dash-item {{ Request::segment(1) == 'calender' ? 'active' : '' }}">
            <a href="{{ route('calender') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-calendar"></i></span><span class="dash-mtext">{{ __('Calendar') }}</span></a>
        </li>

        @endif

        @if (Auth::user()->user_type == 'company')
        <li class="dash-item {{ Request::route()->getName() == 'plans.index' ? ' active' : '' }}">
            <a href="{{ route('plans.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-trophy"></i></span><span class="dash-mtext">{{ __('Plan') }}</span></a>
        </li>
        @endif

        @if (\Auth::user()->user_type == 'company')
        <li class="dash-item {{ Request::segment(1) == 'user' ? 'active' : '' }}">
            <a href="{{ route('user.settings') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-settings"></i></span><span class="dash-mtext">{{ __('Company Settings') }}</span></a>
        </li>

        @endif
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
