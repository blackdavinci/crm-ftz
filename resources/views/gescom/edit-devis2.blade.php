@extends('default')

@section('head')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}
@stop

@section('title','Création de devis')
@section('titre-entete','Nouveau devis')

@include('default.top-nav')
@include('default.left-nav')

@section('content')

<div class="row">
  @include('errors.list')
</div>
{!! Form::open(['url' => route('devis.store'), 'method'=>'POST']) !!}

<div class="panel panel-default">
  <div class="panel-heading">
   <a href="" id="prec"><span class="glyphicon glyphicon-chevron-left"></span> </a>
    <span ><strong style="text-align: center">Page 1 : Coordonnées</strong></span> 
   <a href="" id="suiv"><span  class="glyphicon glyphicon-chevron-right"></span></a> 
  </div>
  <div class="panel-body" >

    <div class="row">
        <div class="col-md-4 ">
          <h3>DEVIS /</h3>
        </div>
    </div>
  
    <div class="row">
      <div class="col-md-4 ">
        <div class="form-group" id="societe_form">
          <div class="col-sm-12" style="padding-left:0px;">
            {!! Form::label('societe','Société ') !!}
            {!! Form::select('societe_id',$societes,null,['class' =>'form-control input-sm','id'=>'societe_list']) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12" style="padding-left:0px;">
            {!! Form::label('contact','Contact ') !!}
            {!! Form::select('contact_id',$contacts,null,['class' =>'form-control input-sm','id'=>'contact_list']) !!}
          </div>
        </div>
      </div> 
    </div>
   
      

    <div class="row">
      <div class="col-md-12">
        <h4>Lignes de commandes</h4>
        <table class=" table table-striped table-article table-bordered">
          <tr id="titre-haut"><th>Article</th><th>Quantité</th><th>Prix Unitaire</th><th>Remise HT 25%</th><th>Total</th></tr>       
          <tr id="btn-ajout"><td colspan="6"><a href="" class="add_article">Ajouter un produit ou module</a></td></tr> 
        
        </table>
        <table class="table table-striped  pull-right">
          <tr> <td class="total-line" ><strong>Total HT</strong></td> <td id="tht"></td></tr> 
          <tr><td class="total-line" ><strong>Total ANPME 70%</strong></td> <td id="tanpme"></td></tr> 
          <tr> <td class="total-line" ><strong>Votre Part 30%</strong></td> <td id="part"></td></tr> 
        </table>

      </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
        {!! Form::label('terms','Termes et Conditions') !!}
        {!! Form::textarea('desc_devis',null, ['class' =>'form-control input-sm', 'placeholder'=>'Description des termes et conditions du contrat','rows' => '7']) !!}
      </div>
    </div>
		

    <div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
    <div class="navbar-form navbar-left" style="padding-left:0px;" >
      <a class="btn btn-default btn-smenu-position" href="{{ route('devis.index')}}" role="button">
        Annuler
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

 
  </div>
</div>
  <!-- Autres données à envoyer-->
   {{--*/ $suivi = Auth::user()->name.' '.Auth::user()->prenom /*--}}
    {!! Form::hidden('user_id',Auth::user()->id) !!}
    {!! Form::hidden('suivi_devis',$suivi) !!}
    {!! Form::hidden('prefix_id',$gescom->prefix_id) !!}
  

	{!! Form::close() !!}
	
@stop


@section('script')
  	$(document).ready(function(){

        $('#produit_list').select2({ placeholder: "Choisissez le produit" });
			 
  		  $('#societe_list').select2({ placeholder: "Choisissez la société à lier" });

        $('#contact_list').select2({ placeholder: "Choisissez le contact à lier " });

        

        $('#msg-offre').hide();

          
        

          <!-- Choix du contact à lier au devis  -->
            $("select[name='contact_id']").change(function(event){
              var id = $(this).val();
              var data = { "id ": id };
               $.getJSON('ContactSelect', { id : id }, function(data) {
                  console.log(data);
                  $('#societe_list').select2('val',data.societe_id);
               });
               
            });

            <!-- Choix de la société à lier au devis  -->
              $("select[name='societe_id']").change(function(){
                var id = $(this).val();
                var contact = $('#contact_list').val();
               
                  var data = { "id ": id };
                   $.getJSON('SocieteSelect', { id : id }, function(data) {
                      console.log(data);
                      $('#contact_list').html('');
                      $.each(data,function(key, value) {
                            $('#contact_list').append('<option value=' + key + '>' + value + '</option>');
                           
                        });
                   });
              });




          $('#suiv').click(function(e){
              e.preventDefault();
              alert('Suivant');
          });
          <!-- Template d'une nouvelle ligne d'article -->
          var n = 1;
          var tht = 0;
          var tanpme=0;
          var part =0; 
          $('.add_article').click(function(e){
              e.preventDefault();
              
          ++n;
          var template = '<tr id="ligne-article'+n+'" class="supp-ligne">'+
                            '<td>'+
                            '<select  class="article_list form-control input-sm article_list modulelist'+n+'" id="module_list" name="module_id[]">'+
                              '@foreach($modules as $key => $value)<option value="{{ $key }}">{{ $value }}</option> @endforeach'+
                              '</select></td>'+
                                '<td ><input type="number" name="produit_quantite[]" id="qte'+n+'" value="1" class="form-control input-sm" palceholder="Quantité du produit"></td>'+
                                '<td id="pu'+n+'"></td><td><input type="number" name="produit_remise[]" id="rht'+n+'" value="0" class="form-control input-sm" palceholder="Remise sur le produit"></td>'+
                                '<td id="total'+n+'"></td>'+
                                '<td class="supp"><a href="" class="supp_article"><span class="glyphicon glyphicon-trash "></span></a></td>'+

                          '</tr>';
          

              <!-- Remplissage de la liste des modules par rapport au type de devis choisi  -->
              var id = $('#produit_list').val();
              var data = { "id ": id };
                $('.modulelist'+n).html('');
               $.getJSON('ModuleSelect', { id : id }, function(data) {
                  console.log(data);
                  $('.modulelist'+n).append('<option></option>');
                  $.each(data,function(key, value) {
                      $('.modulelist'+n).append('<option value=' + key + '>' + value + '</option>');
                  });
                 
                });

             
            <!-- Ajout d'une nouvelle ligne d'article -->
              $('#btn-ajout').before(template);
              
                
              
              <!-- Ajout de la fonctoin Select2 -->
              $('.article_list').select2({ placeholder: "Choisissez le module à ajouter" });
              
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
                  $('#total'+trnum).attr('class',total);

                   for(var i=trnum; i>=2; i--){
                  tht += $('#total'+i).attr('class');
                }
               

                $('#tht').html(tht);
                $('#tanpme').html(tanpme);
                $('#part').html(part);
                  
               });
                <!-- Calcul du total au changement de la quantité -->
                 $("#qte"+trnum).bind('keyup ', function () {
                    var pu = $('#pu'+trnum).attr('class');
                    var remise = ($('#rht'+trnum).val()/100) * (pu * $(this).val());
                    var total = ($(this).val() * pu) - remise ;
                    $('#total'+trnum).html(total); 
                    $('#total'+trnum).attr('class',total);           
                });
                    <!-- Calcul du total au changement de la remise -->
                 $("#rht"+trnum).bind('keyup ', function () {
                    var pu = $('#pu'+trnum).attr('class');
                    var remise = ($(this).val()/100) * (pu * $('#qte'+trnum).val());
                    var total = ($('#qte'+trnum).val() * pu) - remise ;
                    $('#total'+trnum).html(total); 
                    $('#total'+trnum).attr('class',total);           
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

	
