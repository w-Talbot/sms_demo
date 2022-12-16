@extends('layouts.app', [
    'title' => __('User Profile'),
    'navClass' => 'bg-default',
    'parentSection' => 'laravel',
    'elementName' => 'profile'
])


@section('content')
{{--    @include('forms.header', [--}}
{{--        'title' => __('Hello') . ' '. auth()->user()->name,--}}
{{--        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),--}}
{{--        'class' => 'col-lg-7'--}}
{{--    ])--}}

@include('forms.header', [
    'title' => auth()->user()->name,
    'class' => 'col-lg-7'
])


    <div class="container-fluid mt--6">
        <div class="row">
{{--            <div class="col-xl-4 order-xl-2">--}}

{{--            </div>--}}
            <div class="col-xl-8 order-xl-1">
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}

{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}

{{--                    </div>--}}
{{--                </div>--}}
                <div class="card" style="width: 60rem;">
                    <div class="card-header" id="profile">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                            </div>
{{--                            <div class="col-4 text-right">--}}
{{--                                <a href="#!" class="btn btn-sm btn-primary">{{ __('Settings') }}</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                            @include('alerts.success')
                            @include('alerts.error_self_update', ['key' => 'not_allow_profile'])

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required >
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
{{--				                <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">--}}
{{--                                    <label class="form-control-label">{{ __('Profile photo') }}</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <label class="custom-file-label" for="input-picture">{{ auth()->user()->profilePicture() ? str_replace("/profile_user/", "", auth()->user()->profilePicture()) : __('Select profile photo') }}</label>--}}
{{--                                        <input type="file" name="photo" class="custom-file-input{{ $errors->has('photo') ? ' is-invalid' : '' }}" id="input-picture" accept="image/*">--}}

{{--                                    </div>--}}

{{--                                    @include('alerts.feedback', ['field' => 'photo'])--}}
{{--                                </div>--}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @include('alerts.success', ['key' => 'password_status'])
                            @include('alerts.error_self_update', ['key' => 'not_allow_password'])

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>

                                    @include('alerts.feedback', ['field' => 'old_password'])
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>

                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
