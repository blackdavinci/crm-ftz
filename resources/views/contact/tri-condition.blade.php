<!-- Condition pour les tris  -->
	@if($tri == 'modif' || $tri == 'ajout')
		@if($today != date('Y-m-d', strtotime($societe->created_at)))
			{{--*/ $today = date('Y-m-d', strtotime($societe->created_at)); $marquer = 0; /*--}}
		@endif
		@if($today == date('Y-m-d', strtotime($societe->created_at)) &&  $marquer == 0)
			{{--*/ $date = $formatter->format(strtotime($societe->created_at)) /*--}}
			<tr>
				<td colspan="3"><h3>{!! $date !!}</h3></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	@elseif($tri == 'notes' || $tri == 'alpha' || $tri == 'none')
		@if($letter != ucfirst(substr($societe->nom_clt,0,1)))
			{{--*/ $letter = ucfirst(substr($societe->nom_clt,0,1)); $marquer = 0; /*--}}
			
		@endif
		@if($letter == ucfirst(substr($societe->nom_clt,0,1)) &&  $marquer == 0)
			<tr>
				<td class="letter" colspan="3"><h3 id="{{ $letter }}" >{!! $letter !!}</h3></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
	@elseif($tri == 'groupe')
		@if($letter != $societe->nom_groupe.' '.$societe->date_groupe)
			{{--*/ $letter = $societe->nom_groupe.' '.$societe->date_groupe; $marquer = 0; /*--}}
			
		@endif
		@if($letter == $societe->nom_groupe.' '.$societe->date_groupe &&  $marquer == 0)
			<tr>
				<td class="letter" colspan="3"><h4 id="{{ $letter }}" >{!! $letter !!}</h4></td>
			</tr>
			{{--*/ $marquer = 1; /*--}}
		@endif
		@if($societe->groupe_id==0 && $none == 0 )
			<tr>
				<td class="letter" colspan="3"><h4>{{ 'Aucun Groupe' }}</h4></td>
			</tr>
			{{--*/ $none = 1; /*--}}
		@endif
	@endif
<!-- Fin condition de tri -->