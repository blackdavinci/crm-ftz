<!-- Affichage en Liste -->
<!-- Compteur pour les éléments null -->
	{{--*/ $cnull = 0; /*--}}
	<table class="table">
		<tr class="active">
			<td></td>
			<td class="sorting">@sortablelink ('nom_groupe', 'Nom')</td>
			<td class="sorting">@sortablelink ('date_groupe', 'Année du groupe')</td>
			<td class="sorting">@sortablelink ('type_groupe', 'Type de groupe')</td>
			<td class="sorting">@sortablelink ('created_at', 'Date d\'ajout')</td>
			<td class="sorting">@sortablelink ('updated_at', 'Date de modification')</td>
			
		</tr>
	</table>

	<table class="table table-noborder-top table-bordere table-contact">

	@foreach($groupe as $groupe)

<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($groupe->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($groupe->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($groupe->created_at)) &&  $marquer == 0)
			{{--*/ $date = $groupe->created_at->format('d/m/Y') /*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($groupe->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($groupe->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($groupe->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $groupe->updated_at->format('d/m/Y')/*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par date du groupe  -->
	@elseif( $tri == 'date')
		@if($today != $groupe->date_groupe)
			{{--*/ $today = $groupe->date_groupe; $marquer = 0; /*--}}
		@endif
		@if($today == $groupe->date_groupe &&  $marquer == 0)
			{{--*/ $date = $groupe->date_groupe /*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par type de groupe -->
	@elseif($tri == 'type' )
		@if($letter != $groupe->type_groupe)
			{{--*/ $letter = $groupe->type_groupe; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
		@endif
		@if($letter == $groupe->type_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		
	<!-- Tri par nom du groupe -->
	@elseif( $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($groupe->nom_groupe,0,1)))
			{{--*/ $letter = substr($groupe->nom_groupe,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($groupe->nom_groupe,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	
	@endif
	<!-- Fin condition de tri -->
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $groupe->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td><a href="{{route('groupe.show',[$groupe->id])}}"><p class="media-heading">{{ $groupe->nom_groupe}}</p></a></td>
	  	<td> <p>{{ $groupe->date_groupe }}</p></td>	
	  	<td>
	  		<ul class="action-list">
	  			<li><a href="#" data-toggle="modal"  alt="" data-target="#myModalListe"><span id="{{$groupe->id}}" alt="{{$groupe->nom_groupe.' '.$groupe->date_groupe}}" class="glyphicon glyphicon-remove groupe" aria-hidden="true"></span></a></li>
		  	    <li style="margin-right:8px"><a href="{{ route('groupe.edit',[$groupe->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
	 		</ul> 
	  	</td>
	  	<td class="hide" ></td>
	</tr>
	
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
	        <h4 class="modal-title" id="myModalLabel">Suppression de groupe</h4>
	      </div>
	      <div class="modal-body">
	        Voulez-vous vraimment supprimer le groupe <strong><span class="nom-remove"></span> </strong> ?
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



