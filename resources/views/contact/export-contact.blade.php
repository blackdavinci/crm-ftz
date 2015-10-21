@extends('default')

{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

@section('title','Contact')
@section('titre-entete','Exporter des contacts du CRM FTZ')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
<div id="navbar-action" class="navbar-collapse collapse navbar-left" style="margin:4px">
	<a class="btn btn-danger btn-smenu-position ajout" id="grille" href="{{ route('societe.index')}}" title="Grille" role="button">
		<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
	</a>
	
</div>
@stop 

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading"><strong>Vous pouvez exporter vos contacts aux formats ci-dessous...</strong></div>
  <div class="panel-body" >
	{!! Form::open(['route' =>'export.store', 'method'=>'POST']) !!}

  	<div class="col-md-12 import-export"> 
  		<a href="{{ route('export.create')}}" class="pull-left"  >
  			<img src="{{ $WEBROOT }}/img/icon-csv.png">
  		</a>
  		<a href="#selection" data-toggle="collapse" aria-expanded="false" aria-controls="selection">
  			<strong>Exporter les contacts vers un fichier CSV, PDF, XLS</strong>
  		</a>
  		<p class="detail-link">L’exportation vers un fichier CSV peut être utilisée dans presque toutes les bases de données et feuilles de calcul.</p>
  		<!-- Choix des données à Exporter -->
  		<div class="col-md-12 collapse" id="selection" >
	  		<div class="well">
	  			<div class="checkbox">
	  			  <label>{!! Form::checkbox('nom_clt', 'nom_clt', null) !!} Nom</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('effectif_clt', 'effectif_clt', null) !!} Effectif</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('ca_clt', 'ca_clt', null) !!} Chiffre d'affaire</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('num_tva_clt', 'num_tva_clt', null) !!} N° TVA</label>
	  			</div>
	  			<div class="checkbox">
	  			  <label>{!! Form::checkbox('url_clt', 'url_clt', null) !!} URL</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('tel_siege_clt', 'tel_siege_clt', null) !!} Téléphone</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('fax_siege_clt', 'fax_siege_clt', null) !!} Fax</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('email_siege_clt', 'email_siege_clt', null) !!} E-mail</label>
	  			</div>
	  			<div class="checkbox">
	  			  <label>{!! Form::checkbox('pays_clt', 'pays_clt', null) !!} Pays</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('ville_siege_clt', 'ville_siege_clt', null) !!} Ville</label>
	  			</div>
				<div class="checkbox">
	  			  <label>{!! Form::checkbox('adresse_siege_clt', 'adresse_siege_clt', null) !!} Adresse</label>
	  			</div>
				<!-- Choix du type de données -->
				<div class="form-group">
					{!! Form::label('type_export','Type de données') !!}
					{!! Form::select('type_export',['csv'=>'CSV','xls'=>'XLS','xlsx'=>'XLSX','pdf'=>'PDF'],'xlsx', ['class' =>'form-control input-sm']) !!}
				</div>

	  			<!-- Boutton d'import de données et d'annulation -->
	  			<div class="form-group pull-left">
	  				{!! Form::submit('Exporter les données',['class' =>'btn btn-success '])!!}
	  			</div>
	  			<a class="btn btn-warning"  href="{{ route('export.create')}}" role="button" style="margin-left:15px">
	  				Exporter toutes les données
	  			</a>	
	  			<a class="btn btn-default"  href="{{ route('societe.index')}}" role="button" style="margin-left:15px">
	  				Annuler
	  			</a>		
	  		</div>		
  		</div>
  	</div>
  	
	<div class="col-md-12 import-export"> 
		<a href="" class="pull-left"  >
			<img src="{{ $WEBROOT }}/img/icon-outlook.png">
		</a>
		<a href=""><strong>Exporter les contacts vers la messagerie</strong></a>
		<p class="detail-link">Exporter les contacts dans votre messagerie</p>
	</div>
		{!! Form::close() !!}
  </div>
</div>

@stop




