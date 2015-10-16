 <!-- Ligne d'information sur la société et le devis -->
	  <div class="row">
	      <div class="col-md-3" >
	        <div class="col-md-12"> <img   src="{{ $WEBROOT }}img/uploads/{{$profil->societedata->logo}}" alt="logo FTZ"> </div> 
	      
	        <div class="col-md-12" id="company-address" style="margin-top:19px">
	          <h5>
	          	<strong>
		          	{{ $profil->societedata->nom }} 
		          	<br/> {{ $profil->societedata->adresse }}
		          	<br/>{{ $profil->societedata->ville }}
		          	<br/>{{ $profil->societedata->pays }} 
		          	<br/>Tel : {{ $profil->societedata->tel }}
		          	<br/>E-mail : {{ $profil->societedata->email }}
		          	<br/>URL : {{ $profil->societedata->url }}
	          	</strong>
	          </h5>
	        </div>
	      </div>
	      <div class="col-md-4 pull-right">
	        <div class="col-md-12"> 
		        <div class=" cadre-info panel-default">
		            <div class="panel-body ">
		               <h4>DEVIS OU PROFORMAS</h4>
		            	<h4 class="num-devis"> {{ $profil->num_devis }}</h4>
		            </div>
		        </div>  
	        </div>
	        <div class="col-md-12" > 
	           <h5>
			        <strong>
				       	{{ $profil->nom_scliente}} 
				       	<br/> {{ $profil->adresse_scliente }}
				       	<br/>{{ $profil->ville_clt }}
				        <br/>{{ $profil->pays_clt}} 
				        <br/>Tel : {{ $profil->tel_clt }}
				        <br/>E-mail : {{ $profil->email_clt }}
				        <br/>URL : {{ $profil->societedata->url_clt }}
			        </strong>
	          	</h5> 
	        </div>
	      </div>
	  </div>

	  <div class="row">
        <div class="col-md-4">
          <div class=" cadre-info panel-default">
          <div class="panel-body ">
           <h5>
           		<strong>
		           		N°{{$profil->num_devis_int}}
		           	<br/>DATE DEVIS : {{ $profil->created_at->format('d/m/Y')}}
		           	<br/>SUIVI PAR : {{ $profil->suivi_devis }}
	           	</strong>
           </h5>
          </div>
        </div>  
      </div>  
      <div class="col-md-5 pull-right">
        <div class=" cadre-info panel-default">
          <div class="panel-body ">
          	<h5>
          		<strong>
		          	REF. CLIENT : {{ $profil->nom_scliente }}
		           <br/>N° DEVIS : {{$profil->num_devis_ext}} 
		           <br/>A L'ATTENTION DE : {{$profil->nom_scontact}}
          		</strong>
          	</h5>
          </div>
         </div> 
        </div>
      </div>

       <div class="row">
        <div class="col-md-12" id="msg-offre">
          <p id="genre-contact">{{ $profil->civilite_contact }},</p>
          <p>
              Suite à votre demande, veuillez trouver notre offre commerciale pour l'acquisition d'une licence {{ $profil->produit}}
          </p>
          <p>Veuillez recevoir mes sincères salutions.</p>
          <p></p>
        </div>
      </div>
      <div class="row">
      	<div class="col-md-12">
      	{{--*/ $v = 0; $d = 0 /*--}}
      		@foreach($profil->modules as $modules)
      			@if($modules->type_module=="Base")
      				@if($v==0)
	      				<h4>Devis concernant le produit suivant : {{ $profil->produit }}</h4>
	      				{{--*/ $v++ /*--}}
      				@endif
      			@endif
      		@endforeach
      		
      		@foreach($profil->modules as $modules)
      			@if($modules->type_module!="Base")
      				@if($d==0)
	      				<h4>Devis concernant :<br/></h4>
	      				{{--*/ $d++ /*--}}
      				@endif
      				<h4 style="text-align: center">{{ $modules->nom_module }}</h4>
      			@endif
      		@endforeach
      		
      		<h3 style="text-align: center">
      			
      		</h3>
      	</div>
      </div>