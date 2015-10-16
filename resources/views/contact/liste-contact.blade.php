<!-- Affichage Liste des contacts -->
<!-- Checkbox Name Counter -->

	<table class="table table-noborder-top table-bordere table-contact">
			@foreach($contact as $contact)
			<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($contact->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($contact->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($contact->created_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($contact->created_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($contact->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($contact->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($contact->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($contact->updated_at)) /*--}}
			<tr class="active">
				<td colspan="3"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par notes, ordre alphabétique et normal  -->
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($contact->nom_contact,0,1)))
			{{--*/ $letter = substr($contact->nom_contact,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($contact->nom_contact,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par groupe -->
	@elseif($tri == 'groupe')
		@if($letter != $contact->nom_groupe.' '.$contact->date_groupe)
			{{--*/ 
				$letter = $contact->nom_groupe.' '.$contact->date_groupe; $marquer = 0;
				$ancre = ucfirst(substr($letter,0,1));

			 /*--}}
			
		@endif
		@if($letter == $contact->nom_groupe.' '.$contact->date_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $ancre }}" >{!! $letter !!}</h4></td>
			</tr>

			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($contact->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="3" style="padding-top:0px;"><h4  class="letter" >Aucun Groupe'</h4></td>
			</tr>

			{{--*/ $none = 1; /*--}}
		@endif
	<!-- Tri par pays  -->
	@elseif($tri == 'pays' )
		@if($letter != $contact->pays_clt)
			{{--*/ $letter = $contact->pays_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
			@endif
			
		@endif
		@if($letter == $contact->pays_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="3"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@if($letter == null)
			<tr class="active">
				<td colspan="3"><h4 class="letter" style="margin-top:-15px" >Aucun pays attribué</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif

	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($contact->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="3"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($contact->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="3"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($contact->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="3"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
<!-- Fin condition de tri -->
			<tr style="border-bottom: 1px solid #ddd"> 
				<td vertical-align="middle">{!! Form::checkbox('c'.$c, $contact->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
			  	<td>
			  		<div class=" info-preview pull-left">
			  		    <a href="{{route('contact.show',[$contact->id])}}"><p class="media-heading">{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</p></a>
			  		   <p>@if(isset($contact->societe))<a href="{{ route('societe.show',[$contact->societe->id]) }}">{{ $contact->societe->nom_clt }}</a> @else {{ $contact->nom_clt }}@endif</p> 

			  		   @if($contact->fonction_contact)<p>{{ $contact->fonction_contact }} </p> @endif
			  		   
			  		</div>
			  		<div class="action-place">
			  		<ul>
				  	    <li><a href="{{ route('contact.edit',[$contact->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
				  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
			 		</ul> 
			 		</div>
			  	</td>
			</tr>
			<!-- Attribution des valeurs de données Nom et Id pour le modal -->
			
			{{--*/
				 $id = $contact->id; 
				 $nom = $contact->nom_clt; 
			/*--}}
			
			{{--*/ $c++ /*--}}
			@endforeach
			</table>
		{!! Form::close() !!}
	</table>

<!-- Modal de recherche -->
	<div class="modal col-md-12 fade" id="myModalSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recherche Société</h4>
	      </div>
	     <form class="form-horizontal" role="form" method="GET" action="{{ route('annuaire.search') }}">
	     	<input type="hidden" name="_token" value="{{ csrf_token() }}">

		      <div class="modal-body">
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Nom</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="nom" value="{{ old('nom') }}">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Téléphone</label>
		       	<div class="col-md-6">
		       		<input type="number" class="form-control" name="tel" value="{{ old('tel') }}">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Pays</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="pays" value="{{ old('pays') }}">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Ville</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="ville" value="{{ old('ville') }}">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Adresse</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="q" value="{{ old('adresse') }}">
		       	</div>
		       </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
		        <div class="pull-right" style="margin-left:5px;">
			           
	     		  {!! Form::hidden('s_contact','contact') !!}
			      {!! Form::submit('Rechercher',['class'=>'btn btn-warning btn-smenu-position'])!!}
			      	
		      	</div>
	      	{!! Form::close() !!}
	      </div>
	    </div>
	  </div>
	</div>