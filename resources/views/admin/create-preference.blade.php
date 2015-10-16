
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

						<form  role="form" method="POST" action="{{ route('societedata.store') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<!-- Information de base sur la société -->
						<div class="col-md-6">
						  <header class="head-title">
						    <h5><strong>Informations de base</strong></h5>
						    <div class="trait pull-left"></div>
						  </header>
						  <div class="form-group">
						      <div class="col-sm-12">
						        {!! Form::label('nom','Nom') !!}
								<input type="text" class="form-control" name="nom" value="{{ old('nom') }}" placeholder="Nom de votre société">
						      <div id="feedback"></div>
						    </div>
						  </div>

						  <div class="form-group">
						    <div class="col-sm-12">
						      {!! Form::label('num_rc','N° RC') !!}
						   		 <input type="text" class="form-control" name="num_rc" value="{{ old('num_rc') }}" placeholder="Numéro de registre de la société">
						    </div>
						  </div>

						  <div class="form-group">
						    <div class="col-sm-12">
						      {!! Form::label('bank_account','N° Compte bancaire') !!}
								<input type="text" class="form-control" name="bank_account" value="{{ old('bank_account') }}">
						    </div>
						  </div>

						  <div class="form-group">
						    <div class="col-sm-12">
						      {!! Form::label('code_swift','Code swift') !!}
								<input type="text" class="form-control" name="code_swift" value="{{ old('code_swift') }}" placeholder="Référence de la société">
						    </div>
						  </div>

						   <div class="form-group">
						    <div class="col-sm-12">
						      {!! Form::label('bank_society','Société bancaire') !!}
							  <input type="text" class="form-control" name="bank_society" value="{{ old('bank_society') }}" placeholder="Nom de la société bancaire">
						    </div>
						  </div>

						  <div class="form-group">
						      <div class="col-sm-12">
						        {!! Form::label('effectif','Effectif') !!}
								<input type="number" class="form-control" name="effectif" value="{{ old('effectif') }}" placeholder="Effectif de la société">
						    </div>
						  </div>
						  <div class="form-group">
						      <div class="col-sm-12">
						        {!! Form::label('ca','Chiffre d\'affaire') !!}
								<input type="number" class="form-control" name="ca" value="{{ old('ca') }}">
						    </div>
						  </div>


						   <div class="form-group">
						    <div class="col-sm-12">
						      {!! Form::label('ref_societe','Référence société') !!}
								<input type="text" class="form-control" name="ref_societe" value="{{ old('ref_societe') }}">
						    </div>
						  </div>
						  <div class="form-group">
						      <div class="col-sm-12">
						      {!! Form::label('ntva','N° TVA') !!}
								<input type="text" class="form-control" name="num_tva" value="{{ old('num_tva') }}" placeholder="Numéro de TVA de la société">
						    </div>
						  </div>
						  <div class="form-group">
						      <div class="col-sm-12">
						      {!! Form::label('num_fiscal','N° Fiscal') !!}
								<input type="text" class="form-control" name="num_fiscal" value="{{ old('num_fiscal') }}" placeholder="Numéro fiscal de la société">
						    </div>
						  </div>

						 

						  
						    
						</div>

						<!-- information Troisième Adresse-->
						    <div class="col-md-6">
						      <header class="head-title">
						        <h5><strong>Contact(s)</strong></h5>
						        <div class="trait pull-left"></div>
						      </header>
						      
						        <div class="form-group">
						            <div class="col-sm-12">
						            {!! Form::label('tel','Téléphone') !!}
									<input type="text" class="form-control" name="tel" value="{{ old('tel') }}" placeholder="Contact téléphonique de la société">
						          </div>
						        </div>
						        <div class="form-group">
						            <div class="col-sm-12">
						              {!! Form::label('fax','Fax') !!}
        							 <input type="text" class="form-control" name="fax" value="{{ old('fax') }}" placeholder="Contact téléphonique de la société">

						          </div>
						        </div>
						        <div class="form-group">
						            <div class="col-sm-12">
						            {!! Form::label('email','E-mail') !!}
						            {!! Form::input('email','email',null, ['class' =>'form-control input-sm', 'placeholder' =>'Adresse e-mail de la société']) !!}
						          </div>
						        </div>
						        <div class="form-group">
						            <div class="col-sm-12">
						            {!! Form::label('url','URL') !!}
									<input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="Adresse web de la société">
						          </div>
						        </div>
						        <div class="form-group">
						            <div class="col-sm-12">
						              <!-- Récupération du nom de tous les pays -->
						              {{--*/ $listpays = Countries::getList('fr','php','cldr') /*--}} 
						            @foreach($listpays as $cle=>$values)
						              {{--*/ $pays[$values]= $values /*--}}
						            @endforeach
						            {!! Form::label('pays','Pays') !!}
						            {!! Form::select('pays',$pays,'Maroc',['class' =>'form-control input-sm','id'=>'pays']) !!}
						          </div>
						        </div>

						        <div class="form-group">
						            <div class="col-sm-12">
						            {!! Form::label('ville','ville') !!}
									<input type="text" class="form-control" name="ville" value="{{ old('ville') }}" placeholder="Ville de la société">
						          </div>
						        </div>
						        <div class="form-group">
						            <div class="col-sm-12">
						            {!! Form::label('adresse','Adresse') !!}
						            {!! Form::textarea('adresse',null, ['class' =>'form-control input-sm', 'placeholder'=>'Adresse complète de la société','rows' => '7']) !!}
						          </div>
						        </div>

						        <div class="form-group">
						        	<div class="col-sm-12">
						        		<br/>
						        		{!! Form::submit('Enregistrer',['class' =>'btn btn-success'])!!}
						        		<a class="btn btn-danger btn-smenu-position ajout" id="grille" href="{{ route('societedata.index')}}" title="Grille" role="button">
						        			 Annuler
						        		</a>	
						        	</div>
						        </div>

						    </div>
					</form>

@section('script')

$(document).ready(function(){
	
	$('#pays').select2();
	
});

@stop