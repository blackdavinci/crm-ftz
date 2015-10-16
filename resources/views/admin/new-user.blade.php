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
			  @include('auth.create-user')
		  </div>
		</div>
	</div>


</div>

@stop
