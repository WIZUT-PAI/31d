'use strict';
	
/* Modules */
	
var app = angular.module('mobilePost', [	
	'mobilepostControllers',
	'mobilepostServices',
	'mobilepostDirectives',
	'ngRoute'
	]);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
		.when('postmen/new', {
			templateUrl: '/bundles/app/partials/postman-form.html', 
			controller: 'CreatePostmanFormCtrl'
		})
		.when('postmen/:parcelId', {
			templateUrl: '/bundles/app/partials/postman-form.html', 
			controller: 'UpdatePostmanlFormCtrl'
		})
    	.when('postmen',{
			templateUrl: '/bundles/app/partials/postman-list.html',
			controller: 'PostmenListCtrl'
		})
        .when('/parcelorders', {
            'templateUrl': '/bundles/app/partials/parcelorders.html',
            'controller': 'ParcelordersCtrl'
        })
        .when('/login', {
            'templateUrl': '/bundles/app/partials/login.html',
            'controller': 'LoginCtrl'
        })
        .when('/tasks', {
            'templateUrl': '/bundles/app/partials/task-list.html',
            'controller': 'TaskListCtrl'
        })
        .when('/assigntasks', {
            'templateUrl': '/bundles/app/partials/assigntasks.html',
            'controller': 'AssignTasksCtrl'
        })
        .otherwise({
            'template': '',
            'controller': 'HomeCtrl'
        });
}]);
