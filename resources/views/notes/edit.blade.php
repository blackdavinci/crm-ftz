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
{!! Form::open(['method'=>'put','route' =>['changer.note',$note,$back]])!!}

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >
		
			<a class="btn btn-default btn-smenu-position" href="{{ route('afficher.note',[$note->id,$back])}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
			</a>
		  	<div class="form-group ">
		  		
				{!! Form::submit('Enregistrer les modifications',['class' =>'btn btn-danger btn-smenu-position dropdown-toggle']) !!}
			</div>
		</div>	
	</div>
@stop

@section('content')

 	<div class="form-group">
		{!! Form::label('nom','Titre de la note')!!}
	  	{!! Form::text('nom',$note->nom,['class' =>'form-control']) !!}


<?php  $categ= 	array('A faire','Appel téléphonique','E-mail','Réunion','Autre');?>
@foreach($categ as $cle=>$values)
	  	{{--*/ $cat[$values]= $values /*--}}
	  	@endforeach
	  	{!! Form::label('categorie','Etiquette')!!}
	  	{!! Form::select('categorie',$cat,[$note->categorie],['class' =>'form-control input-sm']) !!}
		
{{--*/$typen= 	array('Prospect','Client','Prospect à revoir','Refus')/*--}}
@foreach($typen as $cle=>$values)
	  	{{--*/ $typenote[$values]= $values /*--}}
	  	@endforeach
	  	{!! Form::label('type','Categorie')!!}
	  	{!! Form::select('type',$typenote,[$note->type],['class' =>'form-control input-sm']) !!}		
		
		{!! Form::label('contact','Pour le contact')!!}
	  	{!! Form::select('contact_id',$contacts,$note->contact_id,['class' =>'form-control input-sm','id'=>'destinataire']) !!}

	  	{!! Form::label('destination','Attribué à')!!}
		{!! Form::select('id_user_destination',$users,$note->user_id,['class' =>'form-control input-sm','id'=>'user']) !!}
		

		{!! Form::label('echeance','Echeance')!!}
	  <div class="form-group">
	  	<div >
			<div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="date" data-link-format="yyyy-mm-dd">
	            <input class="form-control" type="text" name="echeance"  value="{{$note->echeance}}" readonly>
	            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	        </div>
	    </div>
	</div>


			{!! Form::label('designation','Description')!!}
	  		{!! Form::textarea('designation',$note->designation,['class' =>'form-control input-sm']) !!}


   </div> 



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