@extends($app_template['frontend'])

@section('content')
    <section id="contact" class="contact m-t-xl" style="padding-top:30px;">
        <div class="container">
            <div class="row contact-page m-t-lg">
                <div class="col-md-12 item_top">
                    <div class="col-md-1 col-sm-4"></div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <a href="javascript:void(0);" onclick="popupwindow('{{ URL::to('/login-use-linkedin') }}', 550, 600);">
                            <img src="img/ln-connect.png" class="img-responsive" />
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <a href="javascript:void(0);" onclick="popupwindow('{{ URL::to('/login-use-facebook') }}', 830, 500);">
                            <img src="img/fb-connect.png" class="img-responsive" />
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <a href="javascript:void(0);" onclick="popupwindow('{{ URL::to('/login-use-twitter') }}', 500, 600);">
                            <img src="img/tw-connect.png" class="img-responsive" />
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <a href="javascript:void(0);" onclick="popupwindow('{{ URL::to('/login-use-google') }}', 450, 500);">
                            <img src="img/go-connect.png" class="img-responsive" />
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <a href="javascript:void(0);" onclick="popupwindow('{{ URL::to('/login-use-jawbone') }}', 450, 500);">
                            <img src="img/jawbone-connect.png" class="img-responsive" />
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12"></div>
                </div>
                <div class="clearfix"></div>
                <dv class="col-md-8 col-md-offset-2 section-head text-center item_top" style="margin-bottom:20px; padding-top:60px;">
                    <h2>Registration</h2>
                </dv>
                <div class="col-md-4 col-md-offset-4 item_top">
                    <div class="row" ng-controller="memberRegisterController">
                        {!! Session::get('msg_status') !!}
                        {!! Form::Open(array('url'=> route('site.frontend.do_register'), 'id'=>'register-form', 'class'=>'row register-form', 'method'=>'POST', 'name'=>'registerForm', 'autocomplete' => 'off')) !!}
                        <div class="col-md-12">
                            <input type="text" name="fname" ng-model="data.fname"  placeholder="First Name" required class="form-control" pattern="[a-zA-Z ]+" oninvalid="setCustomValidity('First Name allow alphabets only.')" onchange="try{setCustomValidity('')}catch(e){}" />
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="lname" ng-model="data.lname" placeholder="Last Name" required class="form-control" pattern="[A-Za-z ]*" oninvalid="setCustomValidity('Last Name allow alphabets only.')" onchange="try{setCustomValidity('')}catch(e){}" />
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" ng-model="data.email" ng-model-options="{debounce: 500}" value="" placeholder="Email" required class="form-control" id="registerMail" />

                            <span class="tickIcon" ng-show="showEmailTickIcon && !registerForm.email.$error.email"><i class="fa fa-check"></i></span>
                            <span class="crossIcon" ng-show="(!registerForm.email.$error.email && showEmailValidationMsg) || registerForm.email.$error.email"><i class="fa fa-times"></i></span>
                        </div>
                        <div class="col-sm-12 <% ((!registerForm.email.$error.email && showEmailValidationMsg) || registerForm.email.$error.email) ? 'section-display-error' : '' %>" ng-if="registerForm.email.$dirty">
                            <div class="error_msg">
                                <small ng-show="!registerForm.email.$error.email && showEmailValidationMsg"><% data.textMsgEmail %></small>
                                <small ng-show="registerForm.email.$error.email">* Invalid email.</small>
                            </div>
                        </div>

                        <!-- Country Code & Phone -->
                        <div class="col-md-4">
                            <input type="text" name="country_code" ng-model="data.country_code" ng-model-options="{debounce: 500}" value="" placeholder="Country Code" class="form-control" />
                        </div>
                        <div class="col-md-8 no-padding-left">
                            <input type="text" name="phone" ng-model="data.phone" ng-model-options="{debounce: 500}" value="" placeholder="Mobile Number" class="form-control" />

                            <span class="tickIcon" ng-show="data.country_code && data.phone && showPhoneTickIcon"><i class="fa fa-check"></i></span>
                            <span class="crossIcon" ng-show="showPhoneValidationMsg || (registerForm.country_code.$dirty && registerForm.country_code.$error.required) || registerForm.phone.$dirty && registerForm.phone.$error.required"><i class="fa fa-times"></i></span>
                        </div>

                        <div class="col-sm-12 <% (showPhoneValidationMsg || (registerForm.country_code.$dirty && registerForm.country_code.$error.required) || registerForm.phone.$dirty && registerForm.phone.$error.required) ? 'section-display-error' : '' %>" ng-if="registerForm.country_code.$dirty || registerForm.phone.$dirty">
                            <div class="error_msg">
                                <small ng-show="showPhoneValidationMsg"><% data.textMsgPhone %></small>
                                <small ng-show="registerForm.country_code.$dirty && registerForm.country_code.$error.required">* Please enter your country code.</small>
                                <small ng-show="registerForm.phone.$dirty && registerForm.phone.$error.required">* Please enter your phone number.</small>
                            </div>
                        </div>
                        <!-- End Country Code & Phone -->

                        <!-- Password & Confirm Password -->
                        <div class="col-md-12">
                            <input type="password" id="pwd1" name="password" ng-model="data.password" ng-minlength="8" ng-maxlength="32" ng-model-options="{debounce: 500}" placeholder="Password" required class="form-control" />
                        </div>
                        <div class="col-sm-12 <% (registerForm.password.$dirty && (registerForm.password.$error.minlength || registerForm.password.$error.maxlength)) ? 'section-display-error' : '' %>" ng-if="(registerForm.password.$dirty && (registerForm.password.$error.minlength || registerForm.password.$error.maxlength))">
                            <div class="error_msg">
                                <small ng-show="(registerForm.password.$dirty && (registerForm.password.$error.minlength || registerForm.password.$error.maxlength))">* The password must be between 8-32 characters.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="password" id="pwd2" name="password_confirmation" ng-model="data.password_confirmation" ng-minlength="8" ng-maxlength="32" ng-model-options="{debounce: 500}" placeholder="Confirm Password" required class="form-control" />

                            <span class="tickIcon" ng-show="data.password && data.password_confirmation && showPwdTickIcon"><i class="fa fa-check"></i></span>
                            <span class="crossIcon" ng-show="showPasswordValidationMsg"><i class="fa fa-times"></i></span>
                        </div>
                        <div class="col-sm-12 <% (registerForm.password_confirmation.$dirty && (registerForm.password_confirmation.$error.minlength || registerForm.password_confirmation.$error.maxlength) || showPasswordValidationMsg) ? 'section-display-error' : '' %>" ng-if="(registerForm.password_confirmation.$dirty && (registerForm.password_confirmation.$error.minlength || registerForm.password_confirmation.$error.maxlength) || showPasswordValidationMsg)">
                            <div class="error_msg">
                                <small ng-show="showPasswordValidationMsg"><% data.textMsgPwd %></small>
                                <small ng-show="(registerForm.password_confirmation.$dirty && (registerForm.password_confirmation.$error.minlength || registerForm.password_confirmation.$error.maxlength))">* The confirm password must be between 8-32 characters.</small>
                            </div>
                        </div>
                        <!-- End Password & Confirm Password -->

                        <div class="col-md-12 start-chosen">
                            {{--{!! Form::select('registerAs', $userType, $registerAs, array('id'=>'registerAs', 'class' => 'form-control chosen-select-no-single')) !!}--}}
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" name="agree_term" value="1" {{ !empty($agree_term) ? "checked" : "" }} /> I have read and agree to MedVoice <span class="registerType">CareClient</span> terms
                            </label>
                        </div>
                        <div class="col-md-12 text-center">
                            <input type="submit" value="Sign Up" class="message-sub btn btn-blue" >
                        </div>
                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@section('ng-controller')
    {!! Html::script(URL::asset('javascripts/modules/frontend-module/controllers/member-register.js')) !!}
@stop
