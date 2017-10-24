<!DOCTYPE html>
<html>
<head>
    @include('layout.partial.head')
    @yield('css')
</head>
<body>
    @include('layout.partial.header')

<div class="page-content">
    <div class="row">

        @include('layout.partial.menu')

        <div class="col-md-10">
            <div class="panel-title">
                <h3>
                    @yield('subtitle')
                </h3>
                <div class="pull-right">
                    <h6>
                        <label><i class="glyphicon glyphicon-apple"></i> @yield('title')</label> /
                        <label class="active">@yield('subtitle')</label>
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 content-box-large">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

    @include('layout.partial.js')
    @yield('js')
</body>
</html>