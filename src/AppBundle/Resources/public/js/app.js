'use strict';
/* Modules */
var app = angular.module('postmanPanel', ['taskControllers','taskServices','dashboardControllers','userControllers','userServices',
										'postmanControllers','postmanServices','authorizationServices','postmanDirectives','ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/login',{
      templateUrl: '/bundles/app/partials/user/login-form.html',
      controller: 'LoginUserForm'
    }).
	when('/postman/new', {
      templateUrl: '/bundles/app/partials/postman/postman-form.html',
      controller: 'CreatePostmanForm'
	}).
	when('/postman/list',{
			templateUrl: '/bundles/app/partials/postman/postman-list.html',
			controller: 'TaskListCtrl'
	}).
	when('/tasklist',{
			templateUrl: '/bundles/app/partials/task-list.html',
			controller: 'TaskListCtrl'
	}).
	when('/senderlist',{
			templateUrl: '/bundles/app/partials/sender-list.html',
			controller: 'TaskListCtrl'		
	})
	.otherwise({
      templateUrl: '/bundles/app/partials/index.html',
      controller: 'Dashboard'
    });;
}]);
