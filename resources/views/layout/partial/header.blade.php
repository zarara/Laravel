<div class="header bg-primary" id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><font color="#fffefa">Forum Asisten</font></h1>
                </div>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <font
                                    color="#fffefa"> <i class="glyphicon glyphicon-log-out"></i>{{ Auth::user()->name }}
                            </font> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>


            {{--<div class="col-md-2 pull-right">--}}
                {{--<div class="navbar navbar-inverse" role="banner">--}}
                    {{--<nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">--}}
                        {{--<ul class="nav navbar-nav">--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="/"><i class="glyphicon glyphicon-log-out"></i>Log Out</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</nav>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>