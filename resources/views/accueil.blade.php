@extends('default')

@section('title','Accueil')
@section('titre-entete','Accueil')

@include('default.top-nav')
@include('default.left-nav')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading" style="text-align: center"><strong>Bienvenue dans le CRM FTZ </strong></div>
  <div class="panel-body" >
		<p>
			<strong> Bonjour {{ Auth::user()->name.' '.Auth::user()->prenom }}, et bienvenue dans FTZ CRM</strong>
		</p>
		</br>
		<p>
			Nous avons mis en place des taches et modules pour vous aider à automatiser votre Gestion de Relation Client.
			Vous pouvez y acceder à tout moment en cliquant sur le menu à gauche.
		</p>
		<p>
			Nous esperons que cet outil vous aidera à :
				<ul>
					<li> Optimiser la relation avec votre clientèle</li>
					<li>Fideliser vos clients</li>
					<li>Augmenter votre chiffre d'affaire</li>
					<li>...</l>
				</ul>
			
		</p>
				

		<p>
			Voici votre premier conseil: afin de respecter vos échéances, consulter régulierement l'agenda qui mis à votre disposition
		</p>

  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><strong>Activités récentes </strong></div>
  <div class="panel-body" >
  	<table class="table">
  		@foreach($notes as $note)
  			<tr>
  				@if($note->categorie == 'A faire')
  				  <td><h4><span class="label label-info">A faire </span></h4></td>
  				@elseif($note->categorie == 'Appel téléphonique')
  				  <td><h4><span class="label label-primary">Appel téléphonique </span></h4></td>
  				@elseif($note->categorie == 'E-mail')
				  <td><h4><span class="label label-warning">E-mail </span></h4></td>
  				@elseif($note->categorie == 'Réunion')
				  <td><h4><span class="label label-success">Réunion </span></h4></td>
  				@elseif($note->categorie == 'Autre')
				  <td><h4><span class="label label-default">Autre </span></h4></td>
  				@endif 
  				<td><a href="{{$note->id}}/afficher-note/1">{{$note->nom}}</a></td>
  			</tr>
  			
  		@endforeach
  		@foreach($contacts as $contact)
  			<tr>
  				<td><h4><span class="label label-success">Contact </span></h4></td>
  				<td><a href="{{route('contact.show',[$contact->id])}}">{{$contact->nom_contact.' '.$contact->prenoms_contact}}</a></td>
  			</tr>
  			
  		@endforeach
  		@foreach($societes as $societe)
  			<tr>
  				<td><h4><span class="label label-success">Société </span></h4></td>
  				<td><a href="{{route('societe.show',[$societe->id])}}">{{$societe->nom_clt}}</a></td>
  			</tr>
  			
  		@endforeach
  		@foreach($devis as $devis)
  			<tr>
  				<td><h4><span class="label label-success">Devis </span></h4></td>
  				<td><a href="{{route('devis.show',[$devis->id])}}">{{$devis->num_devis}}</a></td>
  			</tr>
  			
  		@endforeach
  	</table>
  
		<p>
			is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
			the industry's standard dummy text ever since the 1500s, when an unknown printer
			
		</p>

  </div>
</div>
@stop