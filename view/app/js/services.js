'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('light.services', [])
    .factory('Jobs', ['$resource', function($resource) {
        return $resource('light/jobs/:categoryId');
    }])
    .service('Tips', ['$rootScope', '$sce', function($rootScope, $sce) {
        return {
            type: '',
            msg: '',
            display: function(type, msg) {
                this.type = type;
                this.msg = $sce.trustAsHtml(msg);
                $rootScope.$broadcast('tips.display');
            }
        };
    }]);
