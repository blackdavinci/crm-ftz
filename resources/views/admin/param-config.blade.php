@extends('default')

{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

@section('title','Paramètres CRM')
@section('titre-entete','Configuration du CRM')

@include('default.top-nav')
@include('default.left-nav')

@section('content')

<div class="row">

	@include('admin.config-menu')

	<div class="col-md-9">
		<div class="panel panel-default">
		  <div class="panel-heading" style="text-align: center">
		  	@if($mode=="profil")
		  		Information sur la société
		  	@elseif($mode=='new')
			  	 Création des données de la société
			@elseif($mode=='edit')
					Modification des informations de la société
			@elseif($mode=='preference')
			  	 	Préférences utilisateur
			@elseif($mode=='create-preference')
			  	 	Configuration des préférences utilisateur
			@elseif($mode=='edit-pref')
			  	 	Modification des préférences utilisateur
			@elseif($mode=='gescom')
			  	 	Données de Gestion commerciale
			@elseif($mode=='create-gescom')
			  	 	Configuration des données de Gestion commerciale
			@elseif($mode=='edit-gescom')
			  	 	Modification des données de Gestion commerciale
		  	@endif
		  </div>
		  <div class="panel-body" >
			  	 @if($mode=='profil')
			  	 	@include('admin.societe-profil')
			  	 @elseif($mode=='new')
			  	 	@include('admin.new-societedata')
			  	 @elseif($mode=='edit')
			  	 	@include('admin.edit-societe-profil')
			  	 @elseif($mode=='preference')
			  	 	@include('admin.preference-config')
			  	 @elseif($mode=='create-preference')
			  	 	@include('admin.create-preference')
			  	 @elseif($mode=='edit-pref')
			  	 	@include('admin.edit-preference')
			  	 @elseif($mode=='gescom')
			  	 	@include('admin.gescom-config')
			  	 @elseif($mode=='create-gescom')
			  	 	@include('admin.create-gescom')
			  	 @elseif($mode=='edit-gescom')
			  	 	@include('admin.edit-gescom')
			  	 @endif
		  	
		  </div>
		</div>
	</div>


</div>

@stop
