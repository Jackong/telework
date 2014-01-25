'use strict';

/* Controllers */

angular.module('light.controllers', []).
  controller('JobCtrl', ["$scope", '$resource', function($scope, $resource) {
        $scope.jobs = $resource('light/jobs', {}, {
            query: {method:'GET', params:{}, isArray:true}
        }).query();
  }]);