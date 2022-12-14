{{--<h1>DEMO</h1>--}}

{{--        <h2>--}}
{{--            {{$study->study_name}}--}}
{{--        </h2>--}}
{{--        <p>--}}
{{--            {{$study->api}}--}}
{{--        </p>--}}




@extends('layouts.app', [
    'title' => __('Study'),
    'parentSection' => 'laravel',
    'elementName' => 'study-create'
])

@section('content')
    @component('layouts.headers.auth')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Configuration') }}
            @endslot

            <li class="breadcrumb-item"><a href="{{ route('item.index') }}">{{ __('Configuration') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Study Configuration') }}</li>
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
{{--                                <h3 class="mb-0">{{ __('Study Config') }}</h3>--}}
                                <h3 class="mb-0">{{$study->study_name}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/manage/index" class="btn btn-sm btn-primary">{{ __('Back to study list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
{{--                        <form method="post" class="item-form" action="{{ route('item.store') }}" autocomplete="off" enctype="multipart/form-data">--}}
                        <form method="post" class="item-form" action="#" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('General') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Study Name:</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name of study') }}" value="{{$study->study_name}}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                @include('alerts.feedback', ['field' => 'category_id'])
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">API:</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('ex: AAB1234CDE456G789HIJ10K') }}" value="{{$study->api}}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                @include('alerts.feedback', ['field' => 'category_id'])
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Study URL:</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('ex: https://magcap.phc.ox.ac.uk/') }}" value="{{$study->url}}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                @include('alerts.feedback', ['field' => 'category_id'])
                            </div>
                            <h6 class="heading-small text-muted mb-4">{{ __('Invitations:') }}</h6>
{{--                            @foreach($studies as $study)--}}
                                <h6 class="heading-small text-muted mb-4">{{ __('Invitation 1') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">REDCap Variable to Calculate from</label>
                                        <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Please type variable as in REDCap including event ex: [baseline_arm_1][var_name]') }}" value="{{ old('name') }}" required autofocus>

                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    @include('alerts.feedback', ['field' => 'category_id'])
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">How many days to trigger</label>
                                        <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('#') }}" value="{{ old('name') }}" required autofocus>

                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    @include('alerts.feedback', ['field' => 'category_id'])
                                </div>

                                <div class="pl-lg-4">

                                    <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">


                                        <label class="form-control-label" for="input-role">Trigger</label>
                                        <div class = "container">

                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Send every
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <select name="#" id="#" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}" required>
                                                        <option value="">--Select Day--</option>

                                                        <option value="imd_score" >Day</option>
                                                        <option value="imd_score" >Weekday</option>
                                                        <option value="imd_score" >Weekend Day</option>
                                                        <option value="imd_score" >Sunday</option>
                                                        <option value="imd_score" >Monday</option>
                                                        <option value="imd_score" >Tuesday</option>
                                                        <option value="imd_score" >Wednesday</option>
                                                        <option value="imd_score" >Thursday</option>
                                                        <option value="imd_score" >Friday</option>
                                                        <option value="imd_score" >Saturday</option>

                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="example-time-input" class="form-control-label">At time</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{--                                                    <label for="example-time-input" class="form-control-label">Time</label>--}}
                                                        <input class="form-control" type="time" value="10:30:00" id="example-time-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Send every
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('7') }}" value="#" required autofocus>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="example-time-input" class="form-control-label"> Days</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('0') }}" value="#" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="example-time-input" class="form-control-label"> Hours</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="#" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('0') }}" value="#" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="example-time-input" class="form-control-label"> Minutes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Send at exact date/time:
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="example-datetime-local-input" class="form-control-label">Datetime</label>
                                                        <input class="form-control" type="datetime-local" value="2018-11-23T10:30:00" id="example-datetime-local-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            Recurrence:
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <select name="#" id="#" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}" required>
                                                        <option value="">--Select Recurrence--</option>

                                                        <option value="imd_score" >Send only once</option>
                                                        <option value="imd_score" >Send up to 2 times</option>
                                                        <option value="imd_score" >Send up to 3 times</option>
                                                        <option value="imd_score" >Send up to 4 times</option>
                                                        <option value="imd_score" >Send up to 5 times</option>

                                                    </select>
                                                </div>
                                            </div>
{{--                                            @endforeach--}}

                                            <button type="button" class="btn btn-primary">Edit</button>

                                        </div>
                                        @include('alerts.feedback', ['field' => 'category_id'])
                                    </div>
                                </div>
{{--                                <button type="button" class="btn btn-success">Save</button>--}}
                    </div>
                    </form>
                </div>



            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/quill/dist/quill.core.css">

@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/quill/dist/quill.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/js/items.js"></script>
@endpush


