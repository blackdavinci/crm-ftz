@section('head')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

	<!-- Datepicker  CSS -->
    {!! HTML::style('css/bootstrap-datetimepicker.min.css') !!}
    
@stop

{!! Form::open(['route' =>['users.update',$profil->id], 'method'=>'PUT', 'class'=>'form-horizontal','files' => true]) !!}

<div class="row">

	@include('errors.list')

	<div class="form-group">
		<label class="col-sm-3 control-label">{!! Form::label('photo','Photo de profil') !!}</label>
		<div class="col-md-8">
			<input type="file" id="exampleInputFile" name="photo">
			<!-- <input id="input-fr" type="file"  name="photo" class="file-loading" data-show-preview="false"> -->
		</div>
	</div>
	

	<div class="form-group">
	  	<label class="col-sm-3 control-label">{!! Form::label('name','Nom') !!}</label>
	  	<div class="col-md-8">
			{!! Form::text('name',$profil->name, ['class' =>'form-control input-sm']) !!}
		</div>
	</div>

	<div class="form-group">
	  	<label class="col-sm-3 control-label">{!! Form::label('naissance','Naissance') !!}</label>
	  	<div class="col-md-8">
			{!! Form::text('naissance',$profil->naissance, ['class' =>'form-control input-sm']) !!}
		</div>
	</div>
	<div class="form-group">
	  	<label class="col-sm-3 control-label">{!! Form::label('prenom','Prénom(s)') !!}</label>
	  	<div class="col-md-8">
			{!! Form::text('prenom',$profil->prenom, ['class' =>'form-control input-sm']) !!}
		</div>
	</div>
	<div class="form-group">
	  	<label class="col-sm-3 control-label">{!! Form::label('username','Nom d\'utilisateur') !!}</label>
	  	<div class="col-md-8">
			{!! Form::text('username',$profil->username, ['class' =>'form-control input-sm']) !!}
		</div>
	</div>

	<div class="form-group">
	  	<label class="col-sm-3 control-label">{!! Form::label('fonction','Fonction') !!}</label>
	  	<div class="col-md-8">
			{!! Form::text('fonction',$profil->fonction, ['class' =>'form-control input-sm']) !!}
		</div>
	</div>
	@if (Auth::user()->role == 'admin')
		<div class="form-group">
		  	<label class="col-sm-3 control-label">{!! Form::label('role','Rôle') !!}</label>
		  	<div class="col-md-8">
				{!! Form::select('role',['admin'=>'Administrateur','simple'=>'Simple Utilisateur'],$profil->role, ['class' =>'form-control input-sm']) !!}
			</div>
		</div>
	@endif
	<div class="form-group">
		<label class="col-sm-3 control-label">{!! Form::label('tel','Téléphone') !!}</label>
		<div class="col-md-8">
			{!! Form::text('tel',$profil->tel, ['class' =>'form-control input-sm']) !!}		
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{!! Form::label('email','E-mail') !!}</label>
		<div class="col-md-8">
			{!! Form::email('email',$profil->email, ['class' =>'form-control input-sm']) !!}	
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">{!! Form::label('adresse','Adresse') !!}</label>
		<div class="col-md-8">
			{!! Form::text('adresse',$profil->adresse, ['class' =>'form-control input-sm']) !!}	
		</div>
	</div>
	@if (Auth::user()->role == 'admin')
		<div class="form-group">
			<label class="col-sm-3 control-label">{!! Form::label('etat','Etat') !!}</label>
			<div class="col-md-8">
				@if($profil->active=="1")
					<label class="radio-inline">
					 	{!!  Form::radio('active', '1', true); !!} Activé
					</label>
					<label class="radio-inline">
					 	 {!!  Form::radio('active', '2'); !!} Désactivé
					</label>
				@else 
					<label class="radio-inline">
					 	{!!  Form::radio('active', '1'); !!} Activé
					</label>
					<label class="radio-inline">
					 	 {!!  Form::radio('active', '2',true); !!} Désactivé
					</label>
				@endif
			</div>
		</div>
	@endif

</div>

<div class="row">
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-10">
			{!! Form::submit('Enregistrer',['class' =>'btn btn-primary'])!!}
			<a class="btn btn-danger btn-smenu-position ajout"  href="{{ route('users.show',[$profil->id])}}"  role="button">
				 Annuler
			</a>	
		</div>
	</div>
</div>


{!! Form::close() !!}

@section('footer')

    <!-- Datepicker Script -->
	
	<script src="{{ $WEBROOT }}js/bootstrap-datetimepicker.min.js"></script>
	<script src="{{ $WEBROOT }}js/bootstrap-datetimepicker.fr.js"></script>

@stop

@section('script')
		$(document).ready(function(){
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

