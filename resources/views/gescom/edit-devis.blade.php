@extends('default')

@section('head')
	{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']).'/' /*--}}
@stop

@section('title','Edition de devis')
@section('titre-entete')
      {{ 'Edition du devis '.$profil->num_devis }}
  </div>
@stop

@include('default.top-nav')
@include('default.left-nav')

@section('content')

<div class="row">
  @include('errors.list')
</div>
{!! Form::open(['url' => route('devis.update'), 'method'=>'PUT']) !!}

<div class="panel panel-default">
  <div class="panel-heading">
   <span ><strong style="text-align: center">Devis {{ $profil->num_devis }}</strong></span> 
  </div>
  <div class="panel-body" >

      <div class="row">
           <div class="col-md-4">
             <div class=" cadre-info panel-default">
             <div class="panel-body ">
               <div class="form-group" id="societe_form">
                 <div class="col-sm-12" style="padding-left:0px;">
                   {!! Form::label('societe','Société ') !!}
                   {!! Form::select('societe_id',$societes,null,['class' =>'form-control input-sm','id'=>'societe_list']) !!}
                 </div>
               </div>
             </div>
           </div>  
         </div>  
         <div class="col-md-5 pull-right">
           <div class=" cadre-info panel-default">
             <div class="panel-body ">
                <div class="form-group">
                  <div class="col-sm-12" style="padding-left:0px;">
                    {!! Form::label('contact','Contact ') !!}
                    {!! Form::select('contact_id',$contacts,$profil->contact_id,['class' =>'form-control input-sm','id'=>'contact_list']) !!}
                  </div>
                </div>
             </div>
            </div> 
           </div>
         </div>
      

        <div class="row">
          <div class="col-md-12">
            <h4 style="text-align: center">Licence {{ $profil->produit }} </h4>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-striped ">
              <tr>
                <th>Désignation</th> 
                <th>Qte</th> 
                <th>P.U en {{ $profil->gescom->devise}}</th>
                <th>Total Remise en HT {{$profil->gescom->taux_remise}}</th>
              </tr>
              <tr>
                <td>
                  <h4>Module de base {{$profil->produit}}</h4>
              @foreach($produits as $produits)
                @if($produits->type_module=="Base")
                  <strong>{{ $produits->nom_module }}</strong><br/>
                @endif
              @endforeach
                </td>
                <td>1</td>
                <td></td>
                <td></td>
              </tr>
              @foreach($profil->modules as $modules)
                @if($modules->type_module=="Simple")
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr id="ligne-article'+n+'" class="supp-ligne">
                    <td>
                      <select  class="article_list form-control input-sm article_list modulelist'+n+'" id="module_list" name="module_id[]">
                      @foreach($profil->modules as $modules)
                        <option value="{{ $produits }}"><strong>{{ $modules->nom_module }}</strong></option>
                      @endforeach
                      </select>
                    </td>
                    <td ><input type="number" name="produit_quantite[]" id="qte'+n+'" value="{{ $modules->pivot->produit_quantite }}" class="form-control input-sm" palceholder="Quantité du produit"></td>
                    <td id="pu'+n+'">{{ $modules->prix_module }}</td><td><input type="number" name="produit_remise[]" id="rht'+n+'" value="{{ $modules->pivot->produit_remise }}" class="form-control input-sm" palceholder="Remise sur le produit"></td>
                    <td id="total'+n+'"></td>
                    <td class="supp"><a href="" class="supp_article"><span class="glyphicon glyphicon-trash "></span></a></td>
                  </tr>
                @endif
              @endforeach
               <tr id="btn-ajout"><td colspan="6"><a href="" class="add_article">Ajouter un produit ou module</a></td></tr> 
            </table>

            <table class="table table-striped pull-right">
            <tr>
              <th colspan="3" style="text-align:right">Total HT </th><td>{{ $profil->total_ht }}</td>
            </tr>
            <tr>
              <th colspan="3" style="text-align:right">Total ANPME {{ $profil->gescom->taux_anpme }}% </th> <td>{{ $profil->total_anpme }}</td>
            </tr>
            <tr>
              {{--*/ $part = 100 - $profil->gescom->taux_anpme /*--}}
              <th colspan="3" style="text-align:right">Votre part {{ $part }}% </th> <td> {{ $profil->total_part }}</td>
            </tr>
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
                            '<option value=""></option>'+
                              '@foreach($profil->modules as $modules)<option value="{{ $modules->id }}">{{ $modules->nom_module }}</option> @endforeach'+
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

	
