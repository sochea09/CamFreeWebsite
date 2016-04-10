// run.js

camfree.app.run(['$rootScope',
    function($rootScope) {
        $rootScope.apiUrl = "";

        $rootScope.ucWords = function(str) {
            if (str && str.length > 0)
                return str.replace(/\w\S*/g, function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
        };

        $rootScope.toUpperCase = function(str) {
            if (str && str.length > 0)
                return str.replace(/\w\S*/g, function(txt) {
                    return txt.toUpperCase();
                });
        };

        $rootScope.getDateTime = function(time) {
            // console.log(time);
            if (time === 'Unknown') {
                return 'Unknown';
            } else {
                return moment(time).format('MMM DD, YYYY h:mm A');
            }
        };
    }
]);

angular.bootstrap(document, ['app']);
