@extends('default')

@if($type==0)
	@section('title','Devis')
	@section('titre-entete','Devis')
@elseif($type==1)
	@section('title','Bons de livraisoin')
	@section('titre-entete','Bons de livraisons')
@elseif($type==2)
	@section('title','Factures')
	@section('titre-entete','Factures')
@else
	@section('title','Recherche')
	@section('titre-entete','Recherche')
@endif

@include('default.top-nav')
@include('default.left-nav')

@include('gescom.docs-bar-menu')

@section('content')
<!-- Initialisation compteur pour checkbox, lettre et marque pour ancre de contact -->
{{--*/ 
	$formatter = new IntlDateFormatter('fr_FR',IntlDateFormatter::LONG,
	                IntlDateFormatter::NONE,
	                'Europe/Paris',
	                IntlDateFormatter::GREGORIAN );
	$c = 1;
	$letter = 'A'; 
	$marquer = 0; 
	$none = 0;
	$noneg = 0;
	$clt = 0;
	$pr = 0;
	$today = date("Y-m-d"); 

/*--}}

<div class="col-md-9  affichage-border test">
	
		
	@if($type==0 && !isset($results))
		@include('gescom.liste-devis')
	@elseif($type==1 && !isset($results))
		@include('gescom.liste-livraisons')
	@elseif($type==2 && !isset($results))
		@include('gescom.liste-factures')
	@else(isset($results))
		@include('contact.contact-research')
	@endif
</div>
	<div class="col-md-3 content-sidebar" >
			<!-- GROUPE CRM  -->
			<div class="col-md-12">
				<p>Produit(s) / Module(s)</p>
			</div>
			<div class="col-md-12">
				<a href="{{ route('produit.create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nouveau Produit
				</a>
			</div>
			<div class="col-md-12">
				<a href="{{ route('module.create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nouveau module
				</a>
			</div>
			<div class="col-md-12">
				<a href="{{ route('produit.index')}}">
					<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Liste Produits
				</a>
			</div>		
			<!-- IMPORTATION / EXPORTATION -->
			<div class="col-md-12">
				<br/>
				<p>Importer / Exporter</p>
			</div>
			<div class="col-md-12">
				<a href="{{ route('import.index')}}">
					<span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> Importer
				</a>
			</div>	
			<div class="col-md-12">
				<a href="{{ route('export.index')}}">
					<span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Exporter
				</a>
			</div>											
	</div>

@stop


@section('script')

jQuery(function($){
	<!-- Positoin top des ancres -->
	$('.alphabet').click(function(){
		$lettre =  '#'+$(this).attr('href').replace('#','');
		
	});
	<!-- Count the number of checkbox -->
		 $c = 0;
		<!--  SELECT AND DESELECT ALL CHECKBOX -->
        $('#selectall').click(function(event) {  //on click 
            if(this.checked) { // check select status
                $('.checkbox').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"  
                    $c++;       
                });
            }else{
                $('.checkbox').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1" 
                    $c--;  
                                      
                });         
            }
        });

   	<!-- Function pour affichage des actions sur les selects -->
  
	$('input[type="checkbox"]').click(function(){
		 if(this.checked == true){
            $(".checkaction").show();
            $c++;
        }
        else{
        	$c--;
        	if($c==0 ){
        		$(".checkaction").hide();
        	}

        }
    }); 
   
   
});

@stop




