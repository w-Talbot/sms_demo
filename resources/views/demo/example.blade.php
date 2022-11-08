
    <!doctype html>
<html lang="en">

<head>
    <title>Add or Remove Input Fields Dynamically</title>
    <link rel="stylesheet" href=
        "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href=
        "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            margin-top: 1%;
            justify-content: center;
            align-items: center;
        }

        #rowAdder {
            margin-left: 17px;
        }
    </style>
</head>

<body>
<h2 style="color:green">GeeksforGeeks</h2>
<strong> Adding and Deleting Input fields Dynamically</strong>

<div style="width:40%;">

    <form>
        <div class="">
            <div class="col-lg-12">
                <div id="row">
                    <div class="input-group m-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-danger"
                                    id="DeleteRow" type="button">
                                <i class="bi bi-trash"></i>
                                Delete
                            </button>
                        </div>
                        <input type="text"
                               class="form-control m-input">
                    </div>
                </div>

                <div id="newinput"></div>
                <button id="rowAdder" type="button"
                        class="btn btn-dark">
						<span class="bi bi-plus-square-dotted">
						</span> ADD
                </button>
            </div>
        </div>
    </form>
</div>






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

            <li class="breadcrumb-item"><a href="#">{{ __('Configuration') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('New Study Configuration') }}</li>
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
                        <form method="post" class="item-form" action="/manage" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('General') }}</h6>
                            <div class="pl-lg-4">
                                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="form-group">
                                    <label class="form-control-label" for="study_name">Study Name:</label>
                                    <input type="text" name="study_name" id="study_name" class="form-control" placeholder="{{ __('Name of study') }}" value="{{ old('study-name') }}" required autofocus>

                                    @error('study_name')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                                                <div class="form-group{{ $errors->has('api') ? ' has-danger' : '' }}">
                                <div class="form-group">
                                    <label class="form-control-label" for="api">API:</label>

                                    <input type="text" name="api" id="api" class="form-control" placeholder="{{ __('ex: AAB1234CDE456G789HIJ10K') }}" value="{{ old('api') }}" required autofocus>
                                    @error('api')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                                                    <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="url">Study URL:</label>
                                    <input type="text" name="url" id="url" class="form-control" placeholder="{{ __('ex: https://magcap.phc.ox.ac.uk/') }}" value="{{ old('url') }}" required autofocus>
                                    @error('study_name')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">{{ __('When to send invitations') }}</h6>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <div class="form-group{{ $errors->has('rc-var') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">REDCap Variable to Calculate from</label>
                                        <input type="text" name="rc-var" id="input-rc-var" class="form-control" placeholder="{{ __('Please type variable as in REDCap including event ex: [baseline_arm_1][var_name]') }}" value="{{ old('rc-var') }}" required autofocus>

                                        @error('rc-var')
                                        <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pl-lg-4">

                                    <div class="pl-lg-4">

                                                <button type="button" class="btn btn-primary">Add another trigger</button>

                                            </div>
                                            @include('alerts.feedback', ['field' => 'category_id'])
                                        </div>
                                    </div>


                                                                    <button type="button" class="btn btn-success">Save</button>
                                    <button type="submit" class="btn btn-success mt-4">Save</button>
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
    <script type="text/javascript">

        $("#rowAdder").click(function () {
            newRowAdd =


                '<div id="addrow"><h6 class="heading-small text-muted mb-4">When to send invitations</h6>' +
                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="input-name">REDCap Variable to Calculate from</label>' +
                '<input type="text" name="rc-var" id="input-rc-var" class="form-control" placeholder="[baseline_arm_1][var_name])" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="input-logic">Logic (optional)</label>' +
                '<input type="text" name="days" id="input-num-days" class="form-control" placeholder="[baseline_arm_1][var_name] = 1" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="input-timer">Send SMS after # days</label>' +
                '<input type="text" name="num-days" id="input-num-days" class="form-control" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="input-timer">Send every # days:</label>' +
                '<input type="text" name="days" id="input-num-days" class="form-control" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="recurrence">Number of recurrences:</label>' +
                '<input type="text" name="recurrence" id="recurrence" class="form-control" required autofocus>' +
                '</div></div>'+

                '<div class="input-group m-3">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger" id="DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> Remove Invitation</button> </div>' +
                ' </div> </div>';

            $('#newinput').append(newRowAdd);
        });

        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#addrow").remove();
        })
    </script>
    <script src="{{ asset('argon') }}/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/quill/dist/quill.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/js/items.js"></script>
@endpush
