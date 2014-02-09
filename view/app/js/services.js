'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('light.services', [])
    .factory('Jobs', ['$resource', function($resource) {
        return $resource('light/jobs/:categoryId');
    }])
    .service('Tips', ['$rootScope', function($rootScope) {
        return {
            type: '',
            msg: '',
            display: function(type, msg) {
                this.type = type;
                this.msg = msg;
                $rootScope.$broadcast('tips.display');
            }
        };
    }])
    .service('Category', ['$rootScope', function($rootScope) {
        return {
            value: null,
            categories: [],
            init: function(categories, selected) {
                this.categories = categories;
                this.selected(selected);
            },
            selected: function(id) {
                for(var index = 0; index < this.categories.length; ++index) {
                    var category = this.categories[index];
                    if (category.id == id) {
                        this.value = category;
                        break;
                    }
                }
                $rootScope.$broadcast('category.selected');
            }
        }
    }]);
