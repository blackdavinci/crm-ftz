{!! Form::open(['route' =>['users.updatepassword',$profil->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}

<div class="row">
		@include('errors.list')
			<div class="form-group">
			  	<label class="col-sm-3 control-label">{!! Form::label('password','Nouveau mot de passe') !!}</label>
			  	<div class="col-md-8">
					{!! Form::input('password','password',null, ['class' =>'form-control ', 'placeholder' =>'Nouveau mot de passe']) !!}
				</div>
			</div>
	</div>

	<div class="row">
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-10">
				{!! Form::submit('Enregistrer',['class' =>'btn btn-primary'])!!}
				<a class="btn btn-danger btn-smenu-position ajout"  href="{{ route('users.show',[Auth::user()->id])}}"  role="button">
					 Annuler
				</a>	
			</div>
		</div>
	</div>

{!! Form::close() !!}



	

