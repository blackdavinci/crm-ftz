<!-- Affichage en Grille -->
<div class="col-md-9 affichage-border" >
	{!! Form::open() !!}
	<table class=" table table-noborder-top  table-contact">
	<!-- Compteur pour l'affichage en grille -->
	{{--*/ $i = 0 /*--}}
	
	
	@foreach($societe as $societeG)
		
	  @if($i==0)<tr> {{--*/ $i = 4/*--}}@endif
	  {{--*/ $i-=1 /*--}}
	  	<td>
	  		<div class=" info-preview pull-left">
	  		    <a href="{{route('societe.show',[$societeG->id])}}"><p class="media-heading">{{ $societeG->nom_clt}}</p></a>
	  		    <p>{{ $societeG->pays_clt.' ('.$societeG->ville_siege_clt.')' }}</p>
	  		   @if(count($societeG->tel_siege_clt))<p>{{ 'Tél : '.$societeG->tel_siege_clt }} </p>@endif
	  		</div>
	  		<div class="action-place pull-right" style="width:20px;">
	  		<ul>
		  	    <li><a href="{{ route('societe.edit',[$societeG->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
		  		<li><a href="" data-toggle="modal" data-target="#myModalGrille"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
	 		</ul> 
	 		</div>
	  	</td>
	@if($i==0)</tr> @endif

	<!-- Modal de confirmation de suppression -->
	<div class="modal fade" id="myModalGrille" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer la société <strong>{{ $societeG->nom_clt }}</strong> ?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	        <div class="pull-right" style="margin-left:5px;">
		        {!! Form::open(['url'=> route('societe.destroy',[$societeG->id]), 'method'=>'delete']) !!}
		      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
		      	{!! Form::close() !!}
	      	</div>

	      </div>
	    </div>
	  </div>
	</div>
	@endforeach
	</table>

	{!! Form::close() !!}
</div>
