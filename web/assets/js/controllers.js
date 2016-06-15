'use strict';
/* Controllers */
var postmanControllers = angular.module('postmanControllers', []);
var taskControllers = angular.module('taskControllers', []);
var userControllers = angular.module('userControllers', []);
var dashboardControllers = angular.module('dashboardControllers', []);
var parcelControllers = angular.module('parcelControllers', []);
var senderControllers = angular.module('senderControllers', []);

parcelControllers.controller('ParcelListCtrl', ['$scope', 'Parcel', 
	function($scope, Parcel){
		$scope.parcels = Parcel.query();
	}]);
	
senderControllers.controller('SenderListCtrl', ['$scope', 'Sender',
	function($scope, Sender){
		$scope.senders = Sender.query();
	}]);

taskControllers.controller('TaskListCtrl', ['$scope', '$window', 'Task', 'Authorization',
 function($scope, $window, Task, Authorization) {
  Authorization.get(function(data){
      if(data.roles != 'ROLE_ADMIN'){
        $window.location.href = '#/login';
      }
      else{
        $scope.authorization = true;
        $scope.tasks = Task.query();
      }
    });
}]);

dashboardControllers.controller('Dashboard', ['$scope', '$window','Authorization', 
  function($scope, $window, Authorization){
    $scope.authorization = false;
    
    Authorization.get(function(data){
      if(data.roles != 'ROLE_ADMIN'){
        $window.location.href = '#/login';
      }
      else{
        $scope.authorization = true;
      }
    });
  }
]);

postmanControllers.controller('CreatePostmanForm', ['$scope', '$window',
  'Postman', 'Authorization',  function ($scope, $window, Postman, Authorization) {
    $scope.authorization = false;
    
    Authorization.get(function(data){
     if(data.roles == 'ROLE_ADMIN'){
        $scope.authorization = true;
        
        $scope.submit = function () {
          Postman.save($scope.postman, function () {
            $window.location.href = '#';
          }, function (data, status, headers, config) {
            console.log(data);
            $scope.errors = {};
            $scope.errors.user={};
            $scope.errors.user.plainPassword={};

            if(data.status == 400){

              angular.forEach(data.data.errors.children, function(value, key){
                if(Array.isArray(value.errors)){
                  $scope.errors[key] = value.errors.join(',');
                }
              });

              angular.forEach(data.data.errors.children.user.children, function(value, key){
                if(Array.isArray(value.errors)){
                  $scope.errors.user[key] = value.errors.join(',');
                }
              });
               angular.forEach(data.data.errors.children.user.children.plainPassword.children, function(value, key){
                if(Array.isArray(value.errors)){
                  $scope.errors.user.plainPassword[key] = value.errors.join(',');
                }
              });
            }
          });
        };
      }
      else{
        $window.location.href = '#/login';
      }
    });
  }
]);

userControllers.controller('LoginUserForm', ['$scope', '$http', '$window', 'User', 
  function ($scope, $http, $window, User) {
    $scope.submit = function () {
      User.login($scope.user, function(data, status, headers, config){
          $window.location.href = '#';
      }, function(data, status, headers, config){
        console.log(data);
        $scope.errors = {};
        
        if(data.status == 400){
          $scope.errors = data.data.message;
        }
      });
    }
  }
]);
