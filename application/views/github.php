<script type="text/javascript">
	var app = angular.module('app',[]);	
	app.controller('github', ['$scope','$http',function($scope,$http) {
	
	$scope.getGithub = function(){
		
	}
	
}]);
</script>
<div class="container-fluid" data-ng-controller="github" data-ng-init="getGithub()">
  <div class="row">
	<div class="col-md-12">
		<h1><?=$titulo?></h1>
	</div>
  </div>

  <div class="row">
  	<center>
  		<a class="btn btn-primary btn-lg" href="<?=base_url()?>github">API INSTAGRAM</a>	
  	</center>
  	
  </div>
</div>
