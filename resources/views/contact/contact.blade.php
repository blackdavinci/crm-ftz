@extends('default')

@section('title','Annuaire')

@if($type==2)
	@section('title','Groupe CRM')
	@section('titre-entete','Groupe(s) CRM')
@elseif($type==3)
	@if(isset($groupe))
	@section('title','Contact Groupe CRM')
		@section('titre-entete','Contact du groupe CRM '.$groupe->nom_groupe.' '.$groupe->date_groupe.' ('.$groupe->type_groupe.')')
	@endif
@elseif(isset($tri) && $tri=='notes')
	@section('titre-entete','Tri Contact sans note ')
@elseif(isset($tri) && $tri=='societe')
	@section('titre-entete','Tri Contact par société ')
@elseif(isset($tri) && $tri=='ville')
	@section('titre-entete','Tri Contact par ville ')
@elseif(isset($tri) && $tri=='ajout')
	@section('titre-entete','Tri Contact par date d\'ajout ')
@elseif(isset($tri) && $tri=='modif')
	@section('titre-entete','Tri Contact par date de modification ')
@elseif(isset($tri) && $tri=='pays')
	@section('titre-entete','Tri Contact par pays')
@elseif(isset($tri) && $tri=='client')
	@section('titre-entete','Tri Contact par catégorie de client ')
@elseif(isset($tri) && $tri=='alpha')
	@section('titre-entete','Tri Contact par ordre alphabétique')
@elseif(isset($type) && $type=='0')
	@section('titre-entete','Annuaire des Sociétés ')
@elseif(isset($type) && $type=='1')
	@section('titre-entete','Annuaire des Contacts ')
@endif

@include('default.top-nav')
@include('default.left-nav')

@include('contact.bar-menu')

@section('content')
<!-- Initialisation compteur pour checkbox, lettre et marque pour ancre de contact -->
{{--*/ 
	

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
	<div class="lettre-index col-md-" >
		@if($tri!='no-tri')
		<table class="table table-noborder-top  table-contact" id="contact-letter">
			<tr>
				<td>{!! Form::checkbox('seelectall', 'all' , null, ['class' => 'listcheckbox','id'=>'selectall']) !!}</td>
				<td>
					{{--*/ $x = 'A' /*--}}
					@for($i = 1; $i<= 26; $i++)
						<a class='alphabet 'href="#{{ $x }}">{{ $x }}</a>
						{{--*/ $x++; /*--}}
					@endfor
				</td>
			</tr>
		</table>
		@endif
	</div>
		
	@if($type==0)
		@include('contact.liste-societe-tri')
	@elseif($type==1)
		@include('contact.liste-contact')
	@elseif($type==2)
		@include('contact.list-groupe')
	@elseif($type==3)
		@include('contact.list-societe-crm')
	@elseif($type==4)
		@include('contact.annuairesearch')
	@endif
</div>
	<div class="col-md-3 content-sidebar" >
			<!-- GROUPE CRM  -->
			<div class="col-md-12">
				<p>Groupe CRM</p>
			</div>
			<div class="col-md-12">
				<a href="{{ route('groupe.create')}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nouveau Groupe CRM
				</a>
			</div>	
			<div class="col-md-12">
				<a href="{{ route('groupe.index')}}">
					<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Liste Groupe CRM
				</a>
			</div>		
			<!-- IMPORTATION / EXPORTATION -->
			<div class="col-md-12">
				<br/>
				<p>Importer / Exporter</p>
			</div>
			<div class="col-md-12">
				<a href="{{ route('import.index')}}">
					<span class="glyphicon glyphicon-open-file" aria-hidden="true"></span> Importer des contacts
				</a>
			</div>	
			<div class="col-md-12">
				<a href="{{ route('export.index')}}">
					<span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Exporter des contacts
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
<!-- Function pour la suppression direct -->
$('.glyphicon-remove').click(function(){
	var id = $(this).attr('id');
	var nom = $(this).attr('alt');
	$('.nom-remove').html(nom);

	if($(this).hasClass('societe')){
		$('.delete-form').attr('action','societe/'+id);
	}
	if($(this).hasClass('contact')){
		$('.delete-form').attr('action','contact/l'+id);
	}
	if($(this).hasClass('groupe')){
		$('.delete-form').attr('action','groupe/'+id);
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

    $('#nom').click(function(){
    	$(this).prop('readonly',false);
    	$('#tel').prop('readonly', true);
    	$('#ville').prop('readonly', true);
    	$('#pays').prop('readonly', true);
    	$('#adresse').prop('readonly', true);
    });
     $('#pays').click(function(){
    	$(this).prop('readonly',false);
    	$('#nom').prop('readonly', true);
    	$('#ville').prop('readonly', true);
    	$('#tel').prop('readonly', true);
    	$('#adresse').prop('readonly', true);
    });
     $('#ville').click(function(){
    	$(this).prop('readonly',false);
    	$('#tel').prop('readonly', true);
    	$('#nom').prop('readonly', true);
    	$('#pays').prop('readonly', true);
    	$('#adresse').prop('readonly', true);
    });
     $('#adresse').click(function(){
    	$(this).prop('readonly',false);
    	$('#tel').prop('readonly', true);
    	$('#ville').prop('readonly', true);
    	$('#pays').prop('readonly', true);
    	$('#nom').prop('readonly', true);
    });
    $('#tel').click(function(){
    	$(this).prop('readonly',false);
    	$('#nom').prop('readonly', true);
    	$('#ville').prop('readonly', true);
    	$('#pays').prop('readonly', true);
    	$('#adresse').prop('readonly', true);
    });

	
    $( ".sorting" ).children().click(function( event ) {
    	var link = $(this).attr('href');
    	var linkAll = link+'&query='+$('#searchdata').attr('class')+'&mode='+$('#searchdata').attr('alt')+'&data='+$('#searchdata').attr('align');
    	$(this).attr('href',linkAll);
    });

});

@stop




