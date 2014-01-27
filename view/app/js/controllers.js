'use strict';

/* Controllers */

angular.module('light.controllers', []).
    controller('CategoryCtrl', ['$scope', '$resource', '$routeParams', function($scope, $resource, $routeParams) {
        $resource('light/jobs/:categoryId').query({categoryId: $routeParams.categoryId}, function(jobs) {
            $scope.jobs = jobs;
        });
    }]).
    controller('JobCtrl', ['$scope', '$resource', function($scope, $resource) {
        $resource('light/jobs/:categoryId').query({categoryId: 0}, function(jobs) {
            $scope.jobs = jobs;
        });
    }]);