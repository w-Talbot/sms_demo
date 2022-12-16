<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner scroll-scrollx_visible">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('phc') }}/img/PHC_SMS_rdlogo.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
{{--                    <li class="nav-item active">--}}
{{--                        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"  aria-controls="navbar-examples">--}}
{{--                            <i class="fab fa-laravel" style="color: #f4645f;"></i>--}}
{{--                            <span class="nav-link-text" style="color: #f4645f;">{{ __('Manage') }}</span>--}}
{{--                        </a>--}}
{{--                        <div class="collapse show" id="navbar-examples">--}}
{{--                            <ul class="nav nav-sm flex-column">--}}
{{--                                @can('manage-users', App\User::class)--}}
{{--                                    <li class="nav-item {{ $elementName == 'user-management' ? 'active' : '' }}">--}}
{{--                                        <a href="{{ route('user.index') }}" class="nav-link">{{ __('Users') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endcan--}}
{{--                                @can('manage-items', App\User::class)--}}
{{--                                    <li class="nav-item {{ $elementName == 'item-management' ? 'active' : '' }}">--}}
{{--                                        <a href="/manage/index" class="nav-link">{{ __('Studies') }}</a>--}}
{{--                                    </li>--}}
{{--                                @else--}}
{{--                                    <li class="nav-item {{ $elementName == 'item-management' ? 'active' : '' }}">--}}
{{--                                        <a href="{{ route('item.index') }}" class="nav-link">{{ __('Items') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endcan--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}


                    @can('manage-users', App\User::class)
                        <li class="nav-item {{ $elementName == 'user-management' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <i class="ni ni-chart-pie-35 text-info"></i>
                                <span class="nav-link-text">{{ __('Users') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('manage-users', App\User::class)
                        <li class="nav-item {{ $elementName == 'item-management' ? 'active' : '' }}">
                            <a class="nav-link" href="/manage/index">
                                <i class="ni ni-chart-pie-35 text-info"></i>
                                <span class="nav-link-text">{{ __('Studies') }}</span>
                            </a>
                        </li>
                    @endcan


                </ul>
            </div>
        </div>
    </div>
</nav>





