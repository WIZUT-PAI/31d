'use strict';
/* Modules */
var app = angular.module('postmanPanel', ['taskControllers', 'parcelControllers', 'parcelServices', 'senderControllers', 'senderServices',
										  'taskServices',
										  'dashboardControllers',
										  'userControllers',
										  'userServices',
											'postmanControllers',
											'postmanServices',
										  'authorizationServices',
											'postmanDirectives',
										  'ngRoute'
										  ]);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider.
	when('/register',{
		templateUrl: '/bundles/app/partials/user/register-form.html',
		controller: 'RegisterUserForm'
    }).
    when('/register/confirmed',{
		templateUrl: '/bundles/app/partials/user/register-confirmed-form.html',
		controller: 'RegisterConfirmed'
    }).
	when('/login',{
		templateUrl: '/bundles/app/partials/user/login-form.html',
		controller: 'LoginUserForm'
    }).
	when('/postman/new', {
		templateUrl: '/bundles/app/partials/postman/postman-form.html',
		controller: 'CreatePostmanForm'
	}).
	when('/tasklist',{
			templateUrl: '/bundles/app/partials/task-list.html',
			controller: 'TaskListCtrl'
	}).
	when('/senderlist',{
		templateUrl: '/bundles/app/partials/sender-list.html',
		controller: 'SenderListCtrl'
	}).
	when('/parcellist',{
			templateUrl: '/bundles/app/partials/parcel-list.html',
			controller: 'ParcelListCtrl'
	}).
	otherwise({
      templateUrl: '/bundles/app/partials/index.html',
      controller: 'Dashboard'
    });;
}]);
