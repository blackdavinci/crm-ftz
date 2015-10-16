@extends('default')

@section('head')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}   
@stop

@include('default.top-nav')
@section('head')
	<!-- Bootstrap File Input Script
    ================================================== --> 
  <!-- optionally if you need translation for your language then include 
      locale file as mentioned below -->
  <script src="js/fileinput_locale_fr.js"></script>
@stop

@section('title','Contact')
@section('titre-entete','Importer des contacts vers CRM FTZ')


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
  <div class="panel-heading"><strong>Importation de données de sources différentes</strong></div>
  <div class="panel-body" >

  <!-- Importation de données à partir de Gmail Contact -->
	<div class="col-md-12 import-export"> 
		<a href="{{ route('import.google') }}" class="pull-left"  >
			<img src="{{ $WEBROOT }}/img/icon-gmail.png">
		</a>
		<a href=" {{ route('import.google') }}"><strong>Importer des contacts de Gmail</strong></a>
		<p class="detail-link">Choisissez certains contacts à importer de votre carnet d’adresses Gmail dans Google Apps.</p>
	</div>

	<!-- Importation des données sous format CSV - EXCEL -->
	<div class="col-md-12 import-export"> 
		<a href="" class="pull-left"  >
			<img src="{{ $WEBROOT }}/img/icon-csv.png">
		</a>
		<a href="#importation" data-toggle="collapse" aria-expanded="false" aria-controls="importation" >
			<strong>Importer des contacts d'un fichier CSV ou EXCEL</strong>
		</a>
		<p class="detail-link">L’exportation vers un fichier au format CSV (valeurs séparées par des virgules) est disponible à partir de presque toutes les bases de données et feuilles de calcul</p>
		
		<!-- Choix des données à Importer -->
  		<div class="col-md-12 collapse" id="importation" >
	  		<div class="well">
				{!! Form::open(['route' =>'import.store', 'method'=>'POST', 'files' => true]) !!}
					<div class="form-group"> 
							<div class="form-group"> 
								{!! Form::label('thefile','Choisir un fichier Excel à partir duquel importer des contacts') !!}
								{!! Form::file('thefile', ['class' => 'field', 'data-show-preview'=> 'false', 'name'=> 'contact', 'id'=>'file-fr']) !!}
							</div>
					</div>
	  			<!-- Boutton d'import de données et d'annulation -->
	  			<div class="form-group">
						{!! Form::submit('Importer les contacts',['class' =>'btn btn-success pull-left'])!!}
					</div>
	  			<a class="btn btn-default"  href="{{ route('societe.index')}}" role="button" style="margin-left:15px">
	  				Annuler
	  			</a>		
	  		</div>	
	  		{!! Form::close()!!}	
  		</div>
	</div>
	<!-- Autre Improtation  -->
	<div class="col-md-12 import-export"> 
		<a href="" class="pull-left"  >
			<img src="{{ $WEBROOT }}/img/icon-outlook.png">
		</a>
		<a href=""><strong>Importer des contacts d’Outlook</strong></a>
		<p class="detail-link">Vous pouvez importer vos contacts depuis Outlook 2003, 2007, 2010 et Outlook Express.</p>
	</div>
	
  </div>
</div>

@stop

@section('script')
 jQuery(function($){
		// initialize with defaults
		$("#input-id").fileinput();
		 
		// with plugin options
		$("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});

		$('#file-fr').fileinput({
		       language: 'fr',
		       uploadUrl: '#',
		       allowedFileExtensions : ['csv', 'xls','xlsx','xlsm'],
		   });
		 
	});
@stop


