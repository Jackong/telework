'use strict';

/* Controllers */

angular.module('light.controllers', []).
    controller('CategoryCtrl', ['$scope', '$routeParams', 'Jobs', function($scope, $routeParams, Jobs) {
        $('#wrapper').toggleClass('active');
        Jobs.query({categoryId: $routeParams.categoryId}, function(jobs) {
            $scope.jobs = jobs;
        });
    }]).
    controller('JobCtrl', ['$scope', 'Jobs', function($scope, Jobs) {
        Jobs.query({categoryId: 0}, function(jobs) {
            $scope.jobs = jobs;
        });
    }]);