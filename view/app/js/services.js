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
            },
            handle: function(data, tips) {
                if (!data.msg) {
                    if (data.code == 0) {
                        return true;
                    }
                    data.msg = '服务器繁忙，请稍后重试。';
                }
                var ok = false;
                switch (data.code) {
                    case 0: tips.type = 'success';
                        ok = true;
                        break;
                    case 1: tips.type = 'info';
                        break;
                    case 2: tips.type = 'warning';
                        break;
                    case 3: tips.type = 'danger';
                        break;
                    default : tips.type = 'success';
                }
                tips.msg = data.msg;
                $rootScope.$broadcast('tips.display');
                return ok;
            },
            callback: function(callback) {
                var tips = this;
                return function(data) {
                    if (tips.handle(data, tips)) {
                        if (callback.success) {
                            callback.success(data);
                        }
                    } else {
                        if (callback.failure) {
                            callback.failure(data);
                        }
                    }
                };
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
