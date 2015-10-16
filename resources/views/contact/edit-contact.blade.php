@extends('default')


@section('title','Modification')
@section('titre-entete','Modification du contact de la société '.$contact->nom_contact.' '.$contact->prenoms_contact)

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	{!! Form::open(['method' =>'PUT','route' =>['contact.update',$contact->id]]) !!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('contact.show',[$contact->id])}}" role="button">
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
	
	<table class=" table-noborder-top  table-contact table">
			<tr><td><span class="head-title">Données sociétés</td></tr>
			<tr>
				<td><span class="title-contact">{!! Form::label('genre','Titre')!!}</td>
				<td>
					{!! Form::select('genre_contact',['Monsieur'=>'Monsieur','Madame'=>'Madame'],$contact->genre_contact, ['class' =>'form-control input-sm']) !!}
				</td>
			</tr>
			<tr> 	
	  			<td><span class="title-contact">{!! Form::label('nom','Nom du contact')!!}</td>
	  			<td><span >{!! Form::text('nom_contact',$contact->nom_contact,['class'=>'form-control input-sm']) !!}</td>
	  			<td><span >{!! Form::text('prenoms_contact',$contact->prenoms_contact,['class'=>'form-control input-sm']) !!}</td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">{!! Form::label('fonction','Fonction') !!}</td>
	  			<td>{!! Form::text('fonction_contact',$contact->fonction_contact,['class'=>'form-control input-sm']) !!}</td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">{!! Form::label('service','Service') !!}</td>
	  			<td>{!! Form::text('service_contact',$contact->service_contact,['class'=>'form-control input-sm']) !!}</td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">{!! Form::label('telephone','Téléphone') !!}</td>
	  			<td>{!! Form::input('tel','tel_contact',$contact->tel_contact,['class'=>'form-control input-sm']) !!}</td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">{!! Form::label('email','E-mail') !!}</td>
	  			<td>{!! Form::input('email','email_contact',$contact->email_contact,['class'=>'form-control input-sm']) !!} </td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">{!! Form::label('adresse','Adresse') !!}</td>
	  			<td>{!! Form::input('textarea','adresse_contact',$contact->adresse_contact,['class'=>'form-control input-sm']) !!}</td>
	  		</tr>
	</table>
	{!! Form::close() !!}
	<!-- Affichage des notes récentes pour le contact -->
	<table class=" table table-noborder-top  table-contact">
		<tr><td><span class="head-title">Note(s) récente(s)</span></td></tr>
	
	  		@if($i==0)<tr> {{--*/ $i = 3/*--}}@endif
	  		  {{--*/ $i-=1 /*--}}
	  		  	<td style="padding-left:35px;">
	  		  		    <a href="{{action('ContactController@show',[$contact->id])}}"><p class="media-heading">{{ $contact->nom_contact.' '.$contact->prenoms_contact}}</p></a>
	  		  		    <p>
	  		  		    	@if($contact->fonction_contact){{ $contact->fonction_contact }} @endif 
	  		  		    	@if($contact->service_contact){{'('.$contact->service_contact.')' }} @endif
	  		  		    </p>
	  		  		    <p>@if($contact->tel_contact) {{ 'Tél : '.$contact->tel_contact }}@endif </p>
	  		  		    <p>@if($contact->email_contact){{ 'E-mail : '.$contact->email_contact }} @endif</p>
	  		  	</td>
	
	  		@if($i==0)</tr> @endif
	
	</table>
	@include('errors.list')
@stop

	