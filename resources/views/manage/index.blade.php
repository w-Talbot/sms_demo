{{--<h1>DEMO</h1>--}}

{{--@unless(count($studies) == 0)--}}
{{--@foreach ($studies as $study)--}}
{{--    <h2>--}}
{{--        <a href="/demo/example/{{$study['id']}}">--}}

{{--        {{$study['study_name']}} </a>--}}
{{--    </h2>--}}
{{--    <p>--}}
{{--        {{$study['api']}}--}}
{{--    </p>--}}

{{--@endforeach--}}
{{--@else--}}
{{--<p> No studies found </p>--}}
{{--@endunless--}}





{{--SIMPLE A+OLD CODE ABOVE FOR TESTING AND EXAMPLES--}}


@extends('layouts.app', [
    'navClass' => 'navbar-light bg-secondary',
    'searchClass' => 'navbar-search-dark',
    'parentSection' => 'dashboards',
    'elementName' => 'dashboard-alternative'
])

@section('content')
    <div class="header pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 d-inline-block mb-0">Manage Studies</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('page.index', 'dashboard-alternative') }}">Studies</a></li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Studies</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/manage/create" class="btn btn-sm btn-primary">Add new study</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
{{--                                    <th scope="col">Logo</th>--}}
                                    <th scope="col" class="sort" data-sort="name">Study</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($studies as $study)
                                    <tr>
{{--                                        <td>img here</td>--}}
                                        <td>{{ $study['study_name'] }}</td>
                                        {{--        <td>{{ $study->category->name }}</td>--}}
                                        {{--        <td>--}}
                                        {{--            @if ($study->picture)--}}
                                        {{--                <img src="{{ $study->path() }}" alt="" style="max-width: 150px;">--}}
                                        {{--            @endif--}}
                                        {{--        </td>--}}
                                        {{--        <td>--}}
                                        {{--            @foreach ($study->tags as $tag)--}}
                                        {{--                <span class="badge badge-default" style="background-color:{{ $tag->color }}">{{ $tag->name }}</span>--}}
                                        {{--            @endforeach--}}
                                        {{--        </td>--}}
                                        {{--        <td>{{ $study->created_at->format('d/m/Y H:i') }}</td>--}}
                                        {{--        @can('manage-items', App\User::class)--}}
                                        <td class="text-right">
                                            {{--                @if (auth()->user()->can('update', $study) || auth()->user()->can('delete', $study))--}}
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    {{--                            @can('update', $study)--}}
                                                    <a class="dropdown-item" href="/manage/{{$study->id}}/edit">{{ __('Edit') }}</a>
                                                    {{--                            @endcan--}}
                                                    {{--                            @can('delete', $study)--}}
                                                    <form method ="post" action="/manage/{{$study->id}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this item?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                    {{--                            @endcan--}}
                                                </div>
                                            </div>
                                            {{--                @endif--}}
                                        </td>
                                        {{--        @endcan--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- Footer -->
                    @include('layouts.footers.auth')
                </div>
                @endsection

                @push('js')
                    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
                    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
                    <script src="{{ asset('argon') }}/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>
                    <script src="{{ asset('argon') }}/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
    @endpush

