<!-- Affichage en Liste -->
<!-- Checkbox Name Counter -->
{{--*/ $c = 1 /*--}}

	<table class="table table-noborder-top table-bordere table-contact">

	@foreach($$listegroupe as $societe)
	@if()
		<tr>

		</tr>
	@endif
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $societe->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td>
	  		<div class=" info-preview pull-left">
	  		    <a href="{{route('societe.show',[$societe->id])}}"><p class="media-heading">{{ $societe->nom_clt}}</p></a>
	  		    <p>{{ $societe->pays_clt }} @if($societe->ville_siege_clt){{'('.$societe->ville_siege_clt.')' }} @endif</p>
	  		   @if($societe->tel_siege_clt)<p>{{ 'Tél : '.$societe->tel_siege_clt }} </p>@endif
	  		</div>
	  		<div class="action-place">
	  		<ul>
		  	    <li><a href="{{ route('societe.edit',[$societe->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
		  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
	 		</ul> 
	 		</div>
	  	</td>
	</tr>
	<!-- Attribution des valeurs de données Nom et Id pour le modal -->
	
	{{--*/
		 $id = $societe->id; 
		 $nom = $societe->nom_clt; 
	/*--}}
	
	{{--*/ $c++ /*--}}
	@endforeach
	</table>
{!! Form::close() !!}

<!-- Modal de confirmation de suppression -->
	<div class="modal fade" id="myModalListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer la société <strong>{{ $nom }}</strong> ?
	      </div> 
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	        <div class="pull-right" style="margin-left:5px;">
		        {!! Form::open(['url'=> route('societe.destroy',$id), 'method'=>'delete']) !!}
		      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
		      	{!! Form::close() !!}
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

