{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']) /*--}}
@section('top-nav')
<nav class="navbar navbar-default navbar-fixed-top navbar-height">
      <div class="container-fluid" id="navigation-one">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a class="navbar-brand" href="#">
			<img alt="Brand" src="{{$WEBROOT}}/img/logo.png" id="logo">
		  </a>
          <a class="navbar-brand" href="#" id="project-name">QuickGest</a>
        </div>

       <div class="col-lg-8 left-btn-search" style="margin-left: 9px">
       	<div class="input-group">
       	    <input type="text" class="form-control" placeholder="Search for...">
       		    <span class="input-group-btn">
       		        <button class="btn btn-default" type="button" style="margin-top: 4px"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
       		    </span>
       	</div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
        
        <div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav navbar-left visible-xs">
			<li class="dropdown-header">Menu</li>
			<li><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Accueil</a></li>
			<li><a href="#contact" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Annuaire</a> </li>
			<li><a href="#note" data-toggle="tab"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Notes</a></li>
			<li><a href="#agenda" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Agenda</a></li>
			<li><a href="#gescom" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Gestion commerciale</a></li>
			<li><a href="#rapport" data-toggle="tab"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Rapports</a> </li>
		  </ul>
		
          <ul class="nav navbar-nav navbar-right">
			<li class="nav-divider "></li>
			<li class="dropdown-header visible-xs">Paramètre & Autres</li>
            <li><a href="{{route('agenda.calendrier-perso',[Auth::user()->id])}}"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
            <li><a href="../navbar-static-top/"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span></a></li>
			<li class="dropdown">	
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="avatar">
					<!-- <span class="glyphicon glyphicon-user" aria-hidden="true"></span> -->
					<img class="img-circle "alt="profil image" @if(empty(Auth::user()->photo)) src="{{$WEBROOT}}/img/user.png" @else src="{{$WEBROOT}}/img/uploads/{{Auth::user()->photo}}" @endif>
					<span class="caret"></span>
				</a> 
				<ul class="dropdown-menu" role="menu">
					@if (Auth::user())
						<li><a href="{{route('users.show',[Auth::user()->id])}}" >{{ Auth::user()->name.' '.Auth::user()->prenom}}</a></li>
					@endif
					<li class="dropdown-header">Administration</li>
					<li><a href="{{ route('users.show',[Auth::user()->id]) }}">Gestion utilisateurs</a></li>
					@if (Auth::user()->role == 'admin')
					<li><a href="{{ route('parametres.index') }}">Paramètres</a></li>
					@endif
					<li class="nav-divider "></li>
					<li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>  Déconnexion</a></li>
				</ul>
            </li>
			
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
@stop