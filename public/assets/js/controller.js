angular.module('silexCasts')
       .controller('FirstCtrl', function($scope, $http){
       		$scope.users = {};

       		$http.get('http://localhost:3030/api/users').then(
       			function(d){
       				$scope.users = d.data;
       			},
       			function(e){
       				console.log(e);
       			}
       		);
       });