@extends('default')

@section('title','Notes')
@section('titre-entete','Notes')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
{!! Form::open(['route' =>['notes.store']])!!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('contact.show')}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
			</a>
			
		  	<div class="form-group ">
				{!! Form::submit('Ajouter une note',['class' =>'btn btn-danger btn-smenu-position dropdown-toggle']) !!}
			</div>
			
		</div>	
	</div>
@stop

@section('content')



 	<div class="form-group">
		{!! Form::label('nom','Titre de la note')!!}
	  	{!! Form::text('nom',null,['class' =>'form-control', 'placeholder'=>'Titre de la note']) !!}


<?php  $categ= 	array('A faire','Appel téléphonique','E-mail','Réunion','Autre');?>
@foreach($categ as $cle=>$values)
	  	{{--*/ $cat[$values]= $values /*--}}
	  	@endforeach
	  	{!! Form::label('categorie','Etiquette')!!}
	  	{!! Form::select('categorie',$cat,null,['class' =>'form-control input-sm' ]) !!}
		
{{--*/$typen= 	array('Prospect','Client','Prospect à revoir','Refus')/*--}}
@foreach($typen as $cle=>$values)
	  	{{--*/ $typenote[$values]= $values /*--}}
	  	@endforeach
	  	{!! Form::label('type','Categorie')!!}
	  	{!! Form::select('type',$typenote,null,['class' =>'form-control input-sm']) !!}		
		
{{--*/$dest= 	array('Moi','User1','User2')/*--}}
@foreach($dest as $cle=>$values)
	  	{{--*/ $destina[$values]= $values /*--}}
	  	@endforeach
		{!! Form::label('contact','Pour le contact')!!}
	  	{!! Form::select('contact_id',$contacts,null,['class' =>'form-control input-sm','id'=>'destinataire']) !!}
		
			{!! Form::label('destination','Attribué à')!!}
		  	{!! Form::select('id_user_destination',$users,Auth::user()->id,['class' =>'form-control input-sm','id'=>'user']) !!}
			{!! Form::hidden('user_id',Auth::user()->id)!!}

		{!! Form::label('echeance','Echeance')!!}
	  	{!! Form::input('date', 'echeance',null,['class' =>'form-control input-sm']) !!} 


			{!! Form::label('designation','Description')!!}
	  		{!! Form::textarea('designation',null,['class' =>'form-control input-sm', 'placeholder'=>'Description de la note']) !!}


   </div> 

<!-- Envoi de l'id du contact en champ caché -->
	
	{!! Form::hidden('id_user_redacteur',Auth::user()->id) !!}
	
{!! Form::close() !!}


@stop

@section('script')

$(document).ready(function(){
	 $('#destinataire').select2({ placeholder: "Choisissez le destinataire de la note (contact)" });

	  $('#user').select2({ placeholder: "Choisissez l\'exécuteur" });
	
});


@stop