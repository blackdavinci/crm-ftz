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
		<p>
			is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
			the industry's standard dummy text ever since the 1500s, when an unknown printer
			
		</p>

  </div>
</div>
@stop