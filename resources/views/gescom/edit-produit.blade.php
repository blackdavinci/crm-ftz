@extends('default')


@section('title','Modification du produit')
@section('titre-entete','Modification des informations du produit '.$detail->nom_produit)
			
@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	{!! Form::open(['method' =>'PUT','route' =>['produit.update',$detail->id]]) !!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('produit.show',[$detail->id])}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
			</a>
		  	<div class="form-group ">
				{!! Form::submit('Enregistrer les modifications',['class' =>'btn btn-danger btn-smenu-position dropdown-toggle']) !!}
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
	  			<td><span class="title-profil">{!! Form::label('produit','Nom du produit') !!}</span></td>
	  			<td><span class="info">{!! Form::text('nom_produit',$detail->nom_produit, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('prefixe','Prefixe devis du produit') !!}</span></td>
	  			<td><span class="info">{!! Form::text('prefix_produit',$detail->prefix_produit, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('suffixe','Suffixe devis du produit') !!}</span></td>
	  			<td><span class="info">{!! Form::input('number','suffix_produit',$detail->suffix_produit, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('version','Version du produit') !!}</span></td>
	  			<td><span class="info">{!! Form::text('vers_produit',$detail->vers_produit, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('description','Description du produit') !!}</span></td>
	  			<td><span class="info">{!! Form::text('desc_produit',$detail->desc_produit, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		
	</table>
					
	

	{!! Form::close() !!}
	@include('errors.list')
@stop
