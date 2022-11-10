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
                            @php
                            $num = count($tmp_array) / 6;
                            $i = 0;
                            for($x=0; $x < $num; $x++) {
                                 $calc_var = 'calc_var_' . strval($i) ;
                                 $logic_var = 'logic_' . strval($i) ;
                                 $sms_timer_var = 'sms_timer_' . strval($i) ;
                                 $num_days_var = 'num_days_' . strval($i) ;
                                 $recurrence_var = 'recurrence_' . strval($i) ;
                                 $message_var = 'message_' . strval($i) ;

                                 @endphp
                            <h6 class="heading-small text-muted mb-4">Invitations</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$calc_var}}">REDCap Variable to Calculate from</label>
                                    <input type="text" name="{{$calc_var}}" id="{{$calc_var}}" class="form-control" value="{{$tmp_array[$calc_var]}}" required autofocus>
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$logic_var}}">Logic (optional)</label>
                                    <input type="text" name="{{$logic_var}}" id="{{$logic_var}}" class="form-control" value="{{$tmp_array[$logic_var]}}" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$sms_timer_var}}">Send SMS after # days</label>
                                    <input type="text" name="{{$sms_timer_var}}" id="{{$sms_timer_var}}" value="{{$tmp_array[$sms_timer_var]}}" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$num_days_var}}">Send every # days:</label>
                                    <input type="text" name="{{$num_days_var}}" id="{{$num_days_var}}" value="{{$tmp_array[$num_days_var]}}"  class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$recurrence_var}}">Number of recurrences:</label>
                                    <input type="text" name="{{$recurrence_var}}" id="{{$recurrence_var}}" value="{{$tmp_array[$recurrence_var]}}" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="{{$message_var}}">SMS Message text:</label>
                                    <textarea type="text" name="{{$message_var}}" id="{{$message_var}}" value="{{$tmp_array[$message_var]}}"  class="form-control" required autofocus></textarea type="text">
                                </div>
                            </div>

                            @php

                            $i++;
 }
@endphp

                            <button type="submit" class="btn btn-success mt-4" onclick="confirm('{{ __("Are you sure you want to Update this item?") }}') ? this.parentElement.submit() : ''">Update</button>
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

@endpush

@push('js')

    <script src="{{ asset('argon') }}/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/quill/dist/quill.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/js/items.js"></script>
@endpush
