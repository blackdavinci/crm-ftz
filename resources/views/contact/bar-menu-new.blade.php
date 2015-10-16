@section('menu')
	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<form class="navbar-form navbar-left" style="padding-left:0px;" >
			    <a class="btn btn-default btn-smenu-position" href="{{ action('ContactController@index')}}" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
				</a>
			  <div class="btn-group ">
			  <button type="button" class="btn btn-success btn-smenu-position dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Enregistrer <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu " role="menu">
				<li><a href="#">Enregistrer + Ajouter un autre</a></li>
			  </ul>
			</div>
		</form>	
	</div>
@stop