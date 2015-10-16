<?php
 function modalAction($btnTitle,$btnType,$modalName,$modalTitle,$modalContent,$modalButton){

   return '<button type="button" class="btn btn-'.$btnType.' " data-toggle="modal" data-target="#'.$modalName.'">'.$btnTitle.'</button>

<!-- Modal -->
<div class="modal fade" id="'.$modalName.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$modalTitle.'</h4>
      </div>
      <div class="modal-body">'.$modalContent.'</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">'.$modalButton.'</button>
        <a class="btn btn-danger btn-smenu-position" href="{{ route('societe.destroy',[$profil->id])}}" role="button">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
        </a>
      </div>
    </div>
  </div>
</div>';
    
  }
?>
