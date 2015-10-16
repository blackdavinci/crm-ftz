@extends('default')

@section('title','Gestion d\'utilisateur')
@section('titre-entete','Gestion des utilisateurs')

@include('default.top-nav')
@include('default.left-nav')

@section('content')

<div class="row">

	@include('admin.user-menu')

	<div class="col-md-9">
		<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center"><strong>Nouvel utilisateur</strong></div>
		  <div class="panel-body" >
		  	
		  	@if (count($errors) > 0)
		  		<div class="alert alert-danger">
		  			<strong>Whoops!</strong> Il y a quelques problèmes avec les champs suivants.<br><br>
		  			<ul>
		  				@foreach ($errors->all() as $error)
		  					<li>{{ $error }}</li>
		  				@endforeach
		  			</ul>
		  		</div>
		  	@endif

		  	<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
		  		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		  		<div class="form-group">
		  			<label class="col-md-4 control-label">Nom</label>
		  			<div class="col-md-6">
		  				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
		  			</div>
		  		</div>

		  		<div class="form-group">
		  			<label class="col-md-4 control-label">Prenom(s)</label>
		  			<div class="col-md-6">
		  				<input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}">
		  			</div>
		  		</div>

		  		<div class="form-group">
		  			<label class="col-md-4 control-label">Nom d'utilisateur</label>
		  			<div class="col-md-6">
		  				<input type="text" class="form-control" name="username" value="{{ old('username') }}">
		  			</div>
		  		</div>

		  		<div class="form-group">
		  			<label class="col-md-4 control-label">Rôle</label>
		  			<div class="col-md-6">
		  				{!! Form::select('role',['admin'=>'Administrateur','simple'=>'Simple Utilisateur'],'simple',['class'=>'form-control'])!!}
		  			</div>

		  		</div>
		  	
		  		<div class="form-group">
		  			<label class="col-md-4 control-label">Mot de passe</label>
		  			<div class="col-md-6">
		  				<input type="password" class="form-control" name="password">
		  			</div>
		  		</div>

		  		<div class="form-group">
		  			<label class="col-md-4 control-label">Confirmer mot de passe</label>
		  			<div class="col-md-6">
		  				<input type="password" class="form-control" name="password_confirmation">
		  			</div>
		  		</div>

		  		<div class="form-group">
		  			<div class="col-md-6 col-md-offset-4">
		  				<button type="submit" class="btn btn-primary">
		  					Enregistrer
		  				</button>
		  			</div>
		  		</div>
		  	</form>


				
		  </div>
		</div>
	</div>


</div>

@stop

