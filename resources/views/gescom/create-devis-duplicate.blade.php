@extends('default')

@section('head')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}
@stop

@section('title','Création de devis')
@section('titre-entete','Nouveau devis')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')

{!! Form::open(['url' => route('devis.store'), 'method'=>'POST']) !!}

  <div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
    <div class="navbar-form navbar-left" style="padding-left:0px;" >
      <a class="btn btn-default btn-smenu-position" href="{{ route('devis.index')}}" role="button">
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Annuler
      </a>
      <div class="form-group">
          {!! Form::submit('Enregistrer + Créer bon de commnade ',[
            'name' => 'add_bc',
            'class' =>'btn btn-warning btn-smenu-position',
            ])
          !!}
      </div>
      <div class="form-group">
          {!! Form::submit('Enregistrer + Imprimer ',[
            'name' => 'print',
            'class' =>'btn btn-warning btn-smenu-position',
            ])
          !!}
      </div>
        <div class="form-group ">
        {!! Form::submit('Enregistrer',['class' =>'btn btn-success btn-smenu-position']) !!}
      </div>
    </div>  
  </div>


@stop

@section('content')
	<!-- Déclaration des variables -->

	{{--*/  $year = date('y'); $month = date('m'); $prefixe = "DV-Elect-"; $suffixe = 100; $date = date('d-m-y'); 

          $num_dev_int= $prefixe.$year.$month.$suffixe;
          $num_dev_ext = $year.$month.$suffixe
          
  /*--}}

<div class="panel panel-default">
  <div class="panel-heading">
   <a href="" id="prec"><span class="glyphicon glyphicon-chevron-left"></span> </a>
    <span ><strong style="text-align: center">Page 1 : Coordonnées</strong></span> 
   <a href="" id="suiv"><span  class="glyphicon glyphicon-chevron-right"></span></a> 
  </div>
  <div class="panel-body" >
    <div class="row">
        <div class="col-md-3" >
          <div class="col-md-12"> <img id="logo-devis"  src="{{ $WEBROOT }}img/favicon/ms-icon-70x70.png" alt="logo FTZ"> </div> 
          <hr/>
          <div class="col-md-12" id="company-address">
            <p>FTZ MAROC <br/>12 Bd BIRANZARANE <br/>MOHAMMEDIA <br/>MAROC <br/>Tél : 00212 6 14 32 73 25<p>
          </div>
        </div>
        <div class="col-md-4 pull-right">
          <div class="col-md-12"> 
          <div class=" cadre-info panel-default">
              <div class="panel-body ">
                 <h4>DEVIS OU PROFORMAS<br/>{{ $num_dev_int }}</h4>
              </div>
          </div>  
          </div>
          <div class="col-md-12">
            
            <h5></h5>
          </div>
        </div>
      </div>
  
    <div class="row">
      <div class="col-md-4 pull-right">
        <div class="form-group" id="societe_form">
          <div class="col-sm-12">
            {!! Form::label('societe','Société ') !!}
          
            <select id="societe_list" class="form-control input-sm" name="societe_id">
              <option value="None">-- Select --</option>
              @foreach($societe as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </select
          </div>
        </div>
      </div>

        <div class="col-md-12"> 
        <div class=" cadre-inf panel-default">
            <div class="panel-body " id="adressesociete">
              
            </div>
        </div>  
        </div>
        <div class="col-md-12">
          
          <h5></h5>
        </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-4">
          <div class=" cadre-info panel-default">
          <div class="panel-body ">
           <p>N° ELB/{{ $num_dev_int }}</p>
           <p>DATE DEVIS : {{ $date }}</p>
           <p>SUIVI PAR : Meryem ELBAZINI</p>
          </div>
        </div>  
      </div>  
      <div class="col-md-5 pull-right">
        <div class=" cadre-info panel-default">
          <div class="panel-body ">
           <p>REF. CLIENT : <span id="nomsociete"></span></p>
           <p>N° DEVIS : {{ $num_dev_ext }}</p>
           <p>A L'ATTENTION DE</p>
           <div class="form-group">
            <div class="col-sm-12" style="padding-left:0px;">
              {!! Form::select('contact_id',$contact,null,['class' =>'form-control input-sm','id'=>'contact_list']) !!}
            </div>
          </div>
          </div>
         </div> 
        </div>
      </div>

     <div class="row">
      <div class="col-md-12" id="msg-offre">
        <p id="genre-contact"></p>
        <p>
            Suite à votre demande, veuillez trouver notre offre commerciale pour l'acquisition d'une licence SchemElect Edition
            Entreprise.
        </p>
        <p>Vuillez recevoir mes sincères salutions.</p>
        <p></p>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <h4>Lignes de commandes</h4>
        <table class=" table table-striped table-article table-bordered">
          <tr id="titre-haut"><th>Article</th><th>Quantité</th><th>Prix Unitaire</th><th>Remise HT 25%</th><th>Total</th></tr>       
          <tr id="btn-ajout"><td colspan="6"><a href="" class="add_article">Ajouter un produit ou module</a></td></tr> 
        
        </table>
        <table class="table table-striped table-bordered">
          <tr><td colspan="4"> </td> <td>Total HT</td> <td></td></tr> 
          <tr><td colspan="4"> </td> <td><strong>Total ANPME 70%</strong></td> <td></td></tr> 
          <tr><td colspan="4"> </td> <td><strong>Votre Part 30%</strong></td> <td></td></tr> 
        </table>

      </div>
    </div>
		
 
  </div>
</div>

	{!! Form::close() !!}
	@include('errors.list')
@stop

@section('footer')

@stop

@section('script')
  	$(document).ready(function(){
			 
  		  $('#societe_list').select2({ placeholder: "Choisissez la société à lier" });

        $('#contact_list').select2({ placeholder: "Choisissez le contact à lier a state" });

        

        $('#msg-offre').hide();

          $("select[name='societe_id']").change(function(){
            var id = $(this).val();
            var data = { "id ": id };
             $.getJSON('SocieteSelect', { id : id }, function(data) {
                console.log(data);
                
                $('#nomsociete').html(data.nom_clt);
                $("#adressesociete").html(
                  "<h5>" + data.ville_siege_clt + "</h5><h5> " + data.pays_clt+ "</h5><h5>" + data.adresse_siege_clt + "</h5>"
                );
             });
          });
      
          $("select[name='contact_id']").change(function(){
            var id = $(this).val();
            var data = { "id ": id };
             $.getJSON('ContactSelect', { id : id }, function(data) {
                console.log(data);
                $('#genre-contact').html(data.genre_contact);
                $('#societe_list').val(data.societe_id).change();
                $('#msg-offre').show();
             });
          });

          $('#suiv').click(function(e){
              e.preventDefault();
              alert('Suivant');
          });
          <!-- Template d'une nouvelle ligne d'article -->
          var n = 1;
              
          $('.add_article').click(function(e){
              e.preventDefault();
              
          ++n;
          var template = '<tr id="ligne-article'+n+'" class="supp-ligne">'+
                            '<td>'+
                              '<select  class="article_list form-control input-sm" name="module_id[]">'+
                                '<option value="None">-- Select --</option>'+
                                '@foreach($all as $key => $value)<option value="{{ $key }}">{{ $value }}</option> @endforeach'+
                                '</select></td>'+
                                '<td ><input type="number" name="produit_quantite[]" id="qte'+n+'" value="1" class="form-control input-sm" palceholder="Quantité du produit"></td>'+
                                '<td id="pu'+n+'"></td><td><input type="number" name="produit_remise[]" id="rht'+n+'" value="0" class="form-control input-sm" palceholder="Remise sur le produit"></td>'+
                                '<td id="total'+n+'"></td>'+
                                '<td class="supp"><a href="" class="supp_article"><span class="glyphicon glyphicon-trash "></span></a></td>'+

                          '</tr>';
          <!-- Ajout d'une nouvelle ligne d'article -->
              $('#btn-ajout').before(template);
              
              <!-- Ajout de la fonctoin Select2 -->
              $('.article_list').select2({ placeholder: "Choisissez le contact à lier a state" });
              
              <!-- Choix d'un artcile dans la liste déroulante -->
               $("select[name='module_id[]']").change(function(){
                var id = $(this).val().substring(0);
                var trnum = $(this).parent().parent().attr('id').replace('ligne-article','');    
            
                var data = { "id ": id };
                  
                
                <!-- Envoi du choix et chargement des données du choix d'article -->
               $.getJSON('ArticleSelect', { id : id }, function(data) {
                  var qte = $('#qte'+trnum).val();
                  var remise = ($('#rht'+trnum).val()/100) * (data.prix_module* qte);

                  var total = (qte * data.prix_module) - remise;
                  
                  console.log(data);
                  $('.desc').html(data.desc_module);
                  $('#pu'+trnum).html(data.prix_module);
                  $('#pu'+trnum).attr('class',data.prix_module);
                  $('#total'+trnum).html(total);
                  
               });
                <!-- Calcul du total au changement de la quantité -->
                 $("#qte"+trnum).bind('keyup ', function () {
                    var pu = $('#pu'+trnum).attr('class');
                    var remise = ($('#rht'+trnum).val()/100) * (pu * $(this).val());
                    var total = ($(this).val() * pu) - remise ;
                    $('#total'+trnum).html(total);            
                });
                    <!-- Calcul du total au changement de la remise -->
                 $("#rht"+trnum).bind('keyup ', function () {
                    var pu = $('#pu'+trnum).attr('class');
                    var remise = ($(this).val()/100) * (pu * $('#qte'+trnum).val());
                    var total = ($('#qte'+trnum).val() * pu) - remise ;
                    $('#total'+trnum).html(total);            
                });

              });
               
             
             
              
             
              <!-- Suppression d'une ligne d'article -->
              $('.supp_article').click(function(e){
                e.preventDefault();
               $(this).parents('.supp-ligne').remove();

              });
          });
          
          
          
         


              
    });

  	
@stop

	
