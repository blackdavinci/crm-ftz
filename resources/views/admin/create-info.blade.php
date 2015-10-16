@extends('default')

@section('title','Gestion d\'utilisateur')
@section('titre-entete','Information de connection')

@include('default.top-nav')
@include('default.left-nav')

@section('content')

<div class="row">

	@include('admin.user-menu')

	<div class="col-md-9">
		<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center">Information de connection du nouvel utilisateur</div>
		  <div class="panel-body" >
		  	<div class="row">
		  		<div class="col-md-5"><h4>Nom & Prénom</h4></div><div class="col-md-5"><h5><i>{{ $name.' '.$prenom }}</i></h5></div>
		  	</div>
			<div class="row">
				<div class="col-md-5"><h4>Nom d'utilisateur : </h4></div><div class="col-md-5"><h5><i>{{ $username }}</i></h5></div>
			</div>
			<div class="row">
				<div class="col-md-5"><h4>Mot de passe: </h4></div><div class="col-md-5"><h5><i>{{ $password }}</i></h5></div>
			</div>
		  </div>
		</div>
	</div>


</div>

@stop
