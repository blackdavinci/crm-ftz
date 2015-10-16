<div class="col-md-3 btn-left-nav user-menu-left"  >
	<ul class="list-group">
	  <li class="list-group-item" style="background: #f5f5f5; text-align: center;"><strong>Menu</strong></li>
	 	@if($actif=="liste") 
	 		{{--*/ $liste = 'active' /*--}} 
	 	@elseif($actif=="profil")
	 		{{--*/ $profil = 'active' /*--}} 
	 	@elseif($actif=="new")
	 		{{--*/ $new = 'active' /*--}} 
	 	@elseif($actif=="setpass")
	 		{{--*/ $setpass = 'active' /*--}} 
	 	@endif

	  <li  class='list-group-item @if(isset($profil)) {{ $profil }} @endif' >
	 	<a href="{{route('users.show',[Auth::user()->id])}}" id="profil-user">
	 		Mon profil<span class="glyphicon glyphicon-chevron-right "></span>
	 	</a>
	  </li>
	  @if (Auth::user()->role == 'admin')
	  <li class='list-group-item active-men @if(isset($liste)) {{ $liste }} @endif' >
	  	<a href="{{route('users.index')}}" id="list-user">
	  		Utilisateurs<span class="glyphicon glyphicon-chevron-right "></span>
	  	</a>
	  </li>
	  
	  
	  
	  <li  class='list-group-item @if(isset($new)) {{ $new }} @endif' >
	  	<a href="{{route('users.create')}}" id="new-user">
	  		Nouvel utilisateur<span class="glyphicon glyphicon-chevron-right "></span>
	  	</a>
	  </li> 
	  @endif
	  <li  class='list-group-item @if(isset($setpass)) {{ $setpass }} @endif}' >
	  	<a href="{{route('users.setpassword',[Auth::user()->id])}}" id="password-user">
	  		Changer mon mot de passe<span class="glyphicon glyphicon-chevron-right "></span>
	  	</a>
	  </li> 
	</ul>
</div>

