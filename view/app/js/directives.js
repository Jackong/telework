'use strict';

/* Directives */


angular.module('light.directives', []).
    directive('dcModal', function() {
        return {
            restrict: 'E',
            scope: {
                info: '='
            },
            transclude:true,
            templateUrl: 'partials/modal.html'
        };
    });
