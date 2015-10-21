@extends('default')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}

@section('title','Facture')
@section('titre-entete')
	<div class="pull-left" style="margin:-6px 4px 4px 4px;">
			{{ 'Facture  '.$profil->num_facture }}
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
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Imprimer
			</a>
			
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
			        <h4 class="modal-title" id="myModalLabel">Suppression de facture</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer la facture <strong>{{ $profil->num_facture }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('facture.destroy',[$profil->id]), 'method'=>'delete']) !!}
				      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
				      	{!! Form::close() !!}
			      	</div>

			      </div>
			    </div>
			  </div>
			</div>
			 
		</div>
	</div>
@stop

@section('content')
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <span ><strong style="text-align: center">Facture {{ $profil->num_facture }}</strong></span> 
	  </div>
	  <div class="panel-body" >
	    <!-- Ligne d'information sur la société et le devis -->
	  <div class="row">
	      <div class="col-md-3" >
	        <div class="col-md-12"> <img   src="{{ $WEBROOT }}img/uploads/{{$profil->societedata->logo}}" alt="logo FTZ"> </div> 
	      </div>
	  </div>
	  <br/>
	  <div class="row">
        <div class="col-md-6">
          <div class=" cadre-inf panel-default">
          <div class="panel-body ">
		    <h5>
			  	<strong>
			       	{{ $profil->societedata->nom }} 
			       	<br/> {{ $profil->societedata->adresse }}
			       	<br/>{{ $profil->societedata->ville }}
			       	<br/>{{ $profil->societedata->pays }} 
			       	<br/>Tel : {{ $profil->societedata->tel }}
			       	<br/>E-mail : {{ $profil->societedata->email }}
			       	<br/>URL : {{ $profil->societedata->url }}
			   	</strong>
		    </h5>
          </div>
        </div>  
      </div>  
      <div class="col-md-5 pull-right">
        <div class=" cadre-info panel-default">
          <div class="panel-body ">
          	<h4><strong>Facture</strong></h4>
	  		<h4 class="num-devis"> {{ $profil->num_facture }}</h4>
          </div>
         </div> 
        </div>
      </div>
		
	  <div class="row">
        <div class="col-md-6">
          <div class=" cadre-info panel-default">
          <div class="panel-body ">
           <h5>
           		<strong>Date :</strong>
           		<br/>{{ $profil->created_at->format('d/m/Y')}}<br/>
           		<br/><strong>Ref Fournisseur</strong>
           		<br/>{{ $profil->ref_dest }}
           		<br/><strong>Numéro de la commande :</strong>
           		<br/>{{ $profil->num_facture }}<br/>
           		<br/><strong>Date de la commande : </strong>
           		<br/>{{ $profil->livraison->created_at->format('d/m/Y') }}<br/>
           		<br/><strong>Modalités de facture</strong>
           		<br/>Livré à l'adresse {{ $profil->destinataire }}<br/>
           		<br/><strong>{{ $profil->contact_dest }}</strong>
           </h5>
          </div>
        </div>  
      </div>  
      <div class="col-md-5 pull-right">
        <div class=" cadre-info panel-default">
          <div class="panel-body ">
          	<h5>
          		<strong>Destinataire</strong>
          		<br/>{{ $profil->destinataire}} 
				<br/> {{ $profil->adresse_dest }}
				<br/>{{ $profil->ville_dest }}
				<br/>{{ $profil->pays_dest}} 
				<br/>Tel : {{ $profil->tel_dest }}
				<br/>E-mail : {{ $profil->email_dest }}
				<br/>Fax : {{ $profil->fax_dest }}
				<br/>URL : {{ $profil->url_dest }}
          	</h5>
          </div>
         </div> 
        </div>
      </div>

 
      <!-- Partie 2 Devis -->

      <div class="row">
      	<div class="col-md-12">
      		<h4 style="text-align: center">Facture</h4>
      	</div>
      </div>
      <div class="row">
      	<div class="col-md-6">
      	{{--*/ $n = 0 /*--}}
      		<table class="table table-striped ">
      			<tr><th>Désignation</th><th>Quantité</th><th>Prix en MAD</th></tr>
      			<td>
      			@foreach($modules as $modulesbase)
      				@if($modulesbase->type_module=='Base' && $modulesbase->pivot->quantite > 0)
      					@if($n==0)
								Licence {{$profil->devis->produit }} comprenant :<br/>
								Module de base <br/>
							
      					{{--*/ $n++ /*--}}
      					@endif
      				@endif
      			@endforeach
      			@foreach($modules as $modulesautres)
					@if($modulesautres->type_module!='Base' && $modulesautres->pivot->quantite > 0)
      					{{$modulesautres->nom_module}}<br/>
      				@endif
      			@endforeach
      			</td>
      			<td>
	      			@foreach($modules as $modulesbaseqt)
	      				@if($modulesbaseqt->type_module=='Base' )
	      					@if($n==1)
	      						<br/>
								 {{ $modulesbaseqt->pivot->quantite}}<br/>
	      					{{--*/ $n++ /*--}}
	      					@endif
	      				@endif
	      			@endforeach
	      			@foreach($modules as $modulesautresqt)
						@if($modulesautresqt->type_module !='Base'  && $modulesbaseqt->pivot->quantite > 0)
	      					{{ $modulesautresqt->pivot->quantite}}<br/>
	      				@endif
	      			@endforeach
      			</td>
      			
      		</table>
      	</div>
      	<div class="col-md-6">
      		<table class="table  table-striped ">
      			<tr><th>N° Clé</th><th>{{$profil->num_cle}}</th></tr>
      			<tr><th>Mac Adresse</th><th>{{$profil->num_mac}}</th></tr>
      		</table>
      	</div>
      </div>
	 
	  </div>
	</div>
@stop
