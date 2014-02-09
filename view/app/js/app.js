'use strict';


// Declare app level module which depends on filters, and services
angular.module('light', [
  'ngRoute',
  'ngResource',
  'ngSanitize',
  'light.filters',
  'light.services',
  'light.directives',
  'light.controllers'
]).
config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/jobs/:categoryId', {templateUrl: 'partials/jobs.html', controller: 'CategoryCtrl'})
        .when('/jobs/:category/:id', {templateUrl: 'partials/job.html', controller: 'JobCtrl'})
        .when('/confirm/:id/:email/:category', {templateUrl: 'partials/jobs.html', controller: 'ConfirmCtrl'})
        .otherwise({redirectTo: '/jobs/0'});
}]);
