@extends('default')


@section('title','Produit')
@section('titre-entete')
	<div class="pull-left" style="margin:-6px 4px 4px 4px;">
			<a class="btn btn-danger btn-smenu-position" href="{{ route('produit.index')}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 
			</a>
			{{ 'Détail Produit '.$detail->nom_produit}}
	</div>
@stop

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	<div class="masthead">
		<div class="inner">
		  <nav>
			<ul class="nav masthead-nav">
			  <li class="active"><a href="#">Informations</a></li>
			  <li><a href="#">Notes</a></li>
			  <li><a href="#">Fichiers</a></li>
			  <li><a href="#">Historique</a></li>
			</ul>
		  </nav>
		</div>
		<div class="pull-right" style="margin:4px;">
		    <a class="btn btn-primary btn-smenu-position" href="{{ route('module.creer',[$detail->id])}}" role="button">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Ajout module
			</a>
		    <a class="btn btn-warning btn-smenu-position" href="{{ route('produit.edit',[$detail->id])}}" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
			</a>
			<!-- Button de Suppression modal -->
			<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
			</button>
			<!-- Modal de confirmation de suppression -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer le produit <strong>{{ $detail->nom_produit }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('produit.destroy',[$detail->id]), 'method'=>'delete']) !!}
				      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
				      	{!! Form::close() !!}
			      	</div>

			      </div>
			    </div>
			  </div>
			</div>
			 
		</div>
	</div>
@stop

@section('content')
	


	<!-- Compteur pour l'afficahge en grille -->
	{{--*/ $i = 0 /*--}}
	<table class=" table-noborder-top  table-module table">
			<tr><td><span class="head-title">Détail du produit</span></td></tr>
			<tr> 
	  			<td><span class="title-profil">Nom du produit</span></td>
	  			<td><span class="info">{{ $detail->nom_produit }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Prefixe devis du produit</span></td>
	  			<td><span class="info">{{ $detail->prefix_produit }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Suffixe devis du produit</span></td>
	  			<td><span class="info">{{ $detail->suffix_produit }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Version du produit</span></td>
	  			<td><span class="info">{{ $detail->vers_produit }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Description du produit</span></td>
	  			<td><span class="info">{{ $detail->desc_produit }}</span></td>
	  		</tr>
	  		
	</table>
					
	<!-- Affichage les modules du produits -->
	<table class=" table table-noborder-top  table-module">
		<tr><td><span class="head-title">module(s)</span></td></tr>
	@foreach($listmodule as $module)
	  		@if($i==0)<tr> {{--*/ $i = 3/*--}}@endif
	  		  {{--*/ $i-=1 /*--}}
	  		  	<td style="padding-left:35px;">
	  		  		    <a href="{{route('module.show',[$module->id])}}"><p class="media-heading">{{ $module->nom_module}}</p></a>
	  		  	</td>
	
	  		@if($i==0)</tr> @endif
	 @endforeach
	</table>
@stop
