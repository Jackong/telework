'use strict';

/* Controllers */

angular.module('light.controllers', []).
    controller('SidebarCtrl', ['$scope', function($scope) {
        $scope.categories = [
            {id: 1, name: '设计师'},
            {id: 2, name: '开发工程师'},
            {id: 3, name: '商务师'},
            {id: 5, name: '广告文字撰稿人'},
            {id: 6, name: '系统管理员'},
            {id: 7, name: '客服支持'},
            {id: 4, name: '杂项'}
        ];
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
        $('#wrapper').toggleClass('active');
        Jobs.query({categoryId: $routeParams.categoryId}, function(jobs) {
            $scope.jobs = jobs;
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
                Jobs.query({categoryId: $routeParams.category}, function(jobs) {
                    $scope.jobs = jobs;
                });
            });
    }])
    .controller('JobCtrl', ['$scope', 'Jobs', function($scope, Jobs) {
        Jobs.query({categoryId: 0}, function(jobs) {
            $scope.jobs = jobs;
        });
    }]).
    controller('ModalCtrl', ['$scope', '$resource', 'Tips', function($scope, $resource, Tips) {
        $scope.subscribe = {
            id: 'subscribe',
            label: '订阅职位',
            submit: function() {
                $resource('light/subscription').save({
                    email: this.email,
                    category: this.category.id
                }, function(data) {
                    if (data.code == 0) {
                        Tips.display('success', "提交成功，请查收邮件并确认你是邮箱的主人。");
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