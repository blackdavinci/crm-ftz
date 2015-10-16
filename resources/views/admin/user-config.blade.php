@extends('default')

@section('title','Gestion d\'utilisateur')
@section('titre-entete','Gestion des utilisateurs')

@include('default.top-nav')
@include('default.left-nav')

@section('content')

	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

<div class="row">

	@include('admin.user-menu')

	<div class="col-md-9">
		<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center">
		  	@if($actif=='liste')
		  		<strong>Utilisateurs </strong>
		  	@elseif(isset($profil))
		  			@if($actif=='profil')
		  				<strong>Profil {{ $profil->name.' '.$profil->prenom }}</strong>
		  			@elseif($actif=='edit')
		  				<strong>Modification du profil : {{ $profil->name.' '.$profil->prenom }}</strong>
		  			@elseif($actif=='setpass')
		  				<strong>Modification du mot de passe de l'utilisateur : {{ $profil->name.' '.$profil->prenom }}</strong>
		  			@endif
		  	@endif
		  </div>
		  <div class="panel-body" >
		  	@if($actif=='liste')
			  @include('admin.list-user')
			@elseif(isset($profil))
				@if($actif=='profil')
			  		@include('admin.profil-user')
				@elseif($actif=='edit')
					@include('admin.edit-profil')
				@elseif($actif=='setpass')
					@include('admin.set-password')
				@elseif(isset($username))
					<div class="row">
						<div class="col-md-3"><h3>Nom d'utilisateur : </h3></div><div class="col-md-8">{{ $username }}</div>
					</div>
					<div class="row">
						<div class="col-md-3"><h3>Mot de passe: </h3></div><div class="col-md-8">{{ $password }}</div>
					</div>
				@endif
			@endif
				
		  </div>
		</div>
	</div>


</div>

@stop

