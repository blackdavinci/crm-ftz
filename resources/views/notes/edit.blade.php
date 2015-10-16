@extends('default')

@section('title','Notes')
@section('titre-entete','Notes')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
{!! Form::open(['method'=>'put','route' =>['changer.note',$note,$back]])!!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
		
			<a class="btn btn-default btn-smenu-position" href="{{ route('afficher.note',[$note->id,$back])}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
			</a>
		  	<div class="form-group ">
		  		
				{!! Form::submit('Enregistrer les modifications',['class' =>'btn btn-danger btn-smenu-position dropdown-toggle']) !!}
			</div>
		</div>	
	</div>
@stop

@section('content')

 	<div class="form-group">
		{!! Form::label('nom','Titre de la note')!!}
	  	{!! Form::text('nom',$note->nom,['class' =>'form-control']) !!}


<?php  $categ= 	array('A faire','Appel téléphonique','E-mail','Réunion','Autre');?>
@foreach($categ as $cle=>$values)
	  	{{--*/ $cat[$values]= $values /*--}}
	  	@endforeach
	  	{!! Form::label('categorie','Etiquette')!!}
	  	{!! Form::select('categorie',$cat,[$note->categorie],['class' =>'form-control input-sm']) !!}
		
{{--*/$typen= 	array('Prospect','Client','Prospect à revoir','Refus')/*--}}
@foreach($typen as $cle=>$values)
	  	{{--*/ $typenote[$values]= $values /*--}}
	  	@endforeach
	  	{!! Form::label('type','Categorie')!!}
	  	{!! Form::select('type',$typenote,[$note->type],['class' =>'form-control input-sm']) !!}		
		
{{--*/$dest= 	array('Moi','User1','User2')/*--}}
@foreach($dest as $cle=>$values)
	  	{{--*/ $destina[$values]= $values /*--}}
	  	@endforeach
		{!! Form::label('destination','Attribué à')!!}
	  	{!! Form::select('destination',$destina,[$note->id_user_destination],['class' =>'form-control input-sm']) !!}
		

		{!! Form::label('echeance','Echeance')!!}
	  	{!! Form::input('date', 'echeance',$note->echeance,['class' =>'form-control input-sm']) !!} 


			{!! Form::label('designation','Description')!!}
	  		{!! Form::textarea('designation',$note->designation,['class' =>'form-control input-sm']) !!}


   </div> 



{!! Form::close() !!}

@stop
