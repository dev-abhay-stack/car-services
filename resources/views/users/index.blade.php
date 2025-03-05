@extends('layouts.admin')
@section('page-title')
    {{ __('Manage User') }}
@endsection

@section('action-button')
<a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="modal"
data-bs-target="#exampleModal" data-url="{{ route('users.create')}}" data-size="lg"
data-bs-whatever="{{__('Create New User')}}"> <span class="text-white">
    <i class="ti ti-plus" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"></i></span>
</a>


@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('User')}}</li>
@endsection

@section('content')
    @if (Auth::user()->location_id || Auth::user()->user_type == 'super admin')
        <div class="row">
            @foreach ($users as $user)
                @php($location_id = Auth::user()->location_id)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="card">
                        <div class=" border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    @if (Auth::user()->user_type == 'super admin' && isset($user->getPlan))
                                        <div class="badge bg-primary p-2 px-3 rounded ms-2">{{ $user->getPlan->name }}</div>
                                    @else
                                        @if ($user->permission == 'Owner')
                                            <div class="badge bg-danger p-2 px-3 rounded ms-3">{{ __('Owner') }}</div>
                                        @else
                                            <div class="badge bg-danger p-2 px-3 rounded ms-3">{{ __('Member') }}</div>
                                        @endif
                                    @endif
                                </h6>
                                @if ((Auth::user()->user_type == 'super admin' || Auth::user()->user_type == 'company') && (Gate::check('edit user') || Gate::check('delete user')))
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @if (Auth::user()->user_type == 'super admin' && isset($user->getPlan))
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-size="lg" data-bs-whatever="{{__('Change Plan')}}" data-bs-toggle="tooltip"
                                                data-title="{{ __('Change Plan') }}"
                                                data-url="{{ route('users.change.plan', $user->id) }}">   <i class="ti ti-edit"></i>
                                                <span> {{ __('Change Plan') }} </span></a>


                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.change.plan', $user->id]]) !!}
                                                <a href="#!" class="dropdown-item show_confirm ">
                                                    <i class="ti ti-trash"></i> {{ __('Delete') }}
                                                </a>
                                                {!! Form::close() !!}


                                                @elseif(Auth::user()->user_type=='super admin')
                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-size="lg" data-bs-whatever="{{__('Edit User')}}"
                                                    data-url="{{ route('users.edit', [$user->id]) }}">   <i class="ti ti-edit"></i>
                                                    <span> {{ __('Edit') }} </span>
                                                    </a>

                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', [$user->id]]]) !!}
                                                    <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm dropdown-item">
                                                        <i class="ti ti-trash"></i> {{__('Delete')}}
                                                    </a>
                                                    {!! Form::close() !!}



                                                    @elseif(Auth::user()->id != $user->id)
                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-size="lg" data-bs-whatever="{{__('Edit User')}}"
                                                    data-url="{{ route('users.edit', [$user->id]) }}">   <i class="ti ti-edit"></i>
                                                    {{ __('Edit') }} </a>

                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', [$user->id]]]) !!}
                                                    <a href="#!" class=" show_confirm dropdown-item ">
                                                        <i class="ti ti-trash"></i> {{__('Delete')}}
                                                    </a>
                                                    {!! Form::close() !!}

                                                    {{-- <form method="POST" action="{{ route('users.destroy', [$user->id]) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="dropdown-item show_confirm" data-toggle="tooltip"
                                                        title='Delete'> <i class="ti ti-trash"></i> <span> {{ __('Delete') }} </span>
                                                        </button>
                                                    </form> --}}
                                                @endif
                                            </div>
                                    </div>
                                @endif
                            </div>

                        </div>

                        {{-- @if ((Auth::user()->user_type == 'super admin' || Auth::user()->user_type == 'company') && (Gate::check('edit user') || Gate::check('delete user')))
                            <div class="dropdown action-item edit-profile user-text">
                                <a href="#" class="action-item p-2" role="button" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-left">
                                    @if (Auth::user()->user_type == 'super admin' && isset($user->getPlan))
                                        <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg"
                                            data-title="{{ __('Change Plan') }}"
                                            data-url="{{ route('users.change.plan', $user->id) }}">{{ __('Change Plan') }}</a>
                                        <a href="#" class="dropdown-item text-danger"
                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                            data-confirm-yes="document.getElementById('delete_user_{{ $user->id }}').submit();">{{ __('Delete') }}</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                            id="delete_user_{{ $user->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    @elseif(Auth::user()->user_type=='super admin')
                                        <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md"
                                            data-title="{{ __('Edit User') }}"
                                            data-url="{{ route('users.edit', [$user->id]) }}">{{ __('Edit') }}</a>
                                        <a href="#" class="dropdown-item text-danger"
                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                            data-confirm-yes="document.getElementById('remove_user_{{ $user->id }}').submit();">{{ __('Remove Company') }}</a>
                                        <form action="{{ route('users.destroy', [$user->id]) }}" method="post"
                                            id="remove_user_{{ $user->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @elseif(Auth::user()->id != $user->id)
                                        <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md"
                                            data-title="{{ __('Edit User') }}"
                                            data-url="{{ route('users.edit', [$user->id]) }}">{{ __('Edit') }}</a>
                                        <a href="#" class="dropdown-item text-danger"
                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                            data-confirm-yes="document.getElementById('remove_user_{{ $user->id }}').submit();">{{ __('Remove User From Location') }}</a>
                                        <form action="{{ route('users.destroy', [$user->id]) }}" method="post"
                                            id="remove_user_{{ $user->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif --}}
                        <div class="card-body text-center pb-3">
                            <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3 user_image">
                                <img src="{{ !empty($user->avatar)? asset(Storage::url('avatars/' . $user->avatar)): asset(Storage::url('avatars/avatar.png')) }}">
                            </a>
                            <h5 class="h6 mt-4 mb-0">
                                <a href="#" class="text-title">{{ $user->name }}</a>
                            </h5>
                            <span>{{ $user->email }}</span>
                            <hr class="my-3">
                            <div class="row align-items-center">
                                @if (Auth::user()->user_type == 'super admin')
                                    <div class="col-4">
                                        <div class="h6 mb-0">{{ $user->countLocation() }}</div>
                                        <span class="text-sm text-muted">{{ __('Location') }}</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="h6 mb-0">{{ $user->countWorkOrder() }}</div>
                                        <span class="text-sm text-muted">{{ __('Work Order') }}</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="h6 mb-0">{{ $user->countUsers($location_id) }}</div>
                                        <span class="text-sm text-muted">{{ __('Users') }}</span>
                                    </div>
                                @endif
                            </div>
                            <p class="mt-2 mb-0">
                                @if (Auth::user()->user_type == 'super admin' && isset($user->getPlan))
                                    <button class="btn btn-sm btn-neutral mt-3 font-weight-500">
                                        @if (!empty($user->plan_expire_date))
                                            <a>{{ $user->is_trial_done == 1 ? __('Plan Trial') : __('Plan') }}
                                                {{ $user->plan_expire_date < date('Y-m-d') ? __('Expired') : __('Expires') }}
                                                {{ __(' on ') }}
                                                {{ date('d M Y', strtotime($user->plan_expire_date)) }}</a>
                                        @else
                                            <a>{{ __('Unlimited') }}</a>
                                        @endif
                                    </button>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-xl-3 col-lg-4 col-sm-6"> 
                <a href="#" class="btn-addnew-project "  data-bs-toggle="modal"
                data-bs-target="#exampleModal" data-url="{{ route('users.create')}}" data-size="lg" data-bs-whatever="{{__('Create New User')}}">
                    <div class="bg-primary proj-add-icon">
                        <i class="ti ti-plus"></i>
                    </div>
                    <h6 class="mt-4 mb-2">{{ __('New User') }}</h6>
                    <p class="text-muted text-center">{{ __('Click here to add new user') }}</p>
                </a>
            </div>
        </div>
    @else
        <div class="container mt-5">
            <div class="card">
                <div class="card-body p-4">
                    <div class="page-error">
                        <div class="page-inner">
                            <h1>404</h1>
                            <div class="page-description">
                                {{ __('Page Not Found') }}
                            </div>
                            <div class="page-search">
                                <p class="text-muted mt-3">
                                    {{ __("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.") }}
                                </p>
                                <div class="mt-3">
                                    <a class="btn-return-home badge-blue" href="{{ route('home') }}"><i
                                            class="fas fa-reply"></i> {{ __('Return Home') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif













@endsection
