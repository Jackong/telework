'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('light.services', [])
    .service('Job', ['$resource', function($resource) {
        return $resource();
    }]);
