@extends('default')

@section('title','Nouveau contact')
@section('titre-entete','Nouveau contact')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	{!! Form::open(['url' => route('contact.store'), 'method'=>'POST']) !!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('societe.index')}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
			</a>
			<div class="form-group">
				  {!! Form::submit('Enregistrer + Ajouter un autre',[
				  	'name'=>'add_again', 
				  	'class' =>'btn btn-warning btn-smenu-position'
				  	])
				  !!}
			</div>
		  	<div class="form-group ">
				{!! Form::submit('Enregistrer',['class' =>'btn btn-success btn-smenu-position dropdown-toggle']) !!}
			</div>
		</div>	
	</div>
@stop

@section('content')
	<br>
	<h4>Ajout d'un contact simple</h4>
	<hr>
	
		<div class="row">

			<!-- Information de base du contact -->
			<div class="col-md-4">
				<header class="head-title">
					<h4>Information personnelle</h4>
					<div class="trait pull-left"></div>
				</header>
				<div class="form-group">
				    <div class="col-sm-12">
					    {!! Form::label('nom','Nom') !!}
						{!! Form::text('nom_contact',null, ['class' =>'form-control input-sm',  'placeholder'=>'Nom du contact']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('prenom','Prénom(s)') !!}
						{!! Form::text('prenoms_contact',null, ['class' =>'form-control input-sm', 'placeholder' =>'Prénom(s) du contact']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('genre','Genre') !!}
						{!! Form::select('genre_contact',['Monsieur'=>'Monsieur','Madame'=>'Madame'],null, ['class' =>'form-control input-sm']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('fonction','Fonction') !!}
						{!! Form::text('fonction_contact',null, ['class' =>'form-control input-sm', 'placeholder' =>'Fonction du contact']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('service','Service') !!}
						{!! Form::text('service_contact',null, ['class' =>'form-control input-sm', 'placeholder' =>'Service du contact']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('description','Description') !!}
						{!! Form::text('description_contact',null, ['class' =>'form-control input-sm', 'placeholder' =>'Description du contact']) !!}
					</div>
				</div>
					
			</div>

			<!-- information Troisième Adresse-->
			<div class="col-md-4">
				<header class="head-title">
					<h4>Contact(s)</h4>
					<div class="trait pull-left"></div>
				</header>
				<div class="trait-box">
					<div class="form-group">
					    <div class="col-sm-12">
							{!! Form::label('tel','Téléphone') !!}
							{!! Form::input('tel','tel_contact',null, ['class' =>'form-control input-sm', 'placeholder' =>'Numéro de téléphone de la société']) !!}
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-12">
							{!! Form::label('email','E-mail') !!}
							{!! Form::input('email','email_contact',null, ['class' =>'form-control input-sm', 'placeholder' =>'Adresse e-mail']) !!}
						</div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						<p></p>
					</div>
				</div>
			</div>

			<!-- Addresse de la société -->
			<div class="col-md-4">
				<header class="head-title">
					<h4>Adresse</h4>
					<div class="trait pull-left"></div>
				</header>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('adresse','Adresse') !!}
						{!! Form::textarea('adresse_contact',null, ['class' =>'form-control input-sm', 'placeholder'=>'Adresse complète de la société','rows' => '7']) !!}
					</div>
				</div>

	  		</div>
		</div>
	{!! Form::close() !!}

	@include('errors.list')
@stop
