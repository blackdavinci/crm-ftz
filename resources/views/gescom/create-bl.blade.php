@extends('default')


@section('title','Création de bon de livraison')
@section('titre-entete','Nouveau bon de livraison')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')

{!! Form::open(['url' => route('livraison.store'), 'method'=>'POST']) !!}

  <div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
    <div class="navbar-form navbar-left" style="padding-left:0px;" >
      <a class="btn btn-default btn-smenu-position" href="{{ route('livraison.index')}}" role="button">
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
      </a>
      <div class="form-group">
          {!! Form::submit('Enregistrer + Créer facture ',[
            'name' => 'add_facture',
            'class' =>'btn btn-warning btn-smenu-position',
            ])
          !!}
      </div>
        <div class="form-group ">
        {!! Form::submit('Enregistrer',['class' =>'btn btn-success btn-smenu-position']) !!}
      </div>
    </div>  
  </div>


@stop

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading"><strong>Bon de livraison</strong></div>
  <div class="panel-body" >

		
	</div>


  </div>
</div>

	{!! Form::close() !!}
	@include('errors.list')
@stop




