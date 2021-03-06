<!-- Affichage Liste des contacts -->
<!-- Compteur pour les éléments null -->
{{--*/ $cnull = 0; /*--}}
	<table class="table">
		<tr class="active">
			<td></td>
			<td class="sorting">@sortablelink ('nom_contact', 'Nom')</td>
			<td class="sorting">@sortablelink ('societe_id', 'Société')</td>
			<td class="sorting">@sortablelink ('pays_clt', 'Pays')</td>
			<td class="sorting">@sortablelink ('ville_siege_clt', 'Ville')</td>
			<td class="sorting">@sortablelink ('statut', 'Catégorie')</td>
			<td class="sorting">@sortablelink ('created_at', 'Date d\'ajout')</td>
			<td class="sorting">@sortablelink ('updated_at', 'Date de modification')</td>
			<td class="sorting">@sortablelink ('notes', 'Notes')</td>
		</tr>
	</table>

	<table class="table table-noborder-top table-bordere table-contact">
			@foreach($contact as $contact)
			<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($contact->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($contact->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($contact->created_at)) &&  $marquer == 0)
			{{--*/ $date = $contact->created_at->format('d/m/Y') /*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($contact->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($contact->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($contact->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $contact->updated_at->format('d/m/Y') /*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par ordre alphabétique et normal  -->
	@elseif($tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($contact->nom_contact,0,1)))
			{{--*/ $letter = substr($contact->nom_contact,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($contact->nom_contact,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par notes  -->
	@elseif($tri == 'notes' )
		@if($contact->notes->isEmpty())
			@if($letter != ucfirst(substr($contact->nom_contact,0,1)))
				{{--*/ $letter = substr($contact->nom_contact,0,1); $marquer = 0; /*--}}
				
			@endif
			@if($letter == ucfirst(substr($contact->nom_contact,0,1)) &&  $marquer == 0)
				<tr class="active">
					<td colspan="6"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
				</tr>
				{{--*/ $marquer = 1; /*--}}
			@endif
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
				<td colspan="6"><h4 class="letter" id="{{ $ancre }}" >{!! $letter !!}</h4></td>
			</tr>

			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($contact->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="6" style="padding-top:0px;"><h4  class="letter" >Aucun Groupe'</h4></td>
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
				<td colspan="6"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@if($letter == null)
			<tr class="active">
				<td colspan="6"><h4 class="letter"  style="margin-top: -15px">Aucun pays attribué</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif

	<!-- Tri par ville  -->
	@elseif($tri == 'ville' )
		@if($letter != $contact->ville_siege_clt)
			{{--*/ $letter = $contact->ville_siege_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
			@endif
			
		@endif
		@if($letter == $contact->ville_siege_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@if($letter == null)
			<tr class="active">
				<td colspan="6"><h4 class="letter" style="margin-top: -15px" >Aucune ville attribuée</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par société  -->
		@elseif($tri == 'societe' )
			@if($letter != $contact->nom_clt)
				{{--*/ $letter = $contact->nom_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
				
				@endif
				
			@endif
			@if($letter == $contact->nom_clt &&  $marquer == 0)
				<tr class="active">
					<td colspan="6">
						<h4 class="letter" id="{{ $idletter }}" >
							<a href="{{route('societe.show',[$contact->id])}}">{!! $letter !!}</a>
						</h4>
					</td>
				</tr>
				{{--*/ $marquer = 1; /*--}}
			@if($letter == null)
				<tr class="active">
					<td colspan="6"><h4 class="letter" style="margin-top: -15px" >Aucune societé attribuée</h4></td>
				</tr>
				{{--*/ $marquer = 1; /*--}}
			@endif
	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($contact->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="6"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($contact->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="6"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($contact->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="6"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
<!-- Fin condition de tri -->
@if($tri !='notes')
			<tr style="border-bottom: 1px solid #ddd"> 
				<td vertical-align="middle">{!! Form::checkbox('c'.$c, $contact->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
			  	<td> <a href="{{route('contact.show',[$contact->id])}}"><p class="media-heading">{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</p></a></td>
			  	<td><p>@if(isset($contact->societe))<a href="{{ route('societe.show',[$contact->societe->id]) }}">{{ $contact->societe->nom_clt }}</a> @else {{ $contact->nom_clt }}@endif</p></td>
			  	<td>@if($contact->fonction_contact)<p>{{ $contact->fonction_contact }} </p> @endif</td>
			  	<td>@if($contact->tel_contact)<p>Tél : {{$contact->tel_contact}}</p>@endif</td>
			  	<td>
			  		<ul class="action-list">
				  	    <li style="margin-right:8px"><a href="{{ route('contact.edit',[$contact->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
				  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span id="{{$contact->id}}" alt="{{$contact->nom_contact.' '.$contact->prenoms_contact}}" class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
			 		</ul> 
			  	</td>
			</tr>
@else
	
	@if($contact->notes->isEmpty())
		<tr style="border-bottom: 1px solid #ddd"> 
			<td vertical-align="middle">{!! Form::checkbox('c'.$c, $contact->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
		  	<td> <a href="{{route('contact.show',[$contact->id])}}"><p class="media-heading">{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</p></a></td>
		  	<td><p>@if(isset($contact->societe))<a href="{{ route('societe.show',[$contact->societe->id]) }}">{{ $contact->societe->nom_clt }}</a> @else {{ $contact->nom_clt }}@endif</p></td>
		  	<td>@if($contact->fonction_contact)<p>{{ $contact->fonction_contact }} </p> @endif</td>
		  	<td>@if($contact->tel_contact)<p>Tél : {{$contact->tel_contact}}</p>@endif</td>
		  	<td>
		  		<ul class="action-list">
			  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span id="{{$contact->id}}" alt="{{$contact->nom_contact.' '.$contact->prenoms_contact}}" class="glyphicon glyphicon-remove contact" aria-hidden="true"></span></a></li>
			  	    <li style="margin-right:8px"><a href="{{ route('contact.edit',[$contact->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
		 		</ul> 
		  	</td>
		</tr>
	@else 
		<!-- AFFICHAGE DES CONTACTS AVEC NOTES A FAIRE -->


	@endif
	


@endif
			<!-- Attribution des valeurs de données Nom et Id pour le modal -->
		
			
			{{--*/ $c++ /*--}}
			@endforeach
	</table>
{!! Form::close() !!}


@if(isset($query))
	 {{--*/ $data = $contact /*--}}
	<div id="searchdata" class="{{$query}}" alt="{{$mode}}" align="{{$data}}"></div>
@endif

<!-- Modal de recherche -->
	<div class="modal col-md-12 fade" id="myModalSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recherche Contact</h4>
	      </div>
	     <form class="form-horizontal" role="form" method="GET" action="{{ action('SearchController@searchablecontact') }}">
	     	<input type="hidden" name="_token" value="{{ csrf_token() }}">

		      <div class="modal-body">
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Nom</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="nom" id="nom">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Téléphone</label>
		       	<div class="col-md-6">
		       		<input type="number" class="form-control" name="tel" id="tel" >
		       	</div>
		       </div>

		       <div class="form-group">
		       	<label class="col-md-4 control-label">Adresse</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="adresse" id="adresse">
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

	<!-- Modal de confirmation de suppression -->

	<div class="modal fade" id="myModalListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Suppression de contact</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer le contact <strong> <span class="nom-remove"></span></strong> ?
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