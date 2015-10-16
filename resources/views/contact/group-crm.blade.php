<!-- Affichage en Grille -->
<div class="col-md-9 affichage-borde" >
	{!! Form::open() !!}
	<table class=" table table-noborder-top   table-contact">
	<!-- Compteur pour l'affichage en grille -->
	{{--*/ $i = 0 /*--}}
	
	
	@foreach($groupe as $groupe)
		
	  @if($i==0)<tr> {{--*/ $i = 5/*--}}@endif
	  {{--*/ $i-=1 /*--}}
	 	<td vertical-align="middle">{!! Form::checkbox('c'.$c, $groupe->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td>
	  		<div class=" info-preview pull-left">
	  		    <a href="{{route('groupe.show',[$groupe->id])}}"><p class="media-heading">{{ $groupe->nom_groupe}}</p></a>
	  		    <p>{{ $groupe->date_groupe }}</p>
	  		</div>
	  		<div class="action-place-groupe " style="width:20px;">
	  		<ul style="clear:left; border:1px solid black">
		  	    <li style="float:left;"><a href="{{ route('groupe.edit',[$groupe->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
		  		<li style="float:left;"><a href="" data-toggle="modal" data-target="#myModalGrille"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
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
	        <h4 class="modal-title" id="myModalLabel">Suppression du groupe</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer le groupe <strong>{{ $groupe->nom_groupe }}</strong> ?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	        <div class="pull-right" style="margin-left:5px;">
		        {!! Form::open(['url'=> route('groupe.destroy',[$groupe->id]), 'method'=>'delete']) !!}
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
