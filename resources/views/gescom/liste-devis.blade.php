<!-- Affichage en Liste -->
<!-- Checkbox Name Counter -->


<table class="table table-noborder-to  table-contact table-devis">
	<tr class="active devis-table-top">
		<td style="padding-bottom: 8px">{!! Form::checkbox('seelectall', 'all' , null, ['class' => 'listcheckbox','id'=>'selectall']) !!}</td>
		<td>
			N° de devis
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

	@foreach($devis as $devis)
<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($devis->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($devis->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($devis->created_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($devis->created_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($devis->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($devis->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($devis->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($devis->updated_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par notes, ordre alphabétique et normal  -->
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($devis->nom_clt,0,1)))
			{{--*/ $letter = substr($devis->nom_clt,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($devis->nom_clt,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par groupe -->
	@elseif($tri == 'groupe')
		
		@if($letter != $devis->nom_groupe.' '.$devis->date_groupe)
			{{--*/ 
				$letter = $devis->nom_groupe.' '.$devis->date_groupe; $marquer = 0;
				$ancre = ucfirst(substr($letter,0,1));
			 /*--}}
			
		@endif
		@if($letter == $devis->nom_groupe.' '.$devis->date_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $ancre}}" >{!! $letter !!}</h4></td>
			</tr>
			<!-- /***************************************************************/ -->
				
					
			<!-- /***************************************************************/ -->
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($devis->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="3" style="padding-top:0px;"><h4  class="letter">Aucun Groupe</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@endif
	<!-- Tri par pays  -->
	@elseif($tri == 'pays' )
		@if($letter != $devis->pays_clt)
			{{--*/ $letter = $devis->pays_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
		@endif
		@if($letter == $devis->pays_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($devis->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="3"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($devis->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="3"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($devis->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="3"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
	<!-- Fin condition de tri -->
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $devis->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td><a href="{{route('devis.show',[$devis->id])}}">{{$devis->num_devis}}</a></td>
	  	<td>
	  		<a href="{{route('contact.show',[$devis->contact->id])}}">{{$devis->contact->nom_contact.' '.$devis->contact->prenoms_contact}}</a>
	  		(<a href="{{route('societe.show',[$devis->societe->id])}}">{{$devis->societe->nom_clt}}</a>)
	  	</td>
	  	<td>{{ $devis->created_at->format('d/m/Y')}}</td>
	  	<td>{{$devis->societe_id.' '}}</td>


	  	<td>
	  		<div class="action-place">
	  		<ul class="action-list">
		  		<li><a href="#" data-toggle="modal"  alt="" data-target="#myModalListe"><span id="{{$devis->id}}" alt="{{$devis->num_devis}}" class="glyphicon glyphicon-remove devis" aria-hidden="true"></span></a></li>
		  	    <li style="margin-right:8px"><a href="{{ route('devis.editer',[$devis->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
	 		</ul> 
	 		</div>
	  	</td>
	</tr>
	<!-- Attribution des valeurs de données Nom et Id pour le modal -->
	
	{{--*/
		 $id = $devis->id; 
		 $nom = $devis->nom_clt; 
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
	        <h4 class="modal-title" id="myModalLabel">Suppression de devis</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer le devis <strong><span class="nom-remove"></span> </strong> ?
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

