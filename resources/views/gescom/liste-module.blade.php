@extends('default')


@section('title','Liste des modules et modules ')
@section('titre-entete','Liste des modules et modules')

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
	<!-- Initialisation compteur pour checkbox, lettre et marque pour ancre de contact -->
	{{--*/ 
		$formatter = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG,
		                IntlDateFormatter::NONE,
		                'Europe/Paris',
		                IntlDateFormatter::GREGORIAN );
		$c = 1;
		$letter = 'A'; 
		$marquer = 0; 
		$none = 0;
		$noneg = 0;
		$clt = 0;
		$pr = 0;
		$today = date("Y-m-d"); 

	/*--}}
	<div class="col-md-9  affichage-border test">
		<div class="lettre-index col-md-" >
			<table class="table table-noborder-top  table-contact" id="contact-letter">
				<tr>
					<td>{!! Form::checkbox('seelectall', 'all' , null, ['class' => 'listcheckbox','id'=>'selectall']) !!}</td>
					<td>
						{{--*/ $x = 'A' /*--}}
						@for($i = 1; $i<= 26; $i++)
							<a class='alphabet 'href="#{{ $x }}">{{ $x }}</a>
							{{--*/ $x++; /*--}}
						@endfor
					</td>
				</tr>
			</table>
		</div>
	

	<!-- Affichage des modules -->

	<table class="table table-noborder-top table-bordere table-contact">

		@foreach($module as $module)
	<!-- Condition pour les tris  -->
		
			<!-- Tri par notes, ordre alphabétique et normal  -->
		@if($tri == 'alpha' )
			@if($letter != ucfirst(substr($module->nom_module,0,1)))
				{{--*/ $letter = substr($module->nom_module,0,1); $marquer = 0; /*--}}
				
			@endif
			@if($letter == ucfirst(substr($module->nom_module,0,1)) &&  $marquer == 0)
				<tr class="active">
					<td colspan="3"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
				</tr>
				{{--*/ $marquer = 1; /*--}}
			@endif
		@endif
		<!-- Fin condition de tri -->
		<tr style="border-bottom: 1px solid #ddd"> 
			<td vertical-align="middle">{!! Form::checkbox('c'.$c, $module->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
		  	<td>
		  		<div class=" col-md-9 info-preview pull-left">
		  		    <a href="{{route('module.show',[$module->id])}}">
		  		    	<p class="media-heading">{{ $module->nom_module}}</p>
		  		    </a>
		  		  	@if($module->vers_module) <p>Version {{ $module->vers_module }}</p> @endif
		  		  	@if($module->prix_module) <p>Prix {{ $module->prix_module }}</p> @endif
					
					@unless($module->produits->isEmpty())
			  		  	
				  		  	@foreach($module->produits as $produits)
				  		  		<p style="float:left; margin-right:5px;">
				  		  			<a href="{{ route('produit.show',[$produits->id])}}">{{ $produits->nom_produit }}</a>
				  		  		</p>
				  		  	@endforeach
			  		  	
		  		  	@endunless
		  		</div>
		  		
		  		<div class="action-place">
		  		<ul>
			  	    <li style="margin-bottom: 12px"><a href="{{ route('module.edit',[$module->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
			  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
		 		</ul> 
		 		</div>
		  	</td>
		</tr>
		<!-- Attribution des valeurs de données Nom et Id pour le modal -->
		
		{{--*/
			 $id = $module->id; 
			 $nom = $module->nom_clt; 
		/*--}}
		
		{{--*/ $c++ /*--}}
		@endforeach
		</table>
	{!! Form::close() !!}

	<!-- Modal de confirmation de suppression -->
	@if(!empty($id))
		<div class="modal fade" id="myModalListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
		      </div>
		      <div class="modal-body">
		        Voulez-vous vraimment supprimer la société <strong>@if(!empty($nom)){{ $nom }} @endif</strong> ?
		      </div> 
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
		        <div class="pull-right" style="margin-left:5px;">
			        {!! Form::open(['url'=> route('module.destroy',$id), 'method'=>'delete']) !!}
			      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
			      	{!! Form::close() !!}
		      	</div>
		      </div>
		    </div>
		  </div>
		</div>
	@endif
</div>

@stop




