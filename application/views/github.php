<script type="text/javascript">
	var app = angular.module('app', []);

	app.controller('github', ['$scope', '$http',
	function($scope, $http) {
		
		$scope.usuarioGithub = 'magm84';
		$scope.token = '1dc6010c9bb47c5af9dd62419398922fd588b190';
		$scope.listaRepos = true;
		$scope.listaIssues = false;
		$scope.verNuevoIssue = false;
		$scope.issueActual = '';

		$scope.getGithub = function() {
			$scope.urlConsulta = 'https://api.github.com/users/'+$scope.usuarioGithub+'/repos';
			$scope.respuestaGithub = {};
			$http({
				method : 'GET',
				url : $scope.urlConsulta,
				headers : {
					'Content-type' : 'application/json'
				}
			}).then(function successCallback(res) {
				console.log('accediendo a la url: ' + $scope.urlConsulta);
				console.log(res.data);
				$scope.respuestaGithub = res.data;
			}, function errorCallback(res) {
				console.log('ocurrio un error al conectarse');
				if (res.status === 404) {
					console.log('no se encontro la dirección');
				}
			});
		}
		
		
		$scope.getIssues = function(name){
			$scope.issueActual = name;
			$scope.respuestaGithubIssues = {};
			$scope.listaRepos = false;
			var url = 'https://api.github.com/repos/'+$scope.usuarioGithub+'/'+name+'/issues';
			
			$http({
				method : 'GET',
				url : url,
				headers : {
					'Content-type' : 'application/json'
				}
			}).then(function successCallback(res) {
				
				console.log(res.data);
				$scope.respuestaGithubIssues = res.data;
				$scope.listaIssues = true;
			}, function errorCallback(res) {
				console.log('ocurrio un error al conectarse');
				if (res.status === 404) {
					console.log('no se encontro la dirección');
				}
			});			
			
		}
		
		$scope.createIssue = function(){
			if($scope.issueActual !== ''){
				var url = 'https://api.github.com/repos/'+$scope.usuarioGithub+'/'+$scope.issueActual+'/issues';
				console.log(url);

			$http({
				method : 'POST',
				url : url,
				headers : {
					'Content-type' : 'application/json',
					'Authorization': 'token ' + $scope.token
				},
				data: { 
					title: $scope.titleIssue,
					body: $scope.bodyIssue 
				}
			}).then(function successCallback(res) {
				
				console.log(res.data);
				$scope.getIssues($scope.issueActual);
				
			}, function errorCallback(res) {
				console.log('ocurrio un error al conectarse');
				if (res.status === 404) {
					console.log('no se encontro la dirección');
				}
			});				
			
			$scope.bodyIssue = '';
			$scope.titleIssue = '';	
					
			}else{
				console.log('no se ha seleccionado el issue actual');
			}
			
		}
		
		$scope.verRepos = function(){
			$scope.listaRepos = true;
			$scope.listaIssues = false;
			$scope.verNuevoIssue = false;
		}
		
		$scope.formIssue = function(){
			$scope.listaRepos = false;
			$scope.listaIssues = true;
			$scope.verNuevoIssue = true;			
		}
		
		
	}]); 
</script>
<div class="container-fluid" data-ng-controller="github" data-ng-init="getGithub()">
  <div class="row">
	<div class="col-md-12">
		<h1><?=$titulo?> ({{usuarioGithub}})</h1>
	</div>
  </div>
  
<div class="col-md-12" data-ng-if="listaIssues">
	<table class="table table-bordered table-striped">
		<tr data-ng-repeat="i in respuestaGithubIssues">
			<td>
				{{i.title}}
			</td>
			<td>
				{{i.body}}
			</td>
			<td>
				{{i.state}}
			</td>
			<td>
				{{i.updated_at}}
			</td>
		</tr>
	</table>
	<button class="btn btn-primary" data-ng-click="verRepos()">
		Regresar
	</button>
	<button class="btn btn-default" data-ng-click="formIssue()">
		Agregar Issue
	</button>
</div>

<div class="col-md-12 well" data-ng-show="verNuevoIssue" style="margin-top: 10px;">
<form>
  <div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" id="titulo" data-ng-model="titleIssue">
  </div>
  <div class="form-group">
    <label for="bodyIssue">Contenido</label>
    <textarea data-ng-model="bodyIssue" id="bodyIssue" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-default" data-ng-click="createIssue()">Enviar</button>
</form>	
</div>
  
<div class="col-md-12" data-ng-if="listaRepos">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td colspan="3">Repositorios</td>
				
			</tr>
		</thead>
		<tr data-ng-repeat="rep in respuestaGithub">
			<td>
				<a href="{{rep.html_url}}" target="_blank">{{rep.name}}</a>
			</td>
			<td>
				<a data-ng-click="getIssues(rep.name)">Ver Issues</a>
			</td>
		</tr>
	</table>
</div>
  <div class="row">
  	<center>
  		<a class="btn btn-primary btn-lg" href="<?=base_url()?>">API INSTAGRAM</a>	
  	</center>
  	
  </div>
</div>
