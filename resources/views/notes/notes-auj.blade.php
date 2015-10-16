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
                {{--*/ $cat='default'; /*--}}
            @elseif ($note->type=='Client') 
                {{--*/ $cat='success'; /*--}} 
            @elseif ($note->type=='Refus') 
                {{--*/ $cat='danger'; /*--}} 
            @else
                {{--*/ $cat='warning'; /*--}}      
            @endif

            @if ($note->categorie=='A faire')
                {{--*/ $typ='info'; /*--}}
            @elseif ($note->categorie=='Appel téléphonique') 
                {{--*/ $typ='danger'; /*--}}
            @elseif ($note->categorie=='E-mail') 
                {{--*/ $typ='warning'; /*--}} 
            @elseif ($note->categorie=='Réunion') 
                {{--*/ $typ='success'; /*--}} 
            @else
                {{--*/ $typ='default'; /*--}}      
            @endif
   	    


        @if ($note->etat==1)
   	    	   	   
     	{!!'<tr class="'.$typ.'">'!!}
          <td width="7%">{!! $i!!}</td>
                <td ><span class="info">{!! $note->nom!!}&nbsp;&nbsp;</span>   
                        {!!'<span class="label label-'.$cat.'">' !!}{!!$note->type!!}&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>&nbsp;&nbsp;{!!$note->categorie !!}</span>
                                          
                    <div class="action" style=" margin-bottom:0px">
                        <ul >
                             <li><a href="{!! route('modifier.note',[$note,$back]) !!}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                             </a></li>
                            <li><a href="{!! route('afficher.note',[$note,$back]) !!}" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a></li>
                       </ul> 
                    </div>

                </td>
        </tr>

      
      {{--*/ $i++; /*--}}
       @endif
       @endforeach
    </table>
        {!! str_replace('/?', '?', $note_auj->render()) !!}

</div>