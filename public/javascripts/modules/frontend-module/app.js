// app.js
// Namespacing the apps
var camfree = {

};

camfree.app = angular.module('app', []);

camfree.app.config(['$httpProvider', '$interpolateProvider',
    function($httpProvider, $interpolateProvider){
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }
]);