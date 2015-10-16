<!-- Affichage en Grille -->
	<table class="table table-noborder-top table-bordere table-contact">
	{{--*/ $i = 0 /*--}}

	@foreach($societe as $societeG)
		
	  @if($i==0)<tr> {{--*/ $i = 3/*--}}@endif
	  {{--*/ $i-=1 /*--}}
	  	<td class="media">
	  		<div class="media-left">
	  		  </div>
	  		  <div class="media-body">
	  		    <a href=""><p class="media-heading">{{ $societeG->nom_clt }}</p></a>
	  		    <p>{{ $societeG->pays_clt.' ('.$societeG->ville_siege_clt.')' }}</p>
	  		    <p>{{ 'Tél : '.$societeG->tel_siege_clt }} </p>
	  		  </div>
	  	</td>
	  	<td style=" vertical-align: middle;"><a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
	  	<td style=" vertical-align: middle;"><a href=""><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
	@if($i==0)</tr> @endif
	@endforeach
	</table>