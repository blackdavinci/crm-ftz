@extends('default')

@section('title','Contact')
@section('titre-entete','Nouvelle société')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	{!! Form::open(['url' => route('societe.store'), 'method'=>'POST']) !!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('societe.index')}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
			</a>
			<div class="form-group">
				  {!! Form::submit('Enregistrer + Nouveau contact',[
				  	'name' => 'add_contact',
				  	'class' =>'btn btn-warning btn-smenu-position',
				  	])
				  !!}
			</div>
		  	<div class="form-group ">
				{!! Form::submit('Enregistrer',['class' =>'btn btn-success btn-smenu-position']) !!}
			</div>
		</div>	
	</div>
@stop

@section('content')
	<br>
	<h4>Nouvelle Société</h4>
	<hr>
	
		<div class="row">

			<!-- Information de base sur la société -->
			<div class="col-md-4">
				<header class="head-title">
					<h4>Information de base</h4>
					<div class="trait pull-left"></div>
				</header>
				<div class="form-group">
				    <div class="col-sm-12">
					    {!! Form::label('societe','Société') !!}
						{!! Form::text('nom_clt',null, ['class' =>'form-control input-sm', 'id'=>'check', 'placeholder'=>'Nom de la société']) !!}
						<div id="feedback"></div>
					</div>
				</div>
				<!-- Information Seconde Chiffre -->
				<div class="form-group">
				    <div class="col-sm-12">
					    {!! Form::label('effectif','Effectif') !!}
					  	{!! Form::input('number','effectif_clt',null, ['class' =>'form-control input-sm', 'placeholder'=>'Effectif de la société']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
					    {!! Form::label('ca','Chiffre d\'affaire') !!}
					    {!! Form::input('number','ca_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'Chiffre d\'affaire de la société']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('ntva','N°TVA') !!}
						{!! Form::input('number','num_tva_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'Numéro TVA de la société']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('comment','Commentaire') !!}
						{!! Form::text('comment_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'A propos de la société']) !!}
					</div>
				</div>
					
			</div>

			<!-- information Troisième Adresse-->
			<div class="col-md-4">
				<header class="head-title">
					<h4>Contact(s)</h4>
					<div class="trait pull-left"></div>
				</header>
				<div class="form-group">
					<div class="col-sm-12">
						{!! Form::label('groupecrm','Groupe CRM') !!}
						{!! Form::select('groupe_id',$groupe,null,['class' =>'form-control input-sm']) !!}
					</div>
				</div>
					<div class="form-group">
					    <div class="col-sm-12">
							{!! Form::label('tel','Téléphone') !!}
							{!! Form::input('tel','tel_siege_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'Numéro de téléphone de la société']) !!}
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-12">
						    {!! Form::label('fax','Fax') !!}
						    {!! Form::text('fax_siege_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'Numéro du fax de la société']) !!}
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-12">
							{!! Form::label('email','E-mail') !!}
							{!! Form::input('email','email_siege_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'Adresse e-mail']) !!}
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-12">
							{!! Form::label('url','URL') !!}
							{!! Form::input('url','url_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'Adresse web de la société']) !!}
						</div>
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
					<h4>Adresses</h4>
					<div class="trait pull-left"></div>
				</header>
				<div class="form-group">
				    <div class="col-sm-12">
				    	<!-- Récupération du nom de tous les pays -->
				    	{{--*/ $listpays = Countries::getList('fr','php','cldr') /*--}} 
						@foreach($listpays as $cle=>$values)
							{{--*/ $pays[$values]= $values /*--}}
						@endforeach
						{!! Form::label('pays','Pays') !!}
						{!! Form::select('pays_clt',$pays,'Maroc',['class' =>'form-control input-sm']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('ville','Ville') !!}
						{!! Form::text('ville_siege_clt',null, ['class' =>'form-control input-sm', 'placeholder' =>'']) !!}
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-12">
						{!! Form::label('adresse','Adresse') !!}
						{!! Form::textarea('adresse_siege_clt',null, ['class' =>'form-control input-sm', 'placeholder'=>'Adresse complète de la société','rows' => '7']) !!}
					</div>
				</div>

	  		</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::close() !!}

	@include('errors.list')
@stop


