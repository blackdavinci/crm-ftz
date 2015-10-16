@extends('default')


@section('title','Groupe CRM')
@section('titre-entete','Créer Groupe CRM')

@include('default.top-nav')
@include('default.left-nav')



@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading"><strong>Vous pouvez créer un nouveau groupe crm pour vos contacts</strong></div>
  <div class="panel-body" >
	{!! Form::open(['route' =>'groupe.store', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('nom','Nom Groupe') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('nom_groupe',null, ['class' =>'form-control ', 'placeholder' =>'Nom du Groupe CRM']) !!}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">{!! Form::label('type','Type de Groupe',['style'=> ' margin-left:15px']) !!}</label>
			<div class="col-md-8">
				{!! Form::select('type_groupe',[''=>'Choisissez le type de Groupe CRM','Produit'=>'Produit','Evènement'=>'Evènement'],null, ['class' =>'form-control']) !!}
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
				{!! Form::select('date_groupe',$annee,null, ['class' =>'form-control']) !!}
			</div>	
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{!! Form::submit('Créer groupe',['class' =>'btn btn-primary'])!!}
				<a class="btn btn-danger btn-smenu-position ajout" id="grille" href="{{ route('societe.index')}}" title="Grille" role="button">
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




