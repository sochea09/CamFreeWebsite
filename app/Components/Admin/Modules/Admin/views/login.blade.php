<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {!! Meta::display() !!}

    <title>CamFree {{(isset($title) ? $title : 'CamFree')}}</title>

    {!! Html::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') !!}
    {{--Vendor--}}
    {!! Html::style('vendors/bootstrap/dist/css/bootstrap.min.css') !!}

    @yield('style')
</head>
<body>
<div id="wrapper">

        <div class="container super-admin-login">
            <h3>Administrator Login</h3>
            <hr>
            @if (Session::has('msg_err'))
                <div class="alert alert-danger"><b> Error : </b>{{ Session::get('msg_err') }}</div>
            @endif
            <div class="main-login">
                <form role="form" id="form-login" method="post" action="/admin/login" data-toggle="validator">
                    <div class="form-group has-feedback">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="inputEmail"  name="email" required data-error="Bruh, that email address is invalid">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" required data-minlength="6" data-error="Minimum of 6 characters">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block">Minimum of 6 characters</div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                    <div class="checkbox text-center">
                        <label><a href="#"> Forgot Password</a></label>
                    </div>

                </form>
            </div>
        </div>

    {!! Html::script(URL::asset('vendors/jquery/dist/jquery.min.js')) !!}
    {{--<!-- {!! Html::script(URL::asset('vendors/angular-route/angular-route.min.js')) !!} -->--}}
    {!! Html::script(URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js')) !!}
    {!! Html::script(URL::asset('js/validator.min.js')) !!}
    <script>
        $('#form-login').validator();
    </script>

</div>{{--end wrapper--}}
</body>
</html>