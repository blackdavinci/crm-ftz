<!-- Affichage en Liste -->
<!-- Checkbox Name Counter -->


<table class="table table-noborder-to  table-contact table-devis">
	<tr class="active devis-table-top">
		<td style="padding-bottom: 8px">{!! Form::checkbox('seelectall', 'all' , null, ['class' => 'listcheckbox','id'=>'selectall']) !!}</td>
		<td>
			N° de facture
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

	@foreach($facture as $facture)
<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($facture->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($facture->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($facture->created_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($facture->created_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($facture->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($facture->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($facture->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($facture->updated_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par notes, ordre alphabétique et normal  -->
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($facture->nom_clt,0,1)))
			{{--*/ $letter = substr($facture->nom_clt,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($facture->nom_clt,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par groupe -->
	@elseif($tri == 'groupe')
		
		@if($letter != $facture->nom_groupe.' '.$facture->date_groupe)
			{{--*/ 
				$letter = $facture->nom_groupe.' '.$facture->date_groupe; $marquer = 0;
				$ancre = ucfirst(substr($letter,0,1));
			 /*--}}
			
		@endif
		@if($letter == $facture->nom_groupe.' '.$facture->date_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $ancre}}" >{!! $letter !!}</h4></td>
			</tr>
			<!-- /***************************************************************/ -->
				
					
			<!-- /***************************************************************/ -->
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($facture->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="3" style="padding-top:0px;"><h4  class="letter">Aucun Groupe</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@endif
	<!-- Tri par pays  -->
	@elseif($tri == 'pays' )
		@if($letter != $facture->pays_clt)
			{{--*/ $letter = $facture->pays_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
		@endif
		@if($letter == $facture->pays_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($facture->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="3"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($facture->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="3"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($facture->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="3"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
	<!-- Fin condition de tri -->
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $facture->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td><a href="{{route('facture.show',[$facture->id])}}">{{$facture->num_facture}}</a></td>
	  	<td>
	  		<a href="{{route('contact.show',[$facture->livraison->devis->contact->id])}}">{{$facture->livraison->devis->contact->nom_contact.' '.$facture->livraison->devis->contact->prenoms_contact}}</a>
	  		(<a href="{{route('societe.show',[$facture->livraison->devis->societe->id])}}">{{$facture->livraison->devis->societe->nom_clt}}</a>)
	  	</td>
	  	<td>{{ $facture->created_at->format('d/m/Y')}}</td>
	  	<td>{{$facture->societe_id.' '}}</td>


	  	<td>
	  		<div class="action-place">
	  		<ul>
		  	    <li style="margin-bottom: 12px"><a href="{{ route('facture.edit',[$facture->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
		  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
	 		</ul> 
	 		</div>
	  	</td>
	</tr>
	<!-- Attribution des valeurs de données Nom et Id pour le modal -->
	
	{{--*/
		 $id = $facture->id; 
		 $nom = $facture->nom_clt; 
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
		        {!! Form::open(['url'=> route('facture.destroy',$id), 'method'=>'delete']) !!}
		      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
		      	{!! Form::close() !!}
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
@endif

