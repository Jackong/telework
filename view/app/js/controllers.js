'use strict';

/* Controllers */

angular.module('light.controllers', []).
    controller('SidebarCtrl', ['$scope', '$resource', function($scope, $resource) {
        $resource('light/categories').get({}, function(data){
            $scope.categories = data.categories;
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
    .controller('CategoryCtrl', ['$scope', '$routeParams', 'Jobs', function($scope, $routeParams, Jobs) {
        if ($routeParams.categoryId) {
            $('#wrapper').toggleClass('active');
        }
        Jobs.get({categoryId: $routeParams.categoryId}, function(data) {
            $scope.jobs = data.jobs;
        });
    }])
    .controller('ConfirmCtrl', ['$scope', '$routeParams', 'Jobs', '$resource', 'Tips',
        function($scope, $routeParams, Jobs, $resource, Tips) {
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
    .controller('JobCtrl', ['$scope', '$routeParams', '$resource', function($scope, $routeParams, $resource) {
        $resource('light/jobs/:category/:id')
            .get({
                category:0,
                id: $routeParams.id
            }
            ,function(data) {
                $scope.job = data.job;
            }
        );
    }]).
    controller('ModalCtrl', ['$scope', '$resource', 'Tips', function($scope, $resource, Tips) {
        $scope.subscribe = {
            id: 'subscribe',
            label: '订阅职位',
            submit: function() {
                var email = this.email;
                $resource('light/subscription').save({
                    email: email,
                    category: this.category.id
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
                    category: this.category.id,
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