

<html>
<head>
    <script type='text/javascript'>
        function addFields(){
            // Generate a dynamic number of inputs
            var number = 5;
            // Get the element where the inputs will be added to
            var container = document.getElementById("container");
            // Remove every children it had before
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=0;i<number;i++){
                // Append a node with a random text
                container.appendChild(document.createTextNode("Member " + (i+1)));
                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.name = "member" + i;
                container.appendChild(input);
                // Append a line break
                container.appendChild(document.createElement("br"));
            }
        }
    </script>
</head>
<body>
<input type="text" id="member" name="member" value="">Number of members: (max. 10)<br />
<a href="#" id="filldetails" onclick="addFields()">Fill Details</a>
<div id="container"/>
</body>
</html>










{{--@extends('layouts.app', [--}}
{{--    'title' => __('New Study'),--}}
{{--    'parentSection' => 'laravel',--}}
{{--    'elementName' => 'study-create'--}}
{{--])--}}

{{--@section('content')--}}
{{--    @component('layouts.headers.auth')--}}
{{--        @component('layouts.headers.breadcrumbs')--}}
{{--            @slot('title')--}}
{{--                {{ __('#') }}--}}
{{--            @endslot--}}

{{--            <li class="breadcrumb-item"><a href="#">{{ __('Configuration') }}</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">{{ __('New Study Configuration') }}</li>--}}
{{--        @endcomponent--}}
{{--    @endcomponent--}}

{{--    <div class="container-fluid mt--6">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xl-12 order-xl-1">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-8">--}}
{{--                                <h3 class="mb-0">{{ __('Study Config Form') }}</h3>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-right">--}}
{{--                                <a href="/manage/index" class="btn btn-sm btn-primary">{{ __('Back to study list') }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form method="post" class="item-form" action="/manage" autocomplete="off" enctype="multipart/form-data">--}}
{{--                            @csrf--}}

{{--                            <h6 class="heading-small text-muted mb-4">{{ __('General') }}</h6>--}}
{{--                            <div class="pl-lg-4">--}}
{{--                                --}}{{--                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="study_name">Study Name:</label>--}}
{{--                                    <input type="text" name="study_name" id="study_name" class="form-control" placeholder="{{ __('Name of study') }}" value="{{ old('study-name') }}" required autofocus>--}}

{{--                                    @error('study_name')--}}
{{--                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pl-lg-4">--}}
{{--                                --}}{{--                                <div class="form-group{{ $errors->has('api') ? ' has-danger' : '' }}">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="api">API:</label>--}}

{{--                                    <input type="text" name="api" id="api" class="form-control" placeholder="{{ __('ex: AAB1234CDE456G789HIJ10K') }}" value="{{ old('api') }}" required autofocus>--}}
{{--                                    @error('api')--}}
{{--                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    --}}{{--                                <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">--}}
{{--                                    <label class="form-control-label" for="url">Study URL:</label>--}}
{{--                                    <input type="text" name="url" id="url" class="form-control" placeholder="{{ __('ex: https://magcap.phc.ox.ac.uk/') }}" value="{{ old('url') }}" required autofocus>--}}
{{--                                    @error('study_name')--}}
{{--                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            --}}{{--                            <h6 class="heading-small text-muted mb-4">{{ __('When to send invitations') }}</h6>--}}

{{--                            <h6 class="heading-small text-muted mb-4">Invitations</h6>--}}
{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="input-name">REDCap Variable to Calculate from</label>--}}
{{--                                    <input type="text" name="rc-var" id="input-rc-var" class="form-control" placeholder="[baseline_arm_1][var_name])" required autofocus>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="input-logic">Logic (optional)</label>--}}
{{--                                    <input type="text" name="days" id="input-num-days" class="form-control" placeholder="[baseline_arm_1][var_name] = 1" required autofocus>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="input-timer">Send SMS after # days</label>--}}
{{--                                    <input type="text" name="num-days" id="input-num-days" class="form-control" required autofocus>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="input-timer">Send every # days:</label>--}}
{{--                                    <input type="text" name="days" id="input-num-days" class="form-control" required autofocus>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="recurrence">Number of recurrences:</label>--}}
{{--                                    <input type="text" name="recurrence" id="recurrence" class="form-control" required autofocus>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div id="newinput"></div>--}}
{{--                            <button type="button" id="rowAdder" class="btn btn-primary">Add another invitation</button>--}}


{{--                            <button type="submit" class="btn btn-success mt-4">Save</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}


{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @include('layouts.footers.auth')--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@push('css')--}}
{{--    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/select2/dist/css/select2.min.css">--}}
{{--    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/quill/dist/quill.core.css">--}}
{{--    <link rel="stylesheet" href=--}}
{{--        "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href=--}}
{{--        "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">--}}
{{--@endpush--}}

{{--@push('js')--}}
{{--    <script type="text/javascript">--}}

{{--        $("#rowAdder").click(function () {--}}
{{--            newRowAdd =--}}

{{--                '<div id="addrow"><h6 class="heading-small text-muted mb-4">--Invitation--</h6>' +--}}
{{--                '<div class="pl-lg-4">' +--}}
{{--                '<div class="form-group">' +--}}
{{--                '<label class="form-control-label" for="input-name">REDCap Variable to Calculate from</label>' +--}}
{{--                '<input type="text" name="rc-var" id="input-rc-var" class="form-control" placeholder="[baseline_arm_1][var_name])" required autofocus>' +--}}
{{--                '</div></div>'+--}}

{{--                '<div class="pl-lg-4">' +--}}
{{--                '<div class="form-group">' +--}}
{{--                '<label class="form-control-label" for="input-logic">Logic (optional)</label>' +--}}
{{--                '<input type="text" name="days" id="input-num-days" class="form-control" placeholder="[baseline_arm_1][var_name] = 1" required autofocus>' +--}}
{{--                '</div></div>'+--}}

{{--                '<div class="pl-lg-4">' +--}}
{{--                '<div class="form-group">' +--}}
{{--                '<label class="form-control-label" for="input-timer">Send SMS after # days</label>' +--}}
{{--                '<input type="text" name="num-days" id="input-num-days" class="form-control" required autofocus>' +--}}
{{--                '</div></div>'+--}}

{{--                '<div class="pl-lg-4">' +--}}
{{--                '<div class="form-group">' +--}}
{{--                '<label class="form-control-label" for="input-timer">Send every # days:</label>' +--}}
{{--                '<input type="text" name="days" id="input-num-days" class="form-control" required autofocus>' +--}}
{{--                '</div></div>'+--}}

{{--                '<div class="pl-lg-4">' +--}}
{{--                '<div class="form-group">' +--}}
{{--                '<label class="form-control-label" for="recurrence">Number of recurrences:</label>' +--}}
{{--                '<input type="text" name="recurrence" id="recurrence" class="form-control" required autofocus>' +--}}
{{--                '</div></div>'+--}}

{{--                '<div class="input-group m-3">' +--}}
{{--                '<div class="input-group-prepend">' +--}}
{{--                '<button class="btn btn-danger" id="DeleteRow" type="button">' +--}}
{{--                '<i class="bi bi-trash"></i> Remove Invitation</button> </div>' +--}}
{{--                ' </div> </div>';--}}

{{--            $('#newinput').append(newRowAdd);--}}
{{--        });--}}

{{--        $("body").on("click", "#DeleteRow", function () {--}}
{{--            $(this).parents("#addrow").remove();--}}
{{--        })--}}
{{--    </script>--}}
{{--    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--    <script src="{{ asset('argon') }}/vendor/select2/dist/js/select2.min.js"></script>--}}
{{--    <script src="{{ asset('argon') }}/vendor/quill/dist/quill.min.js"></script>--}}
{{--    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>--}}
{{--    <script src="{{ asset('argon') }}/js/items.js"></script>--}}

{{--@endpush--}}
