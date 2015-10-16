@extends('default')


@section('title','Nouveau module ')
@section('titre-entete','Nouveau module')

@include('default.top-nav')
@include('default.left-nav')

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
  	@if($produit)
  		<strong>Création d'un nouveau module</strong>
  	@else
  		<strong>Création d'un nouveau module pour le produit {!! "<span style='color:red'>".$produit->nom_produit."</span>" !!}</strong>
  	@endif
  </div>
  <div class="panel-body" >
	{!! Form::open(['route' =>'module.store', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('module','Nom du module') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('nom_module',null, ['class' =>'form-control ', 'placeholder' =>'Nom du module']) !!}
			</div>
		</div>
	@if(!isset($id) && !isset($id_produit))
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('produit','Module du produit') !!}</label>
		  	<div class="col-md-8">
				{!! Form::select('produit_id[]',$produits,null,['class' =>'form-control input-sm ', 'id'=>'produit_lis','multiple']) !!}
			</div>
		</div>
		{!! Form::input('hidden','produit_id_l','choice') !!} 
	@endif
		<div class="form-group">
			<label class="col-sm-2 control-label">{!! Form::label('type','Type de module') !!}</label>
			<div class="col-md-8">
				{!! Form::select('type_module',['Simple'=>'Simple module','Base'=>'Module de base','SD'=>'Simple avec duré'],old('type_module'),['class' =>'form-control input-sm']) !!}
			</div>
		</div>
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('description','Description du module') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('desc_module',null, ['class' =>'form-control ', 'placeholder' =>'Description du module']) !!}
			</div>
		</div>
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('prix','Prix du module') !!}</label>
		  	<div class="col-md-8">
				{!! Form::input('number','prix_module',null, ['class' =>'form-control ', 'placeholder' =>'Prix du module']) !!}
			</div>
		</div>
		

		
		<div class="form-group">
		  	<label class="col-sm-2 control-label">{!! Form::label('version','Version du module') !!}</label>
		  	<div class="col-md-8">
				{!! Form::text('vers_module',null, ['class' =>'form-control ', 'placeholder' =>'Version du module']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{!! Form::submit('Créer module',['class' =>'btn btn-primary'])!!}
			
				{!! Form::submit('Créer + Nouveau module',['name' => 'add_again','class' =>'btn btn-warning btn-smenu-position',])!!}
			
				<a class="btn btn-danger btn-smenu-position ajout" id="grille" href="{{ route('produit.index')}}" title="Grille" role="button">
					 Annuler
				</a>	
			</div>
		</div>
	</div>
		@if(isset($id) || isset($id_produit)) {!! Form::input('hidden','produit_id',$id) !!} @endif
	{!! Form::close() !!}

  </div>
</div>

	@include('errors.list')
@stop

@section('script')
  	$(document).ready(function(){

        $('#produit_list').select2();
    });
@stop



