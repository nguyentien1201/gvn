<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Green Trading Invest Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(Auth::user()->role_id == \App\Models\ConstantModel::ROLES['admin'])
                    <li class="nav-item">
                        <a href="{{route('admin.profile.index')}}"
                           class="nav-link @if(!empty($routeName) && strpos($routeName, 'profile') != false) active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                {{__('user.profile')}}
                            </p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role_id == \App\Models\ConstantModel::ROLES['admin'])
                        <li class="nav-item">
                            <a href="{{route('admin.mst-stock.index')}}"
                               class="nav-link @if(!empty($path) && $path =='mst-stock') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    {{__('panel.stock_free')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.freesignal.index')}}"
                            class="nav-link @if(!empty($path) && $path =='freesignal') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    {{__('panel.freesignal')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.green-beta.index')}}"
                               class="nav-link @if(!empty($path) && $path =='green-beta') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    {{__('panel.singal')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.green-alpha.index')}}"
                               class="nav-link @if(!empty($path) && $path =='green-alpha') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    {{__('panel.alpha')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.portfolio.index')}}"
                               class="nav-link @if(!empty($path) && $path =='green-alpha') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                     Portfolio
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.nas100.index')}}"
                               class="nav-link @if(!empty($path) && $path =='nas100') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                     Nas100 Rating
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.vnindex.index')}}"
                               class="nav-link @if(!empty($path) && $path =='vnindex') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                     VnIndex
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.product.index')}}"
                               class="nav-link @if(!empty($path) && $path =='product') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                     Product
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.product-version.index')}}"
                               class="nav-link @if(!empty($path) && $path =='product-version') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                     Product Version
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.subscription.index')}}"
                               class="nav-link @if(!empty($path) && $path =='subscription') active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                Subscription
                                </p>
                            </a>
                        </li>
                    @endif
                @if(Auth::user()->role_id == \App\Models\ConstantModel::ROLES['admin'])
                    <li class="nav-item">
                        <a href="{{route('admin.customers.index')}}"
                           class="nav-link @if(!empty($routeName) && strpos($routeName, 'customers') != false) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{__('panel.customer')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.promotions.index')}}"
                           class="nav-link @if(!empty($routeName) && strpos($routeName, 'promotions') != false) active @endif">
                            <i class="nav-icon fas fa-gift"></i>
                            <p>
                                {{__('panel.promotion')}}
                            </p>
                        </a>
                    </li>
                    @if(Auth::user()->role_id == \App\Models\ConstantModel::ROLES['admin'])
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}"
                               class="nav-link @if(!empty($routeName) && strpos($routeName, 'users') != false) active @endif">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    {{__('panel.user')}}
                                </p>
                            </a>
                        </li>
                    @endif
{{--                    <li class="nav-item has-treeview @if(!empty($routeName) && (strpos($routeName, 'tokens') != false || strpos($routeName, 'review_settings') != false)) menu-open @endif">--}}
{{--                        <a href="#"--}}
{{--                           class="nav-link @if(!empty($routeName) && (strpos($routeName, 'tokens') != false || strpos($routeName, 'review_settings') != false)) active @endif">--}}
{{--                            <i class="nav-icon fa fa-cog"></i>--}}
{{--                            <p>{{__('panel.setting')}}<i class="fas fa-angle-left right"></i></p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview @if(!empty($routeName) && (strpos($routeName, 'tokens') != false || strpos($routeName, 'review_settings') != false)) menu-open @endif">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.tokens.index')}}"--}}
{{--                                   class="nav-link @if(!empty($routeName) && strpos($routeName, 'tokens') != false) active @endif">--}}
{{--                                    <i class="nav-icon far fa-circle"></i>--}}
{{--                                    <p>--}}
{{--                                        {{__('panel.token')}}--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                @endif
                <li class="nav-item">
                    <a href="javascript:void(0)" class="logout nav-link"
                       onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{__('panel.logout')}}</p>
                    </a>
                </li>

            </ul>
        </nav>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
