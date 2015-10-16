@extends('default')


@section('title','Nouveau produit CRM')
@section('titre-entete','Nouveau produit')

@include('default.top-nav')
@include('default.left-nav')

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading"><strong>Création de nouveau produit</strong></div>
  <div class="panel-body" >
	{!! Form::open(['route' =>'produit.store', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('produit','Nom du produit') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('nom_produit',null, ['class' =>'form-control ', 'placeholder' =>'Nom du produit']) !!}
			</div>
		</div>
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('prefixe','Prefix devis du produit') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('prefix_produit',null, ['class' =>'form-control ', 'placeholder' =>'Exemple : Elect pour ShemElect, BAT pour ShemBAT,..']) !!}
			</div>
		</div>
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('suffixe','Suffixe devis du produit') !!}</label>
		  	<div class="col-md-8">
				{!! Form::input('number','suffix_produit',null, ['class' =>'form-control ', 'placeholder' =>'100,200,300']) !!}
			</div>
		</div>
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('description','Description du produit') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('desc_produit',null, ['class' =>'form-control ', 'placeholder' =>'Description du produit']) !!}
			</div>
		</div>
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('version','Version du produit') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('vers_produit',null, ['class' =>'form-control ', 'placeholder' =>'Version du produit']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{!! Form::submit('Créer produit',['class' =>'btn btn-primary'])!!}
				{!! Form::submit('Créer + Nouveau module',['name' => 'add_module','class' =>'btn btn-warning btn-smenu-position',])!!}
				<a class="btn btn-danger btn-smenu-position ajout" id="grille" href="{{ route('produit.index')}}"  role="button">
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




