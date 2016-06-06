'use strict';
	
/* Controllers */

var parcelControllers = angular.module('mobilepostControllers', []);

parcelControllers.controller('PostmanListCtrl', ['$scope', 'Postman',
    function($scope, Postman) {
        $scope.postmen = Postman.query();
    }]);

parcelControllers.controller('CreatePostmanFormCtrl', ['$scope', '$window', 'Parcel',
    function($scope, $window, Parcel) {
        $scope.submit = function() {
            Parcel.save($scope.parcel, function() {
                $window.location.href = "#";
            });		
        };
    }]);

parcelControllers.controller('UpdatePostmanFormCtrl', ['$scope', '$routeParams', 'Parcel', '$window',
    function($scope, $routeParams, Parcel, $window) {
        $scope.parcel = Parcel.get({parcelId: $routeParams.parcelId});
        
        $scope.submit = function() {
            Parcel.update($scope.parcel, function() {
                $window.location.href = "#";
            });		
        }
        
        $scope.delete = function() {
            var answer = confirm("Are you sure you want to delete this parcel?");
            if (answer) {
                Parcel.delete({parcelId: $routeParams.parcelId}, function() {
                    $window.location.href = "#";
                });		
            }
        }
    }]);

parcelControllers.controller('ParcelordersCtrl', ['$scope', 'ParcelOrder', 
    function ($scope, ParcelOrder) {    
        $scope.data = ParcelOrder.query();
    }]);

parcelControllers.controller('LoginCtrl', ['$scope', '$location', 'User', 
    function ($scope, $location, User) {
        $scope.loginFailed = false;
        $scope.login = function () {
            User.login($scope.username, $scope.password).then(function (user) {
                $location.path('/');
            }, function () {
                $scope.loginFailed = true;
            });
        };
    }]);

parcelControllers.controller('HomeCtrl', ['$scope', '$location', 'User', 
    function ($scope, $location, User) {
        User.getCurrentUser().then(function (user) {
            if (user.roles.indexOf('ROLE_ADMIN') != -1) {
                // Homepage for admin
                $location.path('/assigntasks');
            } 
            else {
                // Homepage for postman
                $location.path('/parcelorders');
            }
        }, function () {
            // Homepage for not logged in user (login form)
            $location.path('/login');
        });
    }]);

parcelControllers.controller('AssignTasksCtrl', ['$scope', '$q', 'ParcelOrder', 'Postman', 'Task', 
    function ($scope, $q, ParcelOrder, Postman, Task) {
        function reloadOrders() {
            $scope.orders = ParcelOrder.queryUnassigned();
        }
        reloadOrders();
        $scope.postmans = Postman.query();
        $scope.saveAssignments = function () {
            promises = [];
            $scope.orders.forEach(function (order) {
                if (order.assignTo) {
                    promises.push(Task.post({'parcelOrder': order.id, 'postman': +order.assignTo}).$promise);
                }
            });
            if (!promises.length) {
                alert('Nie wybrano żadnego zlecenia do przydzielenia');
            } else {
                $q.all(promises).then(function () {
                    reloadOrders();
                    alert('Przydzielenia zostały zapisane');
                });
            }
        };
    }]);

parcelControllers.controller('TaskListCtrl', ['$scope', 'Task',
    function($scope, Task) {
        $scope.tasks = Task.query();
    }]);
