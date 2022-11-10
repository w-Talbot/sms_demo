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
{{--                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
                                <div class="form-group">
                                    <label class="form-control-label" for="study_name">Study Name:</label>
                                    <input type="text" name="study_name" id="study_name" class="form-control" placeholder="{{ __('Name of study') }}" value="{{ old('study-name') }}" required autofocus>

                                    @error('study_name')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pl-lg-4">
{{--                                <div class="form-group{{ $errors->has('api') ? ' has-danger' : '' }}">--}}
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
{{--                                <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">--}}
                                    <label class="form-control-label" for="url">Study URL:</label>
                                    <input type="text" name="url" id="url" class="form-control" placeholder="{{ __('ex: https://magcap.phc.ox.ac.uk/') }}" value="{{ old('url') }}" required autofocus>
                                    @error('study_name')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
{{--                            <h6 class="heading-small text-muted mb-4">{{ __('When to send invitations') }}</h6>--}}

                                <h6 class="heading-small text-muted mb-4">Invitations</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="calc_var_0">REDCap Variable to Calculate from</label>
                                        <input type="text" name="calc_var_0" id="calc_var_0" class="form-control" placeholder="[baseline_arm_1][var_name])" required autofocus>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="logic_0">Logic (optional)</label>
                                        <input type="text" name="logic_0" id="logic_0" class="form-control" placeholder="[baseline_arm_1][var_name] = 1" required autofocus>
                                    </div>
                                </div>

                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="sms_timer_0">Send SMS after # days</label>
                                        <input type="text" name="sms_timer_0" id="sms_timer_0" class="form-control" required autofocus>
                                    </div>
                                </div>

                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="num_days_0">Send every # days:</label>
                                        <input type="text" name="num_days_0" id="num_days_0" class="form-control" required autofocus>
                                    </div>
                                </div>

                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="recurrence_0">Number of recurrences:</label>
                                        <input type="text" name="recurrence_0" id="recurrence_0" class="form-control" required autofocus>
                                    </div>
                                </div>

                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="message_0">SMS Message text:</label>
                                        <textarea type="text" name="message_0" id="message_0" class="form-control" required autofocus></textarea>
                                    </div>
                                </div>

                            <div id="newinput"></div>
                            <button type="button" id="rowAdder" class="btn btn-primary">Add another invitation</button>


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
    <link rel="stylesheet" href=
        "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href=
        "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush

@push('js')
    <script type="text/javascript">

        var sfx = 0;
        var cv = "calc_var_" . sfx;
        $("#rowAdder").click(function () {

            sfx = sfx + 1;
            newRowAdd =

                '<div id="addrow"><h6 class="heading-small text-muted mb-4">--Invitation--</h6>' +
                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="calc_var_' + sfx + '">REDCap Variable to Calculate from</label>' +
                '<input type="text" name="calc_var_' + sfx + '" id="calc_var_' + sfx + '" class="form-control" placeholder="[baseline_arm_1][var_name])" required autofocus>' +
                '</div></div>' +

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="logic_' + sfx + '">Logic (optional)</label>' +
                '<input type="text" name="logic_' + sfx + '" id="logic_' + sfx + '" class="form-control" placeholder="[baseline_arm_1][var_name] = 1" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="sms_timer_' + sfx + '">Send SMS after # days</label>' +
                '<input type="text" name="sms_timer_' + sfx + '" id="sms_timer_' + sfx + '" class="form-control" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="num_days_' + sfx + '">Send every # days:</label>' +
                '<input type="text" name="num_days_' + sfx + '" id="num_days_' + sfx + '" class="form-control" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="recurrence_' + sfx + '">Number of recurrences:</label>' +
                '<input type="text" name="recurrence_' + sfx + '" id="recurrence_' + sfx + '" class="form-control" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="message_' + sfx + '">SMS Message text:</label>' +
                '<textarea type="text" name="message_' + sfx + '" id="message_' + sfx + '" class="form-control" required autofocus></textarea>' +
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/quill/dist/quill.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/js/items.js"></script>

@endpush
