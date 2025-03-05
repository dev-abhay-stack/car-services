@php
$mode_setting = \App\Models\Utility::mode_layout();
$currentlocation = User::userCurrentLocation();
@endphp
<header
    class="dash-header  {{ isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on' ? 'transprent-bg' : '' }}">
    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>
               
                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img class="theme-avtar"
                            @if (!empty($users->avatar)) src="{{ '/' . $users->avatar }}" @else  avatar="{{ $users->name }}" @endif></span>
                        <span class="hide-mob ms-2">{{ $users->name }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="{{ route('my.account') }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>

                        <hr>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                @if (Auth::user()->user_type == 'company')
                    @if (Gate::check('manage location'))
                        <li class="dropdown dash-h-item drp-language">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="ti ti-current-location"></i>
                                <span class="drp-text hide-mob">
                                    @foreach (Auth::user()->location as $location)
                                        @if ($currentlocation == $location->id)
                                            {{ $location->name }}
                                        @endif
                                    @endforeach
                                </span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">

                                @foreach (Auth::user()->location as $location)
                                    <a href="@if (isset($currentlocation) && $currentlocation == $location->id) #@else  {{ route('change-location', $location->id) }} @endif"
                                        title="{{ $location->name }}" class="dropdown-item px-4 mt-2">
                                        @if ($currentlocation == $location->id)
                                            <i class="fa fa-check text-success"></i>
                                        @endif
                                        <span>{{ $location->name }}</span>
                                    </a>
                                @endforeach



                            </div>
                        </li>
                    @endif
                @endif

                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob">{{ Str::upper($currantLang) }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        @if (\Auth::user()->type == 'company')
                            <a href="{{ route('manage.language', [$currantLang]) }}" class="dropdown-item">
                                <span> {{ __('Create & Customize') }}</span>
                            </a>
                        @endif
                        @if (\Auth::user()->user_type == 'super admin' || \Auth::user()->user_type == 'company' || Auth::user()->user_type == 'employee')
                            @foreach (\App\Models\Utility::languages() as $lang)
                                <a href="{{ route('change_lang_admin', $lang) }}"
                                    class="dropdown-item {{ $currantLang == $lang ? 'text-danger' : '' }}">
                                    <span class="small">{{ Str::upper($lang) }}</span>
                                </a>
                            @endforeach

                        @endif



                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
