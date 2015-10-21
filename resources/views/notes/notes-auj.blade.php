<div class="table-responsive ">
        <table  class="table table-condensed table-contact" >
            
            
            

{{--*/ $back = 1; 
        $i=1; 
 $cat=''; 
 $typ=''; 
 /*--}}

    @foreach ($note_auj as $note)

 
            @if ($note->type=='Prospect')
                {{--*/ $cat='primary'; /*--}}
            @elseif ($note->type=='Prospect à revoir') 
                {{--*/ $cat='warning'; /*--}}
            @elseif ($note->type=='Client') 
                {{--*/ $cat='success'; /*--}} 
            @elseif ($note->type=='Refus') 
                {{--*/ $cat='danger'; /*--}} 
            @else
                {{--*/ $cat='info'; /*--}}      
            @endif

            @if ($note->categorie=='A faire')
                {{--*/ $typ='info'; /*--}}
            @elseif ($note->categorie=='Appel téléphonique') 
                {{--*/ $typ='primary'; /*--}}
            @elseif ($note->categorie=='E-mail') 
                {{--*/ $typ='warning'; /*--}} 
            @elseif ($note->categorie=='Réunion') 
                {{--*/ $typ='success'; /*--}} 
            @else
                {{--*/ $typ='default'; /*--}}      
            @endif
   	    


        @if ($note->etat==1)
   	    	   	   
     	{!!'<tr class="'.$cat.'">'!!}
          <td width="7%">{!! $i!!}</td>
          <td>
            <a  style="text-align:left;" href="{!! route('afficher.note',[$note,$back]) !!}" >
            <span class="label label-{{$typ}}">
              {!!$note->type!!}&nbsp;&nbsp;
              <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>&nbsp;&nbsp;{!!$note->categorie !!}
            </span>
            </a>&nbsp;&nbsp;
            <a  style="text-align:left;" href="{!! route('afficher.note',[$note,$back]) !!}" ><span class="info">{!! $note->nom!!}</a>
          </td>
          <td>
            <ul class="action-list">
                <li><a href="#" data-toggle="modal"  alt="" data-target="#myModalListe"><span id="{{$note->id}}" alt="{{$note->nom}}" class="glyphicon glyphicon-remove societe" aria-hidden="true"></span></a></li>
                <li style="margin-right:8px"><a href="{!! route('modifier.note',[$note,$back]) !!}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
            </ul> 
          </td>
        </tr>

      
      {{--*/ $i++; /*--}}
       @endif
       @endforeach
    </table>
   

</div>