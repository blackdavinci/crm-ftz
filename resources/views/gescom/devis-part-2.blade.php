 <!-- Partie 2 Devis -->

      <div class="row">
      	<div class="col-md-12">
      		<h4 style="text-align: center">Licence {{ $profil->produit }} </h4>
      	</div>
      </div>
      <div class="row">
      	<div class="col-md-12">
      		<table class="table table-bordered table-striped ">
      			<tr>
      				<th>Désignation</th> 
      				<th>Qte</th> 
      				<th>P.U en {{ $profil->gescom->devise}}</th>
      				<th>Total Remise en HT {{$profil->gescom->taux_remise}}</th>
      			</tr>
      			<tr>
      				<td>
      					<h4>Module de base {{$profil->produit}}</h4>
						@foreach($profil->modules as $modules)
							@if($modules->type_module=="Base")
								<strong>{{ $modules->nom_module }}</strong><br/>
							@endif
						@endforeach
      				</td>
      				<td>
      					<h4><br/></h4>
      					@foreach($profil->modules as $modules)
      						@if($modules->type_module=="Base")
      							<strong>{{ $modules->pivot->produit_quantite }}</strong><br/>
      						@endif
      					@endforeach
      				</td>
      				<td></td>
      				<td></td>
      			</tr>
	      		@foreach($profil->modules as $modules)
	      			@if($modules->type_module=="Simple")
		      			<tr>
		      				<td><strong>{{ $modules->nom_module }}</strong></td>
		      				<td>{{ $modules->pivot->produit_quantite }}</td>
		      				<td>{{ $modules->prix_module }}</td>
		      				<td>{{ $modules->pivot->produit_remise }}</td>
		      			</tr>
	      			@endif
	      		@endforeach

	      	</table>

	      	<table class="table table-striped pull-right">
  				<tr>
  					<th colspan="3" style="text-align:right">Total HT </th><td>{{ $profil->total_ht }}</td>
  				</tr>
  				<tr>
  					<th colspan="3" style="text-align:right">Total ANPME {{ $profil->gescom->taux_anpme }}% </th> <td>{{ $profil->total_anpme }}</td>
  				</tr>
  				<tr>
  					{{--*/ $part = 100 - $profil->gescom->taux_anpme /*--}}
  					<th colspan="3" style="text-align:right">Votre part {{ $part }}% </th> <td> {{ $profil->total_part }}</td>
  				</tr>
      		</table>
      	</div>
      </div>
	   