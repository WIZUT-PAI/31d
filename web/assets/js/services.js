'use strict';
/* Services */

var postmanServices = angular.module('postmanServices', ['ngResource']);
var userServices = angular.module('userServices', ['ngResource']);
var authorizationServices = angular.module('authorizationServices', ['ngResource']);
var taskServices = angular.module('taskServices', ['ngResource']);
var parcelServices = angular.module('parcelServices', ['ngResource']);
var senderServices = angular.module('senderServices', ['ngResource']);

parcelServices.factory('Parcel', ['$resource', 
	function($resource){
		return $resource('http://localhost:8000/api/v1/parcels/:parcelID.json', {}, {
			query: {method: 'GET', isArray: true, headers: {'Accept': 'application/json'}
			}
		})
	}]);
	
senderServices.factory('Sender', ['$resource', 
	function($resource){
		return $resource('http://localhost:8000/sender.json', {}, {
			query: {method: 'GET', isArray: true, headers: {'Accept': 'application/json'}
			}
		})
	}]);

postmanServices.factory('Postman', ['$resource',
  function ($resource) {
    return $resource('http://localhost:8000/api/postman/postmen.json', {}, {
      save: {method: 'POST', headers: {'Accept': 'application/json'}},
      get: {method: 'GET', isArray: false, headers: {'Accept': 'application/json'}}
    });
  }
]);

taskServices.factory('Task', ['$resource', 
  function($resource){
    return $resource('http://localhost:8000/postmantaskpanel.json', {}, {
     query: {method: 'GET', isArray: true, headers: {'Accept': 'application/json'}
    }
});
}]);

userServices.factory('User', ['$resource',
  function($resource) {
    return $resource('http://localhost:8000/login_check', {}, {
      login: {method: 'POST', headers: {'Accept': 'application/json'}}
    });
  }
]);

authorizationServices.factory('Authorization', ['$resource',
  function($resource) {
    return $resource('http://localhost:8000/api/user.json', {}, {
      get: {method: 'get', headers: {'Accept': 'application/json'}}
    });
  }
]);