@extends('default')

@section('head')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

	<!-- Datepicker  CSS -->
    {!! HTML::style('css/bootstrap-datetimepicker.min.css') !!}
    
@stop

@section('title','Notes')
@section('titre-entete','Notes')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
{!! Form::open(['route' =>['notes.store']])!!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-default btn-smenu-position" href="{{ route('contact.show', $id)}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
			</a>
			
		  	<div class="form-group ">
				{!! Form::submit('Ajouter une note',['class' =>'btn btn-danger btn-smenu-position dropdown-toggle']) !!}
			</div>
			
		</div>	
	</div>
@stop

@section('content')



 	<div class="form-group">
		{!! Form::label('nom','Titre de la note')!!}
	  	{!! Form::text('nom',null,['class' =>'form-control', 'placeholder'=>'Titre de la note']) !!}


{{--*/ $cat = ['A faire'=>'A faire', 'Appel téléphonique'=>'Appel téléphonique', 'E-mail'=>'E-mail','Réunion'=>'Réunion','Autre'=>'Autre']/*--}}

	  	{!! Form::label('categorie','Etiquette')!!}
	  	{!! Form::select('categorie',$cat,'A faire',['class' =>'form-control input-sm' ]) !!}
		
	{{--*/$typenote = ['Client'=>'Client','Prospect'=>'Prospect','Prospect à revoir'=>'Prospect à revoir','Refus'=>'Refus'] /*--}}

	{!! Form::label('type','Categorie')!!}
	{!! Form::select('type',$typenote,'Prospect',['class' =>'form-control input-sm']) !!}			
		


		{!! Form::label('destination','Attribué à')!!}
		{!! Form::select('id_user_destination',$users,Auth::user()->id,['class' =>'form-control input-sm','id'=>'user']) !!}
		

		{!! Form::label('echeance','Echeance')!!}
	  	<div class="form-group">
	  	
	  	<div>
			<div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="date" data-link-format="yyyy-mm-dd">
	            <input class="form-control" type="text" name="echeance" readonly>
	            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	        </div>
	    </div>
	</div>


			{!! Form::label('designation','Description')!!}
	  		{!! Form::textarea('designation',null,['class' =>'form-control input-sm', 'placeholder'=>'Description de la note']) !!}


   </div> 

<!-- Envoi de l'id du contact en champ caché -->
		{!! Form::input('hidden','contact_id_create',$id) !!}


{!! Form::close() !!}

@stop

@section('footer')

    <!-- Datepicker Script -->
	
	<script src="{{ $WEBROOT }}js/bootstrap-datetimepicker.min.js"></script>
	<script src="{{ $WEBROOT }}js/bootstrap-datetimepicker.fr.js"></script>

@stop

@section('script')

$(document).ready(function(){
	 $('#destinataire').select2({ placeholder: "Choisissez le destinataire de la note (contact)" });

	  $('#user').select2({ placeholder: "Choisissez l\'exécuteur" });

	  $('.form_date').datetimepicker({
	          language:  'fr',
	          weekStart: 1,
	          todayBtn:  1,
	  		autoclose: 1,
	  		todayHighlight: 1,
	  		startView: 2,
	  		minView: 2,
	  		forceParse: 0
	      });

	  $("#input-fr").fileinput({
	      language: "fr",
	      uploadUrl: "/file-upload-batch/2",
	      allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
	  });
	
});


@stop