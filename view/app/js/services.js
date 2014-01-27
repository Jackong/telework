'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('light.services', [])
    .factory('Jobs', ['$resource', function($resource) {
        return $resource('light/jobs/:categoryId');
    }]);
