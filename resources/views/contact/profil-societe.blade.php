@extends('default')


@section('title','Contact')
@section('titre-entete','Profil Société '.$profil->nom_clt)

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
{{--*/ $back = 4 /*--}}
	<div class="masthead">
		<div class="inner">
		  <nav>
			<ul class="nav masthead-nav">
			  <li class="active"><a href="#">Informations</a></li>
			  <li><a href="{{ route('societe.note',[$profil->id,$back])}}">Notes</a></li>
			  <li><a href="#">Fichiers</a></li>
			  <li><a href="#">Historique</a></li>
			</ul>
		  </nav>
		</div>
		<div class="pull-right" style="margin:4px;">
		    <a class="btn btn-primary btn-smenu-position" href="{{ route('creer.contact',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Ajout contact
			</a>
		    <a class="btn btn-warning btn-smenu-position" href="{{ route('societe.edit',[$profil->id])}}" role="button">
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
			        Voulez-vous vraimment supprimer la société <strong>{{ $profil->nom_clt }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('societe.destroy',[$profil->id]), 'method'=>'delete']) !!}
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
			<tr><td><span class="head-title">Données sociétés</span></td></tr>
			<tr> 
	  			<td><span class="title-profil">Nom de la société</span></td>
	  			<td><span class="info">{{ $profil->nom_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Référence de la société</span></td>
	  			<td><span class="info">{{ $profil->ref_client }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Groupe CRM</span></td>
	  			<td>
	  				@if(isset($profil->groupe->nom_groupe))
	  					<span class="info">{{ $profil->groupe->nom_groupe.' '.$profil->groupe->date_groupe }}</span>
	  				@else 
	  					<span class="info">Non Assignée </span>
	  				@endif
	  			</td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Effectif</span></td>
	  			<td><span class="info">{{ $profil->effectif_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Chiffre d'affaire</span></td>
	  			<td><span class="info">{{ $profil->ca_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Commentaire</span></td>
	  			<td><span class="info">{{ $profil->comment_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">N° TVA</span></td>
	  			<td><span class="info">{{ $profil->num_tva_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Téléphone</span></td>
	  			<td><span class="info">{{ $profil->tel_siege_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">E-mail</span></td>
	  			<td><span class="info">{{ $profil->email_siege_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">URL</span></td>
	  			<td><span class="info"><a href="{{ $profil->url_clt }}">{{ $profil->url_clt }}</a></span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Fax</span></td>
	  			<td><span class="info">{{ $profil->fax_siege_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Pays</span></td>
	  			<td>
	  				<span class="info">
	  					{{ $profil->pays_clt }} 
	  					@if($profil->ville_siege_clt) {{'('.$profil->ville_siege_clt.')' }} @endif
	  				</span>
	  			</td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Cpde postal</span></td>
	  			<td><span class="info">{{ $profil->bp_clt }}</span></td>
	  		</tr>
	  		<tr> 
	  			<td><span class="title-profil">Adresse</span></td>
	  			<td><span class="info">{{ $profil->adresse_siege_clt }}</span></td>
	  		</tr>
	</table>
					
	<!-- Affichage Contact(s) lié(s) à la société -->
	@unless($ListContact->isEmpty())
		<table class=" table table-noborder-top  table-contact">
			<tr><td><span class="head-title">Contact(s)</span></td></tr>
		@foreach($ListContact as $contact)
		  		@if($i==0)<tr> {{--*/ $i = 3/*--}}@endif
		  		  {{--*/ $i-=1 /*--}}
		  		  	<td style="padding-left:35px;">
		  		  		    <a href="{{route('contact.show',[$contact->id])}}"><p class="media-heading">{{ $contact->nom_contact.' '.$contact->prenoms_contact}}</p></a>
		  		  		    <p>
		  		  		    	@if($contact->fonction_contact){{ $contact->fonction_contact }} @endif 
		  		  		    	@if($contact->service_contact){{'('.$contact->service_contact.')' }} @endif
		  		  		    </p>
		  		  		    <p>@if($contact->tel_contact) {{ 'Tél : '.$contact->tel_contact }}@endif </p>
		  		  		    <p>@if($contact->email_contact){{ 'E-mail : '.$contact->email_contact }} @endif</p>
		  		  	</td>
		
		  		@if($i==0)</tr> @endif
		 @endforeach
		</table>
	@endunless
@stop
