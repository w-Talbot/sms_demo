@extends('layouts.app', [
    'title' => __('New Study'),
    'parentSection' => 'laravel',
    'elementName' => 'study-create'
])

@section('content')
    @component('layouts.headers.auth')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('#') }}
            @endslot

            <li class="breadcrumb-item"><a href="#">{{ __('Edit Configuration') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Study Configuration') }}</li>
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Study Config Form') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/manage/index" class="btn btn-sm btn-primary">{{ __('Back to study list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" class="item-form" action="/manage/{{$study->id}}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h6 class="heading-small text-muted mb-4">{{ __('General') }}</h6>
                            <div class="pl-lg-4">
                                {{--                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
                                <div class="form-group">
                                    <label class="form-control-label" for="study_name">Study Name:</label>
                                    <input type="text" name="study_name" id="study_name" class="form-control"  value="{{$study->study_name}}" required autofocus>

                                    @error('study_name')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                {{--                                <div class="form-group{{ $errors->has('api') ? ' has-danger' : '' }}">--}}
                                <div class="form-group">
                                    <label class="form-control-label" for="api">API:</label>

                                    <input type="text" name="api" id="api" class="form-control" value="{{$study->api}}" required autofocus>
                                    @error('api')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    {{--                                <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">--}}
                                    <label class="form-control-label" for="url">Study URL:</label>
                                    <input type="text" name="url" id="url" class="form-control"  value="{{$study->url}}" required autofocus>
                                    @error('study_name')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            {{--                            <h6 class="heading-small text-muted mb-4">{{ __('When to send invitations') }}</h6>--}}

                            {{--                            <div class="pl-lg-4">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                <div class="form-group{{ $errors->has('rc-var') ? ' has-danger' : '' }}">--}}
                            {{--                                    <label class="form-control-label" for="input-name">REDCap Variable to Calculate from</label>--}}
                            {{--                                    <input type="text" name="rc-var" id="input-rc-var" class="form-control" placeholder="{{ __('Please type variable as in REDCap including event ex: [baseline_arm_1][var_name]') }}" value="{{ old('rc-var') }}" required autofocus>--}}

                            {{--                                    @error('rc-var')--}}
                            {{--                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="pl-lg-4">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                <div class="form-group{{ $errors->has('num-days') ? ' has-danger' : '' }}">--}}
                            {{--                                    <label class="form-control-label" for="input-timer">How many days to trigger</label>--}}
                            {{--                                    <input type="text" name="num-days" id="input-num-days" class="form-control" placeholder="{{ __('#') }}" value="{{ old('num-days') }}" required autofocus>--}}

                            {{--                                    @error('num-days')--}}
                            {{--                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                            </div>--}}

                            {{--                            <div class="pl-lg-4">--}}

                            {{--                                <div class="form-group{{ $errors->has('invitation-group') ? ' has-danger' : '' }}">--}}


                            {{--                                    <label class="form-control-label" for="input-role">Trigger</label>--}}
                            {{--                                    <div class = "container">--}}
                            {{--                                        <div class="row">--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <div class="form-check">--}}
                            {{--                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">--}}
                            {{--                                                    <label class="form-check-label" for="flexCheckDefault">--}}
                            {{--                                                        Send every--}}
                            {{--                                                    </label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-4">--}}
                            {{--                                                <select name="#" id="#" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}" required>--}}
                            {{--                                                    <option value="">--Select Day--</option>--}}

                            {{--                                                    <option value="imd_score" >Day</option>--}}
                            {{--                                                    <option value="imd_score" >Weekday</option>--}}
                            {{--                                                    <option value="imd_score" >Weekend Day</option>--}}
                            {{--                                                    <option value="imd_score" >Sunday</option>--}}
                            {{--                                                    <option value="imd_score" >Monday</option>--}}
                            {{--                                                    <option value="imd_score" >Tuesday</option>--}}
                            {{--                                                    <option value="imd_score" >Wednesday</option>--}}
                            {{--                                                    <option value="imd_score" >Thursday</option>--}}
                            {{--                                                    <option value="imd_score" >Friday</option>--}}
                            {{--                                                    <option value="imd_score" >Saturday</option>--}}

                            {{--                                                </select>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label for="example-time-input" class="form-control-label">At time</label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label for="example-time-input" class="form-control-label">Time</label>--}}
                            {{--                                                    <input class="form-control" type="time" value="10:30:00" id="example-time-input">--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="row">--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <div class="form-check">--}}
                            {{--                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">--}}
                            {{--                                                    <label class="form-check-label" for="flexCheckDefault">--}}
                            {{--                                                        Send every--}}
                            {{--                                                    </label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <input type="text" name="days" id="input-days" class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" placeholder="{{ __('7') }}" value="#" required autofocus>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label for="example-time-input" class="form-control-label"> Days</label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <input type="text" name="hours" id="input-hours" class="form-control{{ $errors->has('hours') ? ' is-invalid' : '' }}" placeholder="{{ __('0') }}" value="#" required autofocus>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label for="example-time-input" class="form-control-label"> Hours</label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <input type="text" name="mins" id="#" class="form-control{{ $errors->has('mins') ? ' is-invalid' : '' }}" placeholder="{{ __('0') }}" value="#" required autofocus>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-2">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label for="example-time-input" class="form-control-label"> Minutes</label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="row">--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <div class="form-check">--}}
                            {{--                                                    <input class="form-check-input" type="checkbox" value="" id="exact-d-t-text">--}}
                            {{--                                                    <label class="form-check-label" for="exact-d-t-text">--}}
                            {{--                                                        Send at exact date/time:--}}
                            {{--                                                    </label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <div class="form-group">--}}
                            {{--                                                    <label for="exact-d-t" class="form-control-label">Datetime</label>--}}
                            {{--                                                    <input class="form-control" type="datetime-local" value="2018-11-23T10:30:00" id="exact-d-t">--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="row">--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <div class="form-check">--}}
                            {{--                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">--}}
                            {{--                                                    <label class="form-check-label" for="flexCheckDefault">--}}
                            {{--                                                        Recurrence:--}}
                            {{--                                                    </label>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col">--}}
                            {{--                                                <select name="recurrence" id="input-recurrence" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}" required>--}}
                            {{--                                                    <option value="">--Select Recurrence--</option>--}}

                            {{--                                                    <option value="imd_score" >Send only once</option>--}}
                            {{--                                                    <option value="imd_score" >Send up to 2 times</option>--}}
                            {{--                                                    <option value="imd_score" >Send up to 3 times</option>--}}
                            {{--                                                    <option value="imd_score" >Send up to 4 times</option>--}}
                            {{--                                                    <option value="imd_score" >Send up to 5 times</option>--}}

                            {{--                                                </select>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}

                            {{--                                        <button type="button" class="btn btn-primary">Add another trigger</button>--}}

                            {{--                                    </div>--}}
                            {{--                                    @include('alerts.feedback', ['field' => 'category_id'])--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}


                            {{--                                <button type="button" class="btn btn-success">Save</button>--}}
                            <button type="submit" class="btn btn-success mt-4">Update</button>
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
