// home.js

camfree.app.controller('memberRegisterController', ['$scope', '$http', '$rootScope', '$timeout',
    function($scope, $http, $rootScope, $timeout){
        //console.log('memberRegisterController started');
        var metaPreloadInfoSessions = $('meta[name="camfree:preloadinfo"]');
        // console.log(metaPreloadInfoSessions);

        var preloadInfo = {};
        if (metaPreloadInfoSessions.attr('content') != undefined && angular.fromJson(atob(metaPreloadInfoSessions.attr('content'))) != null) {
            preloadInfo = angular.fromJson(atob(metaPreloadInfoSessions.attr('content')));
            // console.log(preloadInfo);
        }

        $scope.data                     = {};
        $scope.showEmailValidationMsg   = $scope.showPhoneValidationMsg = $scope.showPasswordValidationMsg = false;
        $scope.showEmailTickIcon        = $scope.showPhoneTickIcon = $scope.showPwdTickIcon = false;
        $scope.data.textMsgEmail        = $scope.data.textMsgPhone = $scope.data.textMsgPwd = "";

        if (Object.keys(preloadInfo).length) {
            $scope.data.fname           = preloadInfo['fname'];
            $scope.data.lname           = preloadInfo['lname'];
            $scope.data.email           = preloadInfo['email'];
            $scope.data.country_code    = preloadInfo['country_code'];
            $scope.data.phone           = preloadInfo['phone'];
        }

        /*$scope.$watch('data.email', function(v){
            if(v){
                $http.post('/api/check-email', {
                    "email": v
                }).success(function(data) {
                    // console.log(data);
                    if (data.msg_status != 'success') {
                        $scope.showEmailValidationMsg   = true;
                        $scope.data.textMsgEmail        = "* Email is already in used.";
                    }else {
                        $scope.showEmailValidationMsg   = false;
                        $scope.showEmailTickIcon        = true;
                    }
                }).error(function(data) {
                    $scope.showEmailValidationMsg   = true;
                    $scope.data.textMsgEmail        = "* " + data.msg_status;
                    console.log("failure message: " + JSON.stringify({
                            data: data
                        }));
                });
            }
        });

        $scope.$watch('data.country_code + data.phone', function(){
            if($scope.data.country_code && $scope.data.phone){
                // console.log($scope.data.country_code);
                // console.log($scope.data.phone);
                $http.post('/api/check-phone', {
                    "country_code": $scope.data.country_code,
                    "phone": $scope.data.phone
                }).success(function(data) {
                    // console.log(data);
                    if (data.msg_status != 'success') {
                        $scope.showPhoneValidationMsg   = true;
                        $scope.data.textMsgPhone        = "* Phone is already in used.";
                    }else {
                        $scope.showPhoneValidationMsg   = false;
                        $scope.showPhoneTickIcon        = true;
                    }
                }).error(function(data) {
                    $scope.showPhoneValidationMsg   = true;
                    $scope.data.textMsgPhone        = "* " + data.msg_status;
                    console.log("failure message: " + JSON.stringify({
                            data: data
                        }));
                });
            }
        });

        $scope.$watch('data.password + data.password_confirmation', function(){
            if($scope.data.password && $scope.data.password_confirmation){
                console.log($scope.data.password);
                console.log($scope.data.password_confirmation);
                if($scope.data.password != $scope.data.password_confirmation){
                    $scope.showPasswordValidationMsg    = true;
                    $scope.showPwdTickIcon              = false;
                    $scope.data.textMsgPwd              = "* The password does not match.";
                } else {
                    $scope.showPasswordValidationMsg    = false;
                    $scope.showPwdTickIcon              = true;
                }
            }
        });*/
    }]);