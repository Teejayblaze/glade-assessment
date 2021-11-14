    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    <li class="nav-item dropdown navbar-search">
                        <a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
                        <ul class="dropdown-menu">
                            <li class="arrow_box">
                                <form>
                                    <div class="input-group search-box">
                                        <div class="position-relative has-icon-right full-width">
                                            <input class="form-control" id="search" type="text" placeholder="Search here...">
                                            <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#"><i class="ft-book"></i> Read Mail</a>
                                <a class="dropdown-item" href="#"><i class="ft-bookmark"></i> Read Later</a>
                                <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Mark all Read</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">            
                            <span class="avatar avatar-online"><img src="{{asset('theme-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#"><span class="avatar avatar-online" style="display: block; width:100%">
                                    <span class="user-name text-bold-700 ml-0" style="white-space: normal;line-height: 18px;width: 100%;display: block;font-size:13px;text-align:center;">{{Auth::user()->name}}</span></span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('logout')}}"><i class="ft-power"></i> Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </nav>



    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="{{asset('theme-assets/images/backgrounds/02.jpg')}}">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">       
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="/dashboard"><img class="brand-logo" alt="Chameleon admin logo" src="{{asset('theme-assets/images/logo/logo.png')}}"/>
                    <h3 class="brand-text">Glade</h3></a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                @if (Auth::check() && Auth::user()->hasPermission('companies', Auth::user()->usertype, 'read'))
                    <li class=" nav-item">
                        <a href="{{url('companies')}}"><i class="la la-building"></i><span class="menu-title" data-i18n="">Companies</span></a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->hasPermission('employees', Auth::user()->usertype, 'read'))
                <li class=" nav-item">
                    <a href="{{url('employees')}}"><i class="la la-users"></i><span class="menu-title" data-i18n="">Employees</span></a>
                </li>
                @endif
                @if (Auth::check() && Auth::user()->hasPermission('admins', Auth::user()->usertype, 'read'))
                <li class=" nav-item">
                    <a href="{{url('admins')}}"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="">Admins</span></a>
                </li>
                @endif
                @if (Auth::check() && Auth::user()->hasPermission('permissions', Auth::user()->usertype, 'read'))
                <li class=" nav-item">
                    <a href="{{url('permissions')}}"><i class="la la-unlock"></i><span class="menu-title" data-i18n="">Permissions</span></a>
                </li>
                @endif
            </ul>
        </div>
    </div>