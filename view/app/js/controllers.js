'use strict';

/* Controllers */

angular.module('light.controllers', []).
    controller('SidebarCtrl', ['$scope', '$resource', 'Category', function($scope, $resource, Category) {
        $resource('light/categories').get({}, function(data){
            $scope.categories = data.categories;
            Category.init($scope.categories, 2);
        });
    }])
    .controller('ViewCtrl', ['$scope', 'Tips', function($scope, Tips) {
        $scope.$on('tips.display', function(event) {
            $scope.tips = {
                type: Tips.type,
                msg: Tips.msg
            };
        });
    }])
    .controller('CategoryCtrl', ['$scope', '$routeParams', 'Jobs', 'Category', function($scope, $routeParams, Jobs, Category) {
        $scope.category = 0;
        if ($routeParams.categoryId != 0) {
            $scope.category = $routeParams.categoryId;
            Category.selected($scope.category);
            $('#wrapper').toggleClass('active');
        }
        Jobs.get({categoryId: $scope.category}, function(data) {
            $scope.jobs = data.jobs;
        });
    }])
    .controller('ConfirmCtrl', ['$scope', '$routeParams', 'Jobs', '$resource', 'Tips', 'Category',
        function($scope, $routeParams, Jobs, $resource, Tips, Category) {
            Category.selected($routeParams.category);
            $resource('light/confirm/:id/:email/:category')
                .get({
                    id: $routeParams.id
                    , email: $routeParams.email
                    , category: $routeParams.category
                }
                ,function(data) {
                    if (data.code == 0) {
                        Tips.display('success', data.msg);
                    } else {
                        Tips.display('warning', data.msg);
                    }
                    Jobs.get({categoryId: $routeParams.category}, function(data) {
                        $scope.jobs = data.jobs;
                    });
                });
    }])
    .controller('JobCtrl', ['$scope', '$routeParams', '$resource', 'Tips', function($scope, $routeParams, $resource, Tips) {
        $resource('light/jobs/:category/:id')
            .get({
                category: $routeParams.category,
                id: $routeParams.id
            }
            ,Tips.callback({success: function(data) {
                $scope.job = data.job;
            }})
        );
    }]).
    controller('ModalCtrl', ['$scope', '$resource', 'Tips', 'Category', function($scope, $resource, Tips, Category) {
        $scope.$on('category.selected', function(event) {
            $scope.category = Category.value;
        });
        $scope.subscribe = {
            id: 'subscribe',
            label: '订阅职位',
            submit: function() {
                var email = this.email;
                $resource('light/subscription').save({
                    email: email,
                    category: $scope.category.id
                }, function(data) {
                    if (data.code == 0) {
                        Tips.display('success', "提交成功，请<a href='mailto:" + email + "'>查收邮件</a>并确认你是邮箱的主人。");
                    } else {
                        Tips.display('warning', data.msg);
                    }
                });
            }
        };
        $scope.recruit = {
            id: 'recruit',
            label: '发布职位',
            submit: function() {
                $resource('light/recruit').save({
                    company: this.company,
                    homepage: this.homepage,
                    logo: this.logo,
                    category: $scope.category.id,
                    title: this.title,
                    description: this.description,
                    contact: this.contact
                });
            }
        };
        $scope.feedback = {
            id: 'feedback',
            label: '反馈',
            submit: function() {
                $resource('light/feedback').save(
                    {contact: this.contact, content: this.content}
                    ,function(data) {
                        Tips.display('success', '感谢反馈，我们会尽快处理。');
                    }
                );
            }
        };
        $scope.about = {
            id: 'about',
            label: '关于'
        };
        $scope.donate = {
            id: 'donate',
            label: '捐助'
        };
    }]);