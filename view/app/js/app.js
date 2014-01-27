'use strict';


// Declare app level module which depends on filters, and services
angular.module('light', [
  'ngRoute',
  'ngResource',
  'light.filters',
  'light.services',
  'light.directives',
  'light.controllers'
]).
config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/', {templateUrl: 'partials/jobs.html', controller: 'JobCtrl'});
    $routeProvider.when('/jobs/:categoryId', {templateUrl: 'partials/jobs.html', controller: 'CategoryCtrl'});
    $routeProvider.when('/confirm/:id/:email/:category', {templateUrl: 'partials/jobs.html', controller: 'ConfirmCtrl'});
    $routeProvider.otherwise({redirectTo: '/'});
}]);
