@extends('default')


@section('title','Module')
@section('titre-entete','Détail Module '.$detail->nom_module)

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	<div class="masthead">
		<div class="pull-left" style="margin:4px;">
		 	<a class="btn btn-primary btn-smenu-position" href="{{ route('module.index')}}" role="button">Retour Liste Modules</a>
			<a class="btn btn-danger btn-smenu-position" href="{{ route('produit.index')}}" role="button">Retour Liste Produits</a>
		</div>
		<div class="pull-right" style="margin:4px;">
		    <a class="btn btn-warning btn-smenu-position" href="{{ route('module.edit',[$detail->id])}}" role="button">
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
			        <h4 class="modal-title" id="myModalLabel">Suppression de module</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer le module <strong>{{ $detail->nom_module }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('module.destroy',[$detail->id]), 'method'=>'delete']) !!}
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
			<tr><td><span class="head-title">Détail du module</span></td></tr>
			<tr> 
	  			<td><span class="title-profil">Nom du module</span></td>
	  			<td><span class="info">{{ $detail->nom_module }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Version du module</span></td>
	  			<td><span class="info">{{ $detail->vers_module }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Description du module</span></td>
	  			<td><span class="info">{{ $detail->desc_module }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Prix du module</span></td>
	  			<td><span class="info">{{ $detail->prix_module }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Type de module</span></td>
	  			<td>
	  				<span class="info">
	  					@if($detail->type_module=='SD') 
	  						Simple avec duré 
	  					@else
	  						{{ $detail->type_module }}
	  					@endif 
	  				</span>
	  			</td>
	  		</tr>
	  		@unless($detail->produits->isEmpty())
	  		<tr> 
	  			<td><span class="title-profil">Produi(s) lié(s) : </span></td>
	  			<td><span class="info">
	  			@foreach($detail->produits as $produit)
	  				<p style="float:left; margin-right:5px;">
	  					<a href="{{ route('produit.show',[$produit->id])}}">{{ $produit->nom_produit }}</a>
	  				</p>
	  			@endforeach

	  			</span></td>
	  		</tr>
	  		@endunless
	  		
	</table>
					
@stop
