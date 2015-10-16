
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Il y a quelques problèmes avec les champs suivants.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

						<form class="form-horizontal" role="form" method="POST" action="{{ route('gescomconfig.store') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<!-- Information de base sur la société -->
					
						

						  <div class="form-group">
						  	<label class="col-md-4 control-label">Devise</label>
						  	<div class="col-md-6">
						  		<input type="text" class="form-control" name="devise" value="{{ old('devise') }}" placeholder="Devise monétaire de la société">
						  	</div>
						  </div>

						  <div class="form-group">
						  	<label class="col-md-4 control-label">N° Compte Bancaire</label>
						  	<div class="col-md-6">
								<input type="text" class="form-control" name="bank_account" value="{{ old('bank_account') }}">
						  	</div>
						  </div>

						  <div class="form-group">
						  	<label class="col-md-4 control-label">Code Swift</label>
						  	<div class="col-md-6">
								<input type="text" class="form-control" name="code_swift" value="{{ old('code_swift') }}" placeholder="Référence de la société">
						  	</div>
						  </div>

						  <div class="form-group">
						  	<label class="col-md-4 control-label">Société Bancaire</label>
						  	<div class="col-md-6">
							  <input type="text" class="form-control" name="bank_society" value="{{ old('bank_society') }}" placeholder="Nom de la société bancaire">
						  	</div>
						  </div>
						  
						  <div class="form-group">
						  	<label class="col-md-4 control-label">Taxe de vente</label>
						  	<div class="col-md-6">
						   		 <input type="number" class="form-control" name="taxe_vente" value="{{ old('taxe_vente') }}" placeholder="Taxe de vente de la société">
						  	</div>
						  </div>

						  <div class="form-group">
						  	<label class="col-md-4 control-label">Taux ANPME</label>
						  	<div class="col-md-6">
						   		 <input type="number" class="form-control" name="taux_anpme" value="{{ old('taux_anpme') }}" placeholder="Taux de l'ANPME">
						  	</div>
						  </div>

						    <div class="form-group">
						    	<label class="col-md-4 control-label">Prefixe d'identification sur document</label>
						    	<div class="col-md-6">
						  		<input type="text" class="form-control" name="prefix_id" value="{{ old('prefix_id') }}" placeholder="Ex : (Meryem El Bazini) ELB">
						    	</div>
						    </div>

						  <div class="form-group">
						  	<label class="col-md-4 control-label">Référence Société </label>
						  	<div class="col-md-6">
								<input type="text" class="form-control" name="ref_societe" value="{{ old('ref_societe') }}">
						  	</div>
						  </div>
						  

						  <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Enregistrer
								</button>
							</div>
						</div>
					</form>

@section('script')

$(document).ready(function(){
	
	$('#pays').select2();
	
});

@stop