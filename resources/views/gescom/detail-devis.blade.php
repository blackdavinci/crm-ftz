@extends('default')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

@section('title','Détail devis')
@section('titre-entete')
	<div class="pull-left" style="margin:-6px 4px 4px 4px;">
			<a class="btn btn-danger btn-smenu-position" href="{{ route('gescom.index')}}" role="button">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 
			</a>
			{{ 'Détail du devis '.$profil->num_devis }}
	</div>
@stop

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	<div class="masthead">
		<div class="inner">
		  <nav>
			<ul class="nav masthead-nav">
			  <li class="active"><a href="#">Informations</a></li>
			  <li><a href="#">Notes</a></li>
			  <li><a href="#">Fichiers</a></li>
			  <li><a href="#">Historique</a></li>
			</ul>
		  </nav>
		</div>
		<div class="pull-right" style="margin:4px;">
		    <a class="btn btn-primary btn-smenu-position" href="{{ route('module.creer',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer
			</a>
		
			<!-- Button de Bon de livraison modal -->
			<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal-livraison">
			  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Générer Bon de livraison
			</button>

		    <a class="btn btn-warning btn-smenu-position" href="{{ route('devis.editer',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
			</a>
			<!-- Button de Suppression modal -->
			<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
			</button>
			<!-- Modal de confirmation de suppression -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Suppression de devis</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer le devis <strong>{{ $profil->num_devis }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('devis.destroy',[$profil->id]), 'method'=>'delete']) !!}
				      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
				      	{!! Form::close() !!}
			      	</div>

			      </div>
			    </div>
			  </div>
			</div>

			<!-- Modal de génération de bon de livraison -->
			<div class="modal fade" id="myModal-livraison" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			  {!! Form::open(['url'=> route('livraison.store',[$profil->id]), 'method'=>'POST','class'=>'form-horizontal']) !!}
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Veuillez entrer les données de licence</h4>
			      </div>
			      <div class="modal-body">
			     		<div class="form-group">
							<label class="col-md-4 control-label">Numéro Clé</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="cle" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Mac Adresse</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mac" value="{{ old('prenom') }}">
							</div>
						</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
			        	{!! Form::hidden('id',$profil->id) !!}
				        {!! Form::submit('Générer',['class'=>'btn btn-warning btn-smenu-position'])!!}
			        	
			      	</div>
			      </div>
			    </div>
			    {!! Form::close() !!}
			  </div>
			</div>
			 
		</div>
	</div>
@stop

@section('content')
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <span ><strong style="text-align: center">Devis {{ $profil->num_devis }}</strong></span> 
	  </div>
	  <div class="panel-body" >
		@include('gescom.devis-part-1')
	  </div>
	</div>
@stop
