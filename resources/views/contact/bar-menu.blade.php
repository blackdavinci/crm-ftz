
@section('menu')

	     <div class="row">
	     {!! Form::open(['route'=>'annuaire.search', 'method'=>'GET']) !!}
		  <div class="col-lg-4 left-btn-search">
		      <div class="input-group" id="the-basics">
		        <input type="text" name="q"  class="form-control" value="{{ old('q') }}" placeholder="Recherche de contact...">
		        <span class="input-group-btn">
		          <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
		        </span>
		      </div><!-- /input-group -->
		    </div><!-- /.col-lg-6 -->
		 {!! Form::close(); !!}
		
	<div class="col-md-8 col-md-offset- right-btn-filter" >
	<div id="navbar-action" class="navbar-collapse collapse navbar-right" >

	{!! Form::open(['route'=>'societe.action', 'method'=>'POST']) !!}
	<!-- Boutton d'action sur contact choisi  -->
		{!! Form::hidden('type',$type) !!}
		
			{!! Form::submit('Exporter',['class' =>'btn btn-default checkaction', 'name'=>'export']) !!}
		
			{!! Form::submit('Supprimer',['class' =>'btn btn-danger checkaction', 'name'=>'supp']) !!}

			<!-- <div class="btn-group checkaction" role="group" aria-label="..." style="float:left">
			  <button type="submit" class="btn btn-default" name="csv" value="csv">CSV</button>
			  <button type="submit" class="btn btn-default" name="pdf" value="pdt">PDF</button>
			  <button type="submit" class="btn btn-default" name="xls" value="xls">XLS</button>
			</div>
	 -->
		<!--  Fin boutton d'action -->

		<!-- Button de Recherche -->
		<button type="button" class="btn btn-warning btn-smenu-position" data-toggle="modal" data-target="#myModalSearch">
		  <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Recherche
		</button>
		<!-- Masque Menu de Tri Ancienne Version
		  <div class="btn-group ">
			  <button type="button" class="btn btn-default btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Tier par <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li>
			  		@if(isset($societe))<a href="{{ route('societe.TriSociete',['notes'])}}"> 
			  		@elseif(isset($groupe) && isset($societegr)) <a href="{{ route('groupe.Trigroupe',['notes',$groupe->id])}}">
			  		@else <a href="{{ route('contact.TriContact',['notes'])}}">
			  		@endif Contact sans notes</a>
			  	</li>
			  	<li>
			  	 	@if(isset($societe))<a href="{{ route('societe.TriSociete',['ajout'])}}"> 
			  	 	@elseif(isset($groupe) && isset($societegr)) <a href="{{ route('groupe.Trigroupe',['ajout',$groupe->id])}}">
			  		@else <a href="{{ route('contact.TriContact',['ajout'])}}">
			  		@endif Date d'ajout</a>
			  	</li>
				<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['modification'])}}"> 
					@elseif(isset($groupe) && isset($societegr)) <a href="{{ route('groupe.Trigroupe',['modification',$groupe->id])}}">
			  		@else <a href="{{ route('contact.TriContact',['modification'])}}">
			  		@endif Date de modification</a>
				</li>
			  	
				<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['alpha'])}}"> 
					@elseif(isset($groupe) && isset($societegr)) <a href="{{ route('groupe.Trigroupe',['alpha',$groupe->id])}}">
			  		@else <a href="{{ route('contact.TriContact',['alpha'])}}">
			  		@endif Ordre Alphabétique Z- A</a>
				</li>
				<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['pays'])}}"> 
					@elseif(isset($groupe) && isset($societegr)) <a href="{{ route('groupe.Trigroupe',['pays',$groupe->id])}}">
			  		@else <a href="{{ route('contact.TriContact',['pays'])}}">
			  		@endif Pays</a>
			  	</li>
			  	<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['client'])}}"> 
					@elseif(isset($groupe) && isset($societegr)) <a href="{{ route('groupe.Trigroupe',['client',$groupe->id])}}">
			  		@else <a href="{{ route('contact.TriContact',['client'])}}">
			  		@endif Catégorie</a>
			  	</li>
			  </ul>
		</div>
		-->
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Afficher <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li><a href="{{ route ('societe.index') }}">Société(s)</a></li>
				<li><a href="{{ route('contact.index') }}">Contact(s)</a></li>
			  </ul>
		</div>
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Créer <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li><a href="{{ route('creer.societe')}}">Société</a></li>
				<li><a href="{{ route('contact.create')}}">Contact</a></li>
			  </ul>
		</div>
	    <!-- <a class="btn btn-primary btn-smenu-position" href="{{ route('societe.create')}}" role="button">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Nouveau contact
		</a> -->
		
	</div>
	</div>
	</div><!-- /.row -->

	

@stop