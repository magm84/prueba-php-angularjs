<script type="text/javascript">
	var app = angular.module('app',[]);	
	app.controller('instagram', ['$scope','$http',function($scope,$http) {
	
	$scope.getInstagram = function(){
	$scope.urlConsulta = 'https://api.instagram.com/v1/media/popular?client_id=d9799f8dc55b48718596a7d36e9c7ae7&callback=JSON_CALLBACK';
	$scope.respuestaInstagram = {};	
$http({
  method: 'JSONP',
  url: $scope.urlConsulta,
}).then(function successCallback(res) {
   console.log('accediendo a la url: '+$scope.urlConsulta);
   $scope.respuestaInstagram = res.data.data;
  }, function errorCallback(res) {
    console.log('ocurrio un error al conectarse');
    if(res.status === 404){
    	console.log('no se encontro la dirección');
    }
  });
		
	}
	
}]);
</script>
<div class="container-fluid" data-ng-controller="instagram" data-ng-init="getInstagram()">
  <div class="row">
	<div class="col-md-12">
		<h1><?=$titulo?></h1>
	</div>
  </div>
  <div class="row">
  	<div class="col-md-3 col-xs-12" data-ng-repeat="foto in respuestaInstagram" style="margin-bottom:20px;">
  		<center>
  		<a href="{{foto.link}}" target="_blank" title="{{foto.caption.text}}"><img src="{{foto.images.low_resolution.url}}" class="img-responsive img-thumbnail" /></a>
  		<br />
  		<br />
  			<a href="https://instagram.com/{{foto.caption.from.username}}" class="btn btn-success" target="_blank">Foto de {{foto.caption.from.username}}</a>	
  		</center>
  		
  	</div>
  </div>
  <div class="row">
  	<center>
  		<a class="btn btn-primary btn-lg" href="<?=base_url()?>github">API GITHUB</a>	
  	</center>
  	
  </div>
</div>
