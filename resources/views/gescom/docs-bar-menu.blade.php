
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

	{!! Form::open(['route'=>'devis.action', 'method'=>'POST']) !!}
	<!-- Boutton d'action sur contact choisi  -->
		{!! Form::hidden('type',$type) !!}
		
			{!! Form::submit('Exporter',['class' =>'btn btn-default checkaction', 'name'=>'Imprimer']) !!}
		
			{!! Form::submit('Supprimer',['class' =>'btn btn-danger checkaction', 'name'=>'supp']) !!}

			<!-- <div class="btn-group checkaction" role="group" aria-label="..." style="float:left">
			  <button type="submit" class="btn btn-default" name="csv" value="csv">CSV</button>
			  <button type="submit" class="btn btn-default" name="pdf" value="pdt">PDF</button>
			  <button type="submit" class="btn btn-default" name="xls" value="xls">XLS</button>
			</div>
	 -->
		<!--  Fin boutton d'action -->
		<!--  Fin boutton d'action -->
		<div class="btn-group ">
			  <button type="button" class="btn btn-primary btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Afficher <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
			  	<li><a href="{{ route ('gescom.index') }}">Devis</a></li>
			  	<li><a href="{{ route('livraison.index') }}">Bon de livraison</a></li>
				<li><a href="{{ route('facture.index') }}">Facture</a></li>
			  </ul>
		</div>
	    <a class="btn btn-primary btn-smenu-position" href="{{ route('devis.creer')}}" role="button">
			<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Créer devis
		</a> 
		
	</div>
	</div>
	</div><!-- /.row -->

@stop