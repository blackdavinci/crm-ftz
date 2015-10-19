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
		</tr>
	</table>

	<table class="table table-noborder-top table-bordere table-contact">

	@foreach($societe as $societev)

<!-- Condition pour les tris  -->
	<!-- Tri par date d'ajout -->
	@if( $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($societev->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($societev->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($societev->created_at)) &&  $marquer == 0)
			{{--*/ $date = $societev->created_at /*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri date modification -->
	@elseif( $tri == 'modif')
		@if($today != date('Y-m-d', strtotime($societev->updated_at)))
			{{--*/ $today = date('Y-m-d', strtotime($societev->updated_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($societev->updated_at)) &&  $marquer == 0)
			{{--*/ $date = $societev->updated_at /*--}}
			<tr class="active">
				<td colspan="6"><h4 class="letter">{!! $date !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par notes, ordre alphabétique et normal  -->
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($societev->nom_clt,0,1)))
			{{--*/ $letter = substr($societev->nom_clt,0,1); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($societev->nom_clt,0,1)) &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		<!-- Tri par groupe -->
	@elseif($tri == 'groupe')
		
		@if($letter != $societev->nom_groupe.' '.$societev->date_groupe)
			{{--*/ 
				$letter = $societev->nom_groupe.' '.$societev->date_groupe; $marquer = 0;
				$ancre = ucfirst(substr($letter,0,1));
			 /*--}}
			
		@endif
		@if($letter == $societev->nom_groupe.' '.$societev->date_groupe &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $ancre}}" >{!! $letter !!}</h4></td>
			</tr>
			<!-- /***************************************************************/ -->
				
					
			<!-- /***************************************************************/ -->
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($societev->groupe_id==0 && $none == 0 )
			<tr class="active">
				<td colspan="6" style="padding-top:0px;"><h4  class="letter">Aucun Groupe</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@endif
	<!-- Tri par pays  -->
	@elseif($tri == 'pays' )
		@if($letter != $societev->pays_clt)
			{{--*/ $letter = $societev->pays_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			
		@endif
		@if($letter == $societev->pays_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($letter == null && $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" style="margin-top:-15px" >Aucun pays attribué</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	<!-- Tri par ville  -->
	@elseif($tri == 'ville' )
		
		@if($letter != $societev->ville_siege_clt)
			{{--*/ $letter = $societev->ville_siege_clt; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
		@endif
		@if($letter == $societev->ville_siege_clt &&  $marquer == 0)
			<tr class="active">
				<td colspan="6"><h4 class="letter" id="{{ $idletter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($letter == null )
			@if($cnull ==0)
				{{--*/ $letter = 'Aucune ville attribuée'; $marquer = 0; $idletter = substr($letter,0,1); /*--}}
			@endif
			@if($letter == null &&  $marquer == 0)
				<tr class="active">
					<td colspan="6"><h4 class="letter" >{{ $letter }}</h4></td>
				</tr>
			@endif
			{{--*/ $marquer = 1; $cnull =1; /*--}}
		@endif
	<!-- Tri par prospect client -->
	@elseif($tri == 'client')
		
		@if($societev->statut==0 && $none == 0 )
			<tr class="active">
				<td colspan="6"><h4 class="letter" >{{ 'Prospect' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@elseif($societev->statut==1 && $clt==0)
			<tr class="active">
				<td colspan="6"><h4 class="letter">{{ 'Client' }}</h4></td>
			</tr>
			{{--*/ $clt = 1; /*--}}
		@elseif($societev->statut==2 && $pr==0)
			<tr class="active">
				<td  colspan="6"><h4 class="letter">{{ 'Prospect refusé' }}</h4></td>
			</tr>
			{{--*/ $pr = 1; /*--}}
		@endif
	@endif
	<!-- Fin condition de tri -->
	<tr style="border-bottom: 1px solid #ddd"> 
		<td vertical-align="middle">{!! Form::checkbox('c'.$c, $societev->id, null, ['class' => 'listcheckbox checkbox']) !!}</td>
	  	<td><a href="{{route('societe.show',[$societev->id])}}"><p class="media-heading">{{ $societev->nom_clt}}</p></a></td>
	  	<td><p>{{ $societev->pays_clt }} @if($societev->ville_siege_clt){{'('.$societev->ville_siege_clt.')' }} @endif</p></td>
	  	<td>@if($societev->tel_siege_clt)<p>{{ 'Tél : '.$societev->tel_siege_clt }} </p>@endif</td>
	  	<td>
	  		
	  			@if($tri =='none' && $societev->statut=='0')
	  		    	<h4 class=" statut-contact"><span class="label label-primary">Prospect</span></h4> 
	  		    @elseif($tri=='none' && $societev->statut == '2')
	  		    	<h4 class=" statut-contact"><span class="label label-default">Prospect</span></h4> 
	  		    @endif
	  		
	  	</td>	
	  	<td>
	  		<ul>
		  	    <li style="margin-bottom: 12px"><a href="{{ route('societe.edit',[$societev->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
		  		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
	 		</ul> 
	  	</td>
	</tr>
	<!-- Attribution des valeurs de données Nom et Id pour le modal -->
	
	{{--*/
		 $id = $societev->id; 
		 $nom = $societev->nom_clt; 
	/*--}}
	
	{{--*/ $c++ /*--}}
	@endforeach
	</table>


{!! Form::close() !!}

@if(isset($query))
	Mode Recherche
	{!! Form::open(['url' => route('annuaire.searchsociete'), 'method'=>'GET', 'id'=>'searchrequest']) !!}
		{!! Form::hidden($mode,$query)!!}
	{!! Form::close() !!}
	<div id="searchdata" class="$query" alt="{{$mode}}"></div>
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


