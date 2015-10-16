@extends('default')


@section('title','Liste des produits et modules ')
@section('titre-entete','Liste des produits et modules')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
<div class="row">
	     {!! Form::open(['route'=>'annuaire.search', 'method'=>'GET']) !!}
		  <div class="col-lg-4 left-btn-search">
		      <div class="input-group">
		        <input type="text" name="q" class="form-control" placeholder="Search for...">
		        <span class="input-group-btn">
		          <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
		        </span>
		      </div><!-- /input-group -->
		    </div><!-- /.col-lg-6 -->
		 {!! Form::close(); !!}
		
	<div class="col-md-7 col-md-offset-1 right-btn-filter" >
	<div id="navbar-action" class="navbar-collapse collapse navbar-right" >

	{!! Form::open(['route'=>'societe.action', 'method'=>'POST']) !!}
	<!-- Boutton d'action sur contact choisi  -->
		
		{!! Form::submit('Ajouter note',['class' =>'btn btn-default checkaction', 'name'=>'add_note']) !!}
		<!-- <a class="btn btn-default btn-smenu-position checkaction" href="#" id="addnote" title="Liste" role="button">
			<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Ajouter note
		</a> -->
			{!! Form::submit('Exporter',['class' =>'btn btn-default checkaction', 'name'=>'export']) !!}
		<!-- <a class="btn btn-default btn-smenu-position checkaction" href="#" id="export" title="Liste" role="button">
			<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Exporter
		</a> -->
			{!! Form::submit('Supprimer',['class' =>'btn btn-danger checkaction', 'name'=>'supp']) !!}
		<!-- <a class="btn btn-danger btn-smenu-position checkaction" id="supp" href="#" title="Grille" role="button">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
		</a> -->
		<!--  Fin boutton d'action -->
		
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Afficher <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li><a href="{{ route ('produit.index') }}">Produit</a></li>
			  	<li><a href="{{ route('module.index') }}">Module</a></li>
			  </ul>
		</div>
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Créer <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
				<li><a href="{{ route ('produit.create') }}">Produit</a></li>
			  	<li><a href="{{ route('module.create') }}">Module</a></li>
			  </ul>
		</div>
	    
		
	</div>
	</div>
	</div><!-- /.row -->

@stop

@section('content')
	

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	@foreach($produit as $produit)
		<div class="panel panel-default">
		  <div class="panel-heading" role="tab" id="headingOne">
		    <h4 class="panel-title">
		      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$produit->nom_produit}}" aria-expanded="true" aria-controls="collapseOne">
		       {{$produit->nom_produit }} 
		      </a>
		      <div class="panel-title pull-right">
		    	 <a href="{{ route('produit.show',[$produit->id])}}">Afficher</a>
		    	 <a href="{{ route('produit.edit',[$produit->id])}}">| Modifier</a>
		    	 <a href="{{ route('produit.update',[$produit->id])}}">| Supprimer</a>
		    </div>
		    </h4>
		    
		  </div>
		  <div id="{{ $produit->nom_produit }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		    <div class="panel-body">
		      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
		    </div>
		  </div>
		</div>
	@endforeach
</div>
@stop




