<!-- Affichage en Liste -->
<!-- Checkbox Name Counter -->


<table class="table table-noborder-to  table-contact table-livraison">
	<tr class="active livraison-table-top">
		<td style="padding-bottom: 8px">{!! Form::checkbox('seelectall', 'all' , null, ['class' => 'listcheckbox','id'=>'selectall']) !!}</td>
		<td>
			N° de livraison
		</td>
		<td>
			Client
		</td>
		<td>
			Date
		</td>
		<td>
			Total
		</td>
		
		<td></td>
	</tr>

	@foreach($livraison as $livraison)
<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($livraison->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($livraison->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($livraison->created_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($livraison->created_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($livraison->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($livraison->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($livraison->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($livraison->updated_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par notes, ordre alphabétique et normal  -->
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($livraison->nom_clt,0,1)))
			{{--*/ $letter = substr($livraison->nom_clt,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($livraison->nom_clt,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par groupe -->
	@elseif($tri == 'groupe')
		
		@if($letter != $livraison->nom_groupe.' '.$livraison->date_groupe)
			{{--*/ 
				$letter = $livraison->nom_groupe.' '.$livraison->date_groupe; $marquer = 0;
				$ancre = ucfirst(substr($letter,0,1));
			 /*--}}
			
		@endif
		@if($letter == $livraison->nom_groupe.' '.$livraison->date_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $ancre}}" >{!! $letter !!}</h4></td>
			</tr>
			<!-- /***************************************************************/ -->
				
					
			<!-- /***************************************************************/ -->
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($livraison->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="3" style="padding-top:0px;"><h4  class="letter">Aucun Groupe</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@endif
	<!-- Tri par pays  -->
	@elseif($tri == 'pays' )
		@if($letter != $livraison->pays_clt)
			{{--*/ $letter = $livraison->pays_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
		@endif
		@if($letter == $livraison->pays_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($livraison->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="3"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($livraison->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="3"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($livraison->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="3"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
	<!-- Fin condition de tri -->
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $livraison->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td><a href="{{route('livraison.show',[$livraison->id])}}">{{$livraison->num_bl}}</a></td>
	  	<td>
	  		<a href="{{route('contact.show',[$livraison->devis->contact->id])}}">{{$livraison->devis->contact->nom_contact.' '.$livraison->devis->contact->prenoms_contact}}</a>
	  		(<a href="{{route('societe.show',[$livraison->devis->societe->id])}}">{{$livraison->devis->societe->nom_clt}}</a>)
	  	</td>
	  	<td>{{ $livraison->created_at->format('d/m/Y')}}</td>
	  	<td>{{$livraison->societe_id.' '}}</td>


	  	<td>
	  		<div class="action-place">
	  		<ul class="action-list">
		  		<li><a href="#" data-toggle="modal"  alt="" data-target="#myModalListe"><span id="{{$livraison->id}}" alt="{{$livraison->num_bl}}" class="glyphicon glyphicon-remove livraison" aria-hidden="true"></span></a></li>
		  	    <li style="margin-right:8px"><a href="{{ route('livraison.edit',[$livraison->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
	 		</ul> 
	 		</div>
	  	</td>
	</tr>

	
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
	        <h4 class="modal-title" id="myModalLabel">Suppression de bon de livraison</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer le bon de livraison <strong><span class="nom-remove"></span> </strong> ?
	      </div> 
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
	        <div class="pull-right" style="margin-left:5px;">
		      
		        <form class="delete-form" role="form" method="POST" >
		        	<input name="_method" type="hidden" value="DELETE">
		        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
		      	{!! Form::close() !!}
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

