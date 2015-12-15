
(function(window){

	/**
	* ManageAgentUser Module
	*
	* Description
	*/
	var IndexCtrl = function($scope,$http){
		var self = this;
		$scope.AgentModelCollection = [];
		self.getAllAgents = function(){
			$http.get("/agent/json")
				.then(function(response){
					$scope.AgentModelCollection = response.data;
				}, function(){
					alert('Cant retrieve list of user agents');
				})
		}
	}
	angular.module('ManageAgentUser', [])
		.controller('IndexCtrl', ['$scope','$http', IndexCtrl])
  

}(window));