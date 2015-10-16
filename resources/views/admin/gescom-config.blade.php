
@section('menu')
	<div class="masthead">
		
		<div class="pull-right" style="margin:4px;">

			@if(empty($detail->id))
			 <a class="btn btn-primary btn-smenu-position" href="{{ route('gescomconfig.create')}}"  role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Nouvelles données
			</a>
			@endif
			@if(!empty($detail->id))
		    <a class="btn btn-warning btn-smenu-position" @if(!empty($detail->id))href="{{ route('gescomconfig.edit',[$detail->id])}}" @endif role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
			</a>
	
			<!-- Button de Suppression modal -->
			<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
			</button>
			@endif
			<!-- Modal de confirmation de suppression -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer ces données sur la société @if(!empty($detail->nom))<strong>{{ $detail->nom }}</strong> ? @endif
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
			        @if(!empty($detail->id))
				        {!! Form::open(['url'=> route('gescomconfig.destroy',[$detail->id]), 'method'=>'delete']) !!}
				      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
				      	{!! Form::close() !!}
				    @endif
			      	</div>

			      </div>
			    </div>
			  </div>
			</div>
			 
		</div>
	</div>
@stop

@if(!empty($detail->id))
<div class="row">
	<div class="col-md-12">
		<table class="table table-user table-noborder-top">
			<tr>
				<th>Devise</th>
				<td>{{ $detail->devise }}</td>
			</tr>
			<tr>
				<th>Numéro de Compte bancaire</th>
				<td>{{ $detail->bank_account }}</td>
			</tr>
			<tr>
				<th>Code Swift</th>
				<td>{{ $detail->code_swift }}</td>
			</tr>
			<tr>
				<th>Société Bancaire</th>
				<td>{{ $detail->bank_society }}</td>
			</tr>
			<tr>
				<th>Code Agence</th>
				<td>{{ $detail->codeagencebank }}</td>
			</tr>

			<tr>
				<th>IBAN</th>
				<td>{{ $detail->iban_bank }}</td>
			</tr>
			<tr>
				<th>Adresse de la société bancaire</th>
				<td>{{ $detail->adressebank }}</td>
			</tr>
			<tr>
				<th>Prefixe sur document</th>
				<td>{{ $detail->prefix_id }}</td>
			</tr>
			<tr>
				<th>Taxe de vente</th>
				<td>{{ $detail->taxe_vente }}</td>
			</tr>
			<tr>
				<th>Taux ANPME</th>
				<td>{{ $detail->taux_anpme }}</td>
			</tr>
			<tr>
				<th>Taux de remise</th>
				<td>{{ $detail->taux_remise }}</td>
			</tr>
			<tr>
				<th>Référence société</th>
				<td>{{ $detail->ref_societe }}</td>
			</tr>
			
		</table>
	</div>
</div>
@else
	<div class="col-md-12"><h3 style="text-align: center; color:#ddd">Aucune configuration faite. Veuillez entrer de nouvelles données de gestion commerciale</h3></div>
@endif
