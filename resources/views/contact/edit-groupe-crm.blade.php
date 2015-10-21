@extends('default')


@section('title','Groupe CRM')
@section('titre-entete','Edition Groupe CRM')

@include('default.top-nav')
@include('default.left-nav')



@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading"><strong>Modification du groupe CRM {{$profil->nom_groupe.' '.$profil->date_groupe }}</strong></div>
  <div class="panel-body" >
	{!! Form::open(['route' =>['groupe.update',$profil->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('nom','Nom Groupe') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('nom_groupe',$profil->nom_groupe, ['class' =>'form-control ']) !!}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">{!! Form::label('type','Type de Groupe',['style'=> ' margin-left:15px']) !!}</label>
			<div class="col-md-8">
				{!! Form::select('type_groupe',['Produit'=>'Produit','Evènement'=>'Evènement'],'$profil->type_groupe', ['class' =>'form-control']) !!}
			</div>	
		</div>
		<div class="form-group">
			{{--*/ 
				$annee = array();
				$year = 2015;
			/*--}}
			@for ($i = $year; $i >= 2010; $i--)
			  {{--*/ $annee[$i] = $i /*--}} 
			@endfor

			<label class="col-sm-2 control-label">{!! Form::label('date','Année',['style'=> ' margin-left:15px']) !!}</label>
			<div class="col-md-8">
				{!! Form::select('date_groupe',$annee,$profil->date_groupe, ['class' =>'form-control']) !!}
			</div>	
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{!! Form::submit('Enregistrer',['class' =>'btn btn-primary'])!!}
				<a class="btn btn-danger btn-smenu-position ajout" href="{{ route('groupe.show',[$profil->id])}}"  role="button">
					 Annuler
				</a>	
			</div>
		</div>
	</div>
	{!! Form::close() !!}

  </div>
</div>

	@include('errors.list')
@stop




