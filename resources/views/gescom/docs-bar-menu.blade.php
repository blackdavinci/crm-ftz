
@section('menu')

	     <div class="row">
	     {!! Form::open(['route'=>'annuaire.search', 'method'=>'GET']) !!}
		  <div class="col-lg-4 left-btn-search">
		      <div class="input-group">
		        <input type="text" name="q" class="form-control" placeholder="Search for...">
		        <span class="input-group-btn">
		          <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
		        </span>
		      </div><!-- /input-group -->
		    </div><!-- /.col-lg-6 -->
		 {!! Form::close(); !!}
		
	<div class="col-md-7 col-md-offset-1 right-btn-filter" >
	<div id="navbar-action" class="navbar-collapse collapse navbar-right" >

	{!! Form::open(['route'=>'societe.action', 'method'=>'POST']) !!}
	<!-- Boutton d'action sur contact choisi  -->
		{!! Form::hidden('type',$type) !!}
		{!! Form::submit('Ajouter note',['class' =>'btn btn-default checkaction', 'name'=>'add_note']) !!}
		<!-- <a class="btn btn-default btn-smenu-position checkaction" href="#" id="addnote" title="Liste" role="button">
			<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Ajouter note
		</a> -->
			{!! Form::submit('Exporter',['class' =>'btn btn-default checkaction', 'name'=>'export']) !!}
		<!-- <a class="btn btn-default btn-smenu-position checkaction" href="#" id="export" title="Liste" role="button">
			<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Exporter
		</a> -->
			{!! Form::submit('Supprimer',['class' =>'btn btn-danger checkaction', 'name'=>'supp']) !!}
		<!-- <a class="btn btn-danger btn-smenu-position checkaction" id="supp" href="#" title="Grille" role="button">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
		</a> -->
		<!--  Fin boutton d'action -->
		  <div class="btn-group ">
			  <button type="button" class="btn btn-default btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Tier par <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li>
			  		@if(isset($societe))<a href="{{ route('societe.TriSociete',['notes'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['notes'])}}">
			  		@endif Contact sans notes</a>
			  	</li>
			  	<li>
			  	 	@if(isset($societe))<a href="{{ route('societe.TriSociete',['ajout'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['ajout'])}}">
			  		@endif Date d'ajout</a>
			  	</li>
				<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['modification'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['modification'])}}">
			  		@endif Date de modification</a>
				</li>
			  	<li>
			  		@if(isset($societe))<a href="{{ route('societe.TriSociete',['groupe'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['groupe'])}}">
			  		@endif Groupe CRM</a>
			  	</li>
				<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['alpha'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['alpha'])}}">
			  		@endif Ordre Alphabétique Z- A</a>
				</li>
				<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['pays'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['pays'])}}">
			  		@endif Pays</a>
			  	</li>
			  	<li>
					@if(isset($societe))<a href="{{ route('societe.TriSociete',['client'])}}"> 
			  		@else <a href="{{ route('contact.TriContact',['client'])}}">
			  		@endif Catégorie</a>
			  	</li>
			  </ul>
		</div>
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Afficher <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li><a href="{{ route ('devis.index') }}">Devis</a></li>
			  	<li><a href="{{ route('livraison.index') }}">Bon de livraison</a></li>
			  	<li><a href="{{ route('commande.index') }}">Bon de commande</a></li>
				<li><a href="{{ route('facture.index') }}">Facture</a></li>
			  </ul>
		</div>
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Créer <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
				<li><a href="{{ route ('devis.creer') }}">Devis</a></li>
			  	<li><a href="{{ route('livraison.create') }}">Bon de livraison</a></li>
			  	<li><a href="{{ route('commande.create') }}">Bon de commande</a></li>
				<li><a href="{{ route('facture.create') }}">Facture</a></li>
			  </ul>
		</div>
	    <!-- <a class="btn btn-primary btn-smenu-position" href="{{ route('societe.create')}}" role="button">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Nouveau contact
		</a> -->
		
	</div>
	</div>
	</div><!-- /.row -->

@stop