<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {!! Meta::display() !!}

    <title>{{(isset($title) ? $title : 'CamFree')}}</title>

    {!! Html::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') !!}
    {{--Vendor--}}
    {!! Html::style('vendors/bootstrap/dist/css/bootstrap.min.css') !!}

    {!! Html::style('css/app.css') !!}
    @yield('style')
</head>
<body>
<div id="wrapper">
    {{--Header--}}
    @include('resources.views.includes.frontend.header')

    <div id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('resources.views.includes.frontend.left-sidebar')
                </div>
                <div class="col-md-6">
                    @yield('content')
                </div>
                <div class="col-md-3">
                    world
                </div>
            </div>
        </div>
    </div>

    {!! Html::script(URL::asset('vendors/jquery/dist/jquery.min.js')) !!}
    {!! Html::script(URL::asset('vendors/angular/angular.min.js')) !!}
    {{--<!-- {!! Html::script(URL::asset('vendors/angular-route/angular-route.min.js')) !!} -->--}}
    {!! Html::script(URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js')) !!}

    <?php // ================ App Script =====================?>
    {!! Html::script(URL::asset('javascripts/modules/frontend-module/app.js')) !!}
    <?php // ================ Controllers =====================?>
    @yield('ng-controller')
    <?php // ================ Run App ========================= ?>
    {!! Html::script(URL::asset('javascripts/modules/frontend-module/run.js')) !!}

    @yield('script')
</div>{{--end wrapper--}}
</body>
</html>