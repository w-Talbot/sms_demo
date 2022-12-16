{{--@extends('layouts.app', [--}}
{{--    'title' => __('User Management'),--}}
{{--    'parentSection' => 'laravel',--}}
{{--    'elementName' => 'study-management'--}}
{{--])--}}
{{--@section('content')--}}
{{--    @component('layouts.headers.auth')--}}
{{--        @component('layouts.headers.breadcrumbs')--}}
{{--            @slot('title')--}}
{{--                {{ __('Manage Studies') }}--}}
{{--            @endslot--}}

{{--            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('User Management') }}</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">{{ __('List') }}</li>--}}
{{--        @endcomponent--}}
{{--    @endcomponent--}}


{{--    <div class="header pb-6">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="header-body">--}}
{{--                <div class="row align-items-center py-4">--}}
{{--                    <div class="col-lg-6 col-7">--}}
{{--                        <h6 class="h2 d-inline-block mb-0">Manage Studies</h6>--}}
{{--                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">--}}
{{--                            <ol class="breadcrumb breadcrumb-links">--}}
{{--                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>--}}
{{--                                <li class="breadcrumb-item"><a href="{{ route('page.index', 'dashboard-alternative') }}">Studies</a></li>--}}
{{--                            </ol>--}}
{{--                        </nav>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Page content -->--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xl-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header border-0">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col">--}}
{{--                                <h3 class="mb-0">Studies</h3>--}}
{{--                            </div>--}}
{{--                            <div class="col text-right">--}}
{{--                                <a href="/manage/create" class="btn btn-sm btn-primary">Add new study</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <!-- Projects table -->--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table align-items-center table-flush">--}}
{{--                                <thead class="thead-light">--}}
{{--                                <tr>--}}
{{--                                    <th scope="col" class="sort" data-sort="name">Study</th>--}}
{{--                                    <th scope="col"></th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody class="list">--}}
{{--                                @foreach ($studies as $study)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $study['study_name'] }}</td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown">--}}
{{--                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    <i class="fas fa-ellipsis-v"></i>--}}
{{--                                                </a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
{{--                                                    <a class="dropdown-item" href="/manage/{{$study->id}}/edit">{{ __('Edit') }}</a>--}}
{{--                                                    <form method ="post" action="/manage/{{$study->id}}" method="post">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this item?") }}') ? this.parentElement.submit() : ''">--}}
{{--                                                            {{ __('Delete') }}--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    <!-- Footer -->--}}
{{--                    @include('layouts.footers.auth')--}}
{{--                </div>--}}
{{--                @endsection--}}

{{--                @push('js')--}}
{{--                    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>--}}
{{--                    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>--}}
{{--                    <script src="{{ asset('argon') }}/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>--}}
{{--                    <script src="{{ asset('argon') }}/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>--}}
{{--    @endpush--}}











@extends('layouts.app', [
    'title' => __('Study Management'),
    'parentSection' => 'laravel',
    'elementName' => 'study-management'
])

@section('content')
    @component('layouts.headers.auth')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Study Table') }}
            @endslot

{{--            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('User Management') }}</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">{{ __('List') }}</li>--}}
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Studies') }}</h3>

                            </div>
                            @can('create', App\User::class)
                                <div class="col-4 text-right">
                                    <a href="/manage/create" class="btn btn-sm btn-primary">{{ __('Add Study') }}</a>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>

                    <div class="table-responsive py-4" id="users-table">
                        <table class="table align-items-center table-flush"  id="datatable-basic">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
{{--                                <th scope="col">{{ __('Email') }}</th>--}}
{{--                                <th scope="col">{{ __('Role') }}</th>--}}
{{--                                <th scope="col">{{ __('Creation Date') }}</th>--}}
                                @can('manage-users', App\User::class)
                                    <th scope="col"></th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($studies as $study)
                                <tr>
                                    <td>{{ $study['study_name'] }}</td>
                                    @can('manage-users', App\User::class)
                                        <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="/manage/{{$study->id}}/edit">{{ __('Edit') }}</a>
                                                        <form method ="post" action="/manage/{{$study->id}}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this item?") }}') ? this.parentElement.submit() : ''">
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </form>
                                                    </div>
                                                </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
@endpush
