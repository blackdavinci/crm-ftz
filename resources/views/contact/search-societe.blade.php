<!-- Affichage en Liste -->
<!-- Checkbox Name Counter -->


	<table class="table table-noborder-top table-bordere table-contact">

	@foreach($societe as $societe)
<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($societe->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($societe->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($societe->created_at)) &&  $marquer == 0)
			{{--*/ $date = $societe->created_at /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($societe->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($societe->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($societe->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $societe->updated_at /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par notes, ordre alphabétique et normal  -->
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($societe->nom_clt,0,1)))
			{{--*/ $letter = substr($societe->nom_clt,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($societe->nom_clt,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par groupe -->
	@elseif($tri == 'groupe')
		
		@if($letter != $societe->nom_groupe.' '.$societe->date_groupe)
			{{--*/ 
				$letter = $societe->nom_groupe.' '.$societe->date_groupe; $marquer = 0;
				$ancre = ucfirst(substr($letter,0,1));
			 /*--}}
			
		@endif
		@if($letter == $societe->nom_groupe.' '.$societe->date_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $ancre}}" >{!! $letter !!}</h4></td>
			</tr>
			<!-- /***************************************************************/ -->
				
					
			<!-- /***************************************************************/ -->
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($societe->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="3" style="padding-top:0px;"><h4  class="letter">Aucun Groupe</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@endif
	<!-- Tri par pays  -->
	@elseif($tri == 'pays' )
		@if($letter != $societe->pays_clt)
			{{--*/ $letter = $societe->pays_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
		@endif
		@if($letter == $societe->pays_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($letter == null)
			<tr class="active">
				<td colspan="3"><h4 class="letter" style="margin-top:-15px" >Aucun pays attribué</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($societe->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="3"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($societe->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="3"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($societe->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="3"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
	<!-- Fin condition de tri -->
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $societe->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td>
	  		<div class=" col-md-9 info-preview pull-left">
	  		    <a href="{{route('societe.show',[$societe->id])}}">
	  		    	<p class="media-heading">{{ $societe->nom_clt}}</p>
	  		    </a>
	  		  	   @if($societe->nom_groupe)<p>{{ $societe->nom_groupe }} </p>@endif
	  		    <p>{{ $societe->pays_clt }} @if($societe->ville_siege_clt){{'('.$societe->ville_siege_clt.')' }} @endif</p>
	  		   @if($societe->tel_siege_clt)<p>{{ 'Tél : '.$societe->tel_siege_clt }} </p>@endif
	  		</div>
	  		<div id="statut-contact" class="col-md-2">
	  			@if($tri =='none' && $societe->statut=='0')
	  		    	<h4 class="pull-right"><span class="label label-primary">Prospect</span></h4> 
	  		    @elseif($tri=='none' && $societe->statut == '2')
	  		    	<h4 class="pull-right"><span class="label label-default">Prospect</span></h4> 
	  		    @endif
	  		</div>
	  		<div class="action-place">
	  		<ul>
		  	    <li style="margin-bottom: 12px"><a href="{{ route('societe.edit',[$societe->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
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
		        {!! Form::open(['url'=> route('societe.destroy',$id), 'method'=>'delete']) !!}
		      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
		      	{!! Form::close() !!}
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
@endif

