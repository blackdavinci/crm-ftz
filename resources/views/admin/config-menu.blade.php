<div class="col-md-3 btn-left-nav" >
	<ul class="list-group">
	  <li class="list-group-item" style="background: #f5f5f5; text-align: center;"><strong>Menu</strong></li>
	 	@if($actif=="profil") 
	 		{{--*/ $profil = 'active' /*--}} 
	 	@elseif($actif=="preference")
	 		{{--*/ $preference = 'active' /*--}} 
	 	@elseif($actif=="gescom")
	 		{{--*/ $gescom = 'active' /*--}} 
	 	@elseif($actif=="setpass")
	 		{{--*/ $setpass = 'active' /*--}} 
	 	@endif
	  <li class='list-group-item active-men @if(isset($profil)) {{ $profil }} @endif' >
	  	<a href="{{route('societedata.index')}}" id="list-user">
	  		Société<span class="glyphicon glyphicon-chevron-right "></span>
	  	</a>
	  </li>
	  
	 <!--  <li  class='list-group-item @if(isset($preference)) {{ $preference }} @endif' >
	  	<a href="{{route('preference.index')}}" id="profil-user">
	  		Préférences<span class="glyphicon glyphicon-chevron-right "></span>
	  	</a>
	  </li>
 -->	  
	  <li  class='list-group-item @if(isset($gescom)) {{ $gescom }} @endif' >
	  	<a href="{{route('gescomconfig.index')}}" id="new-user">
	  		Gestion Commerciale<span class="glyphicon glyphicon-chevron-right "></span>
	  	</a>
	  </li> 
	</ul>
</div>

