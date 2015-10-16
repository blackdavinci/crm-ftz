@extends('default')


@section('title','Modification du module')
@section('titre-entete','Modification des informations du module '.$detail->nom_module)

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	{!! Form::open(['method' =>'PUT','route' =>['module.update',$detail->id]]) !!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('module.show',[$detail->id])}}" role="button">
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
			<tr><td><span class="head-title">Détail du module</span></td></tr>
			<tr> 
	  			<td><span class="title-profil">{!! Form::label('nom','Nom du module') !!}</span></td>
	  			<td><span class="info">{!! Form::text('nom_module',$detail->nom_module, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('version','Version du module') !!}</span></td>
	  			<td><span class="info">{!! Form::text('vers_module',$detail->vers_module, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
			<tr> 
	  			<td><span class="title-profil">{!! Form::label('description','Description du module') !!}</span></td>
	  			<td><span class="info">{!! Form::text('desc_module',$detail->desc_module, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('prix','Prix du module') !!}</span></td>
	  			<td><span class="info">{!! Form::text('prix_module',$detail->prix_module, ['class' =>'form-control ']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('type','Type de module') !!}</span></td>
	  			<td><span class="info">{!! Form::select('type_module',['Simple'=>'Simple module','Base'=>'Module de base','Additionnel'=>'Module additionnel'],$detail->type_module,['class' =>'form-control input-sm']) !!}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">{!! Form::label('produit_id','Produit(s) lié(s)') !!}</span></td>
		  		<td><span class="info">{!! Form::select('produit_id[]',$produits,$produits_list,['class' =>'form-control input-sm ', 'id'=>'produit_list','multiple'=>true]) !!}</span></td>
	  		</tr>
	</table>
	{!! Form::close() !!}
	
	@include('errors.list')		
@stop
