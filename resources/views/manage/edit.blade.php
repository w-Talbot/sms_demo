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
                                <div class="form-group">
                                    <label class="form-control-label" for="textlocal_api">Textlocal API:</label>

                                    <input type="text" name="textlocal_api" id="textlocal_api" class="form-control" value="{{$study->textlocal_api}}" required autofocus>
                                    @error('textlocal_api')
                                    <p class="text-red-500 text-cs mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="api">REDCap API:</label>

                                    <input type="text" name="redcap_api" id="redcap_api" class="form-control" value="{{$study->redcap_api}}" required autofocus>
                                    @error('redcap_api')
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

                            <div class="row pl-lg-3">
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="phone_event">Phone EVENT</label>
                                        <input type="text" name="phone_event" id="phone_event" class="form-control"  value="{{$study->phone_event}}" required autofocus>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="phone_variable">Phone VARIABLE</label>
                                        <input type="text" name="phone_variable" id="phone_variable" class="form-control"  value="{{$study->phone_variable}}" required autofocus>
                                    </div>
                                </div>
                            </div>


                            @php
                            // note:: $num is divided by the number of inputs for lopping purposes, if you add an input (ex: logic, message, etc), you need to add to the number it is divided by
                            $num = count($tmp_array) / 8;
                            $i = 0;


//                            for($x=0; $x < $num; $x++) {
                            for($x=0; $x < sizeof($tmp_array); $x++) {

                                 if(!isset($tmp_array['message_' . $x])){
                                     $i++;
                                     continue;
                                 }

                                 $date_event = 'date_event_' . strval($i) ;
                                 $date_var = 'date_var_' . strval($i) ;
                                 $form_event = 'form_event_' . strval($i) ;
                                 $form_var = 'form_var_' . strval($i) ;
                                 $sms_timer_var = 'sms_timer_' . strval($i) ;
                                 $num_days_var = 'num_days_' . strval($i) ;
                                 $recurrence_var = 'recurrence_' . strval($i) ;
                                 $message_var = 'message_' . strval($i) ;
                                 $delete_invite = 'delete_invite_' . strval($i);


                                 @endphp
                            <h6 class="heading-small text-muted mb-4">Invitations</h6>
                            <div class="row pl-lg-3">
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{$date_event}}">REDCap Date EVENT</label>
                                        <input type="text" name="{{$date_event}}" id="{{$date_event}}" class="form-control" value="{{$tmp_array[$date_event]}}" required autofocus>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{$date_var}}">REDCap Date VARIABLE</label>
                                        <input type="text" name="{{$date_var}}" id="{{$date_var}}" class="form-control" value="{{$tmp_array[$date_var]}}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-lg-3">
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{$form_event}}">Form Complete EVENT</label>
                                        <input type="text" name="{{$form_event}}" id="{{$form_event}}" class="form-control" value="{{$tmp_array[$form_event]}}" required autofocus>
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{$form_var}}">Form Complete VARIABLE</label>
                                        <input type="text" name="{{$form_var}}" id="{{$form_var}}" class="form-control" value="{{$tmp_array[$form_var]}}" required autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$sms_timer_var}}">Send SMS after # days</label>
                                    <input type="number" name="{{$sms_timer_var}}" id="{{$sms_timer_var}}" value="{{$tmp_array[$sms_timer_var]}}" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$num_days_var}}">Send every # days:</label>
                                    <input type="number" name="{{$num_days_var}}" id="{{$num_days_var}}" value="{{$tmp_array[$num_days_var]}}"  class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$recurrence_var}}">Number of recurrences:</label>
                                    <input type="number" name="{{$recurrence_var}}" id="{{$recurrence_var}}" value="{{$tmp_array[$recurrence_var]}}" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <div class = "counter">
                                    <label class="form-control-label" for="{{$message_var}}">SMS Message text:</label>
                                    <input type="text" name="{{$message_var}}" id="{{$message_var}}" value="{{$tmp_array[$message_var]}}"  class="form-control" required autofocus>
                                    </div >
                                </div>
                            </div>

                            <div class="pl-lg-4 my-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name = "{{$delete_invite}}" value="1" id="{{$delete_invite}}">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Delete existing invitation above?
                                    </label>
                                </div>
                            </div>



                            @php


                                $i++;
     }
@endphp

                            <div>
                                <div id="newinput"></div>
                                <button type="button" id="rowAdder" class="btn btn-primary">Add another invitation</button>
                            </div>
                            <h6 class="heading-small text-muted mb-4">{{ __('') }}</h6>

                            <div>
                                <button type="submit" class="btn btn-success mt-4">Update</button>
                            </div>

                        </form>

                        <form method ="post" action="/manage/{{$study->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger my-4" onclick="confirm('{{ __("Are you sure you want to delete this item?") }}') ? this.parentElement.submit() : ''">
                                {{ __('Delete') }}
                            </button>
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


        var num = 0;

        var allElements = document.querySelectorAll('.counter');

        var num = allElements.length;
        var name = '';

        for(let i = 0; i < num; i++){
            name = allElements[i].children.item(1).name;
        }
        var temp_name = name.substr(-3,3);
        name =  temp_name.replace(/\D/g,'');

        console.log('Sup');
        console.log(parseInt(name));
        // console.log(temp_name);
        // console.log(allElements[0].children.item(1).name);
        // console.log(allElements[0].children.item(1).id);
        // console.log(allElements[0].children.Description);


        var sfx = parseInt(name);

        $("#rowAdder").click(function () {

            sfx = sfx + 1;
            newRowAdd =

                '<div id="addrow"><h6 class="heading-small text-muted mb-4">--Invitation--</h6>' +
                '<div class="row pl-lg-3">'+
                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="date_event_' + sfx + '">REDCap Date EVENT</label>' +
                '<input type="text" name="date_event_' + sfx + '" id="date_event_' + sfx + '" class="form-control" placeholder="baseline_arm_1" required autofocus>' +
                '</div></div>' +

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="date_var_' + sfx + '">REDCap Date VaARIABLE</label>' +
                '<input type="text" name="date_var_' + sfx + '" id="date_var_' + sfx + '" class="form-control" placeholder="var_name" required autofocus>' +
                '</div></div>' +
                '</div>' +

                '<div class="row pl-lg-3">'+
                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="form_event_' + sfx + '">Form Complete EVENT</label>' +
                '<input type="text" name="form_event_' + sfx + '" id="form_event_' + sfx + '" class="form-control" placeholder="screening_arm_1" required autofocus >' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="form_var_' + sfx + '">Form Complete VARIABLE</label>' +
                '<input type="text" name="form_var_' + sfx + '" id="form_var_' + sfx + '" class="form-control" placeholder="screening_complete" required autofocus >' +
                '</div></div>'+
                '</div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="sms_timer_' + sfx + '">Send SMS after # days</label>' +
                '<input type="number" name="sms_timer_' + sfx + '" id="sms_timer_' + sfx + '" class="form-control" placeholder="#"  required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="num_days_' + sfx + '">Send every # days:</label>' +
                '<input type="number" name="num_days_' + sfx + '" id="num_days_' + sfx + '" class="form-control" placeholder="#" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="recurrence_' + sfx + '">Number of recurrences:</label>' +
                '<input type="number" name="recurrence_' + sfx + '" id="recurrence_' + sfx + '" class="form-control" placeholder="#" required autofocus>' +
                '</div></div>'+

                '<div class="pl-lg-4">' +
                '<div class="form-group">' +
                '<label class="form-control-label" for="message_' + sfx + '">SMS Message text:</label>' +
                '<input type="text" name="message_' + sfx + '" id="message_' + sfx + '" class="form-control" placeholder="Text message text here." required autofocus>' +
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
