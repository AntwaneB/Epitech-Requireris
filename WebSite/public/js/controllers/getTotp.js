(function() {

  'use strict';
    
    angular
        .module('get')
        .controller('getTotp', getTotp);
    function getTotp($scope, $http) {
        $scope.init = function(id)
        {
            $scope.id = id;
            $scope.get();
        }
        $scope.get = function()
        {
        	var response = $http.get("/authenticator/" + $scope.id);
        	response.success(function(data) {
        		console.log(data);
        		$scope.totp = data;
                console.log($scope.totp);
        	});
            response.error(function(data) {
            	console.log("AJAX failed!");
            });
        };
	}
})();