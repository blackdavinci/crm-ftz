@extends('default')


@section('title','Contact')

@section('titre-entete')

	<div class="pull-left" style="margin:-6px 4px 4px 4px;">
		@if($contact->societe)
			<a class="btn btn-danger btn-smenu-position" href="{{ route('societe.show',[$contact->societe_id])}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 
			</a>
		@endif
		@if($contact->societe){{ 'Contact Société '.$contact->societe->nom_clt.' : ' }} @endif {{ $contact->nom_contact.' '.$contact->prenoms_contact}}
	</div>


@stop

@include('default.top-nav')
@include('default.left-nav')


@section('menu')
{{--*/ $back = 3 /*--}}
	<div class="masthead">
		<div class="inner">
		  <nav>
			<ul class="nav masthead-nav">
			  <li class="active"><a href="#">Informations</a></li>
			  <li class=""><a href="{{ route('liste.note',[$contact->id,$back])}}">Notes</a></li>
			  <li><a href="#">Fichiers</a></li>
			  <li><a href="#">Historique</a></li>
			</ul>
		  </nav>
		</div>
		<div class="pull-right" style="margin:4px;">
				
			<!-- Button de creation de notes -->
			<a class="btn btn-primary btn-smenu-position" href="{{route('creer.note',[$contact->id])}}" role="button">
				<span class="glyphicon glyphicon-copy" aria-hidden="true"></span> Creer une Note
			</a>

		    <a class="btn btn-warning btn-smenu-position" href="{{ route('contact.edit',[$contact->id])}}" role="button">
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
			        <h4 class="modal-title" id="myModalLabel">Suppression du contact</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer le contact <strong>{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('contact.destroy',[$contact->id]), 'method'=>'delete']) !!}
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
	<table class=" table-noborder-top  table-contact table">
			<tr><td><span class="head-title">Données contact</span></td></tr>
			<tr> 
	  			<td><span class="title-contact">Titre</span></td>
	  			<td><span class="info">{{ $contact->genre_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">Nom du contact</span></td>
	  			<td><span class="info">{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">Fonction</span></td>
	  			<td><span class="info">{{ $contact->fonction_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">Service</span></td>
	  			<td><span class="info">{{ $contact->service_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">Téléphone</span></td>
	  			<td><span class="info">{{ $contact->tel_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">E-mail</span></td>
	  			<td><span class="info">{{ $contact->email_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">Adresse contact</span></td>
	  			<td><span class="info">{{ $contact->adresse_contact }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-contact">Descripton contact</span></td>
	  			<td><span class="info">{{ $contact->description_contact }}</span></td>
	  		</tr>
	</table>
					
	<!-- Affichage des notes récentes pour le contact -->
	<table class=" table table-noborder-top  table-contact">
		<tr><td><span class="head-title">Note(s) Récente(s)</span></td></tr>
	@foreach($ListNote as $notes)
			
			<!-- Debut gestion des label de categorie des notes -->
			 @if ($notes->categorie=='A faire')
                {{--*/ $cat='info'; /*--}}
            @elseif ($notes->categorie=='Appel téléphonique') 
                {{--*/ $cat='primary'; /*--}}
            @elseif ($notes->categorie=='E-mail') 
                {{--*/ $cat='warning'; /*--}} 
            @elseif ($notes->categorie=='Réunion') 
                {{--*/ $cat='success'; /*--}} 
            @else
                {{--*/ $cat='default'; /*--}}      
            @endif
			<!-- Fin gestion des label de categorie des notes -->


	  		@if($i==0)<tr> {{--*/ $i = 3/*--}}@endif
	  		  {{--*/ $i-=1; $back = 0; /*--}}
	  		  	<td style="padding-left:35px;">
	  		  		    <a href="{{route('afficher.note',[$notes->id,$back])}}">
	  		  		    	<p class="media-heading">{{ $notes->nom}}</p>
	  		  		    </a>
	  		  		    <p>
	  		  		        <a href="{{route('afficher.note',[$notes->id,$back])}}">{!!'<span class="label label-'.$cat.'">' !!}{!!$notes->categorie!!}</span></a>

	  		  		    </p>
	  		  		    <p>
	  		  		    {{--*/ $date = new DateTime($notes->echeance); /*--}}
                        ({{ $date->format('d-m-Y')}})
	  		  		    </p>

	  		  	</td>
	
	  		@if($i==0)</tr> @endif
	 @endforeach
	</table>
@stop

