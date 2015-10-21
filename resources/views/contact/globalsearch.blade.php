<!-- Affichage en Liste -->
<!-- Compteur pour les éléments null -->
	{{--*/ $cnull = 0; /*--}}
	<table class="table">
		<tr class="active">
			<td></td>
			<td class="sorting">@sortablelink ('nom_clt', 'Nom')</td>
			<td class="sorting">@sortablelink ('pays_clt', 'Pays')</td>
			<td class="sorting">@sortablelink ('ville_siege_clt', 'Ville')</td>
			<td class="sorting">@sortablelink ('statut', 'Catégorie')</td>
			<td class="sorting">@sortablelink ('created_at', 'Date d\'ajout')</td>
			<td class="sorting">@sortablelink ('updated_at', 'Date de modification')</td>
			<td class="sorting">@sortablelink ('notes', 'Contact sans notes')</td>
		</tr>
	</table>

<!-- *******************************************RESULTAT RECHERCHE SOCIETE************************************* -->

<table class="table table-noborder-top table-bordere table-contact">

	@foreach($societe as $societev)

	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $societev->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td><a href="{{route('societe.show',[$societev->id])}}"><p class="media-heading">{{ $societev->nom_clt}}</p></a></td>
	  	<td><p>Société {{ $societev->pays_clt }} @if($societev->ville_siege_clt){{'('.$societev->ville_siege_clt.')' }} @endif</p></td>
	  	<td>@if($societev->tel_siege_clt)<p>{{ 'Tél : '.$societev->tel_siege_clt }} </p>@endif</td>	
	  	<td>
	  		<ul class="action-list">
		  		<li><a href="#" data-toggle="modal"  alt="" data-target="#myModalListe"><span id="{{$societev->id}}" alt="{{$societev->nom_clt}}" class="glyphicon glyphicon-remove societe" aria-hidden="true"></span></a></li>
		  	    <li style="margin-right:8px"><a href="{{ route('societe.edit',[$societev->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
	 		</ul> 
	  	</td>
	  	<td class="hide" ></td>
	</tr>
	
	@endforeach


<!-- *******************************************RESULTAT RECHERCHE CONTACT************************************** -->

	@foreach($contact as $contact)
			
				<tr style="border-bottom: 1px solid #ddd"> 
					<td vertical-align="middle">{!! Form::checkbox('c'.$c, $contact->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
				  	<td> <a href="{{route('contact.show',[$contact->id])}}"><p class="media-heading">{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</p></a></td>
				  	<td><p>Contact @if(isset($contact->societe))<a href="{{ route('societe.show',[$contact->societe->id]) }}">{{ $contact->societe->nom_clt }}</a> @else {{ $contact->nom_clt }}@endif</p></td>
				  	<td>@if($contact->tel_contact)<p>Tél : {{$contact->tel_contact}}</p>@endif</td>
				  	
				  	<td>
				  		<ul class="action-list">
				  			<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span id="{{$contact->id}}" alt="{{$contact->nom_contact.' '.$contact->prenoms_contact}}" class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
					  	    <li style="margin-right:8px"><a href="{{ route('contact.edit',[$contact->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
				 		</ul> 
				  	</td>
				</tr>
	
				<!-- Attribution des valeurs de données Nom et Id pour le modal -->
			
				{{--*/ $c++ /*--}}
	@endforeach
</table>

{!! Form::close() !!}


@if(isset($query))
	<div id="searchdata" class="{{$query}}" alt="{{$mode}}"></div>
@endif



<!-- Modal de recherche -->
	<div class="modal col-md-12 fade" id="myModalSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Recherche Société</h4>
	      </div>
	     <form class="form-horizontal" role="form" method="GET" action="{{ action('SearchController@searchablesociete') }}">
	     	<input type="hidden" name="_token" value="{{ csrf_token() }}">

		      <div class="modal-body">
		       <div class="form-group">
		       	<label class="col-md-4 control-label" >Nom</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="nom" id="nom">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Téléphone</label>
		       	<div class="col-md-6">
		       		<input type="number" class="form-control disablede" name="tel" id="tel">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Pays</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="pays" id="pays">
		       	</div>
		       </div>
		       <div class="form-group">
		       	<label class="col-md-4 control-label">Ville</label>
		       	<div class="col-md-6">
		       		<input type="text" class="form-control" name="ville" id="ville">
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
			       
	     		  {!! Form::hidden('s_societe','societe') !!}
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
	        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer la société <strong><span class="nom-remove"></span> </strong> ?
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



