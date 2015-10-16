@extends('default')

@section('head')
	<!-- Bootstrap File Input Script
    ================================================== -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="js/fileinput.min.js" type="text/javascript"></script>
  <!-- bootstrap.js below is only needed if you wish to use the feature of viewing details 
       of text file preview via modal dialog -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- optionally if you need translation for your language then include 
      locale file as mentioned below -->
  <script src="js/fileinput_locale_fr.js"></script>

@stop

@section('title','Contact')
@section('titre-entete','Importer des contacts vers CRM FTZ')

@include('default.top-nav')
@include('default.left-nav')



@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading"><strong>Importer des contacts d’un fichier Excel</strong></div>
  <div class="panel-body" >
	{!! Form::open(['method' =>'PUT','route' =>['import.store']]) !!}
		<div class="form-group"> 
			{!! Form::open(['method' =>'PUT','route' =>['import.store']]) !!}
				<div class="form-group"> 
					{!! Form::label('thefile','Choisir un fichier Excel à partir duquel importer des contacts') !!}
					{!! Form::file('thefile', ['class' => 'field', 'data-show-preview'=> 'false', 'name'=> 'file-fr[]', 'id'=>'file-fr']) !!}
				</div>
			{!! Form::close()!!}
		</div>

		<div class="form-group">
			{!! Form::submit('Importer les contacts',['class' =>'btn btn-success pull-left'])!!}
		</div>
		<a class="btn btn-default" id="grille" href="{{ route('societe.index')}}" title="Grille" role="button" style="margin-left:15px">
			Annuler
		</a>
	{!! Form::close()!!}
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
		       allowedFileExtensions : ['csv', 'xsl','xlsx','xlsm'],
		   });
		 
	});
@stop



