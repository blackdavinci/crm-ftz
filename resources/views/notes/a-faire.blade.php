@extends('default')

@section('title','Notes')
@section('titre-entete','Notes à faire')

@include('default.top-nav')
@include('default.left-nav')
@include('notes.bar-menu')
@section('content')
  
  <div class="table-responsive">
        <table  class="table table-condensed table-contact" >
            <th >#</th>
            <th >Note<span class="label label-default">  Catégorie</span></th>
            
            


{{--*/ $i=1; /*--}}
{{--*/ $cat=''; /*--}}
    @foreach ($notes as $note)

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
   	    


        @if ($note->etat=='1')
   	    @if ($note->categorie=='A faire')

   	   
    	@if ($note->type=='Prospect')
    		{{-- expr --}}
    	
    		<tr class="success">
    			<td >{!! $i!!}</td>
                <td ><span class="info">{!! $note->nom!!}    </span>   
                   {!!'<span class="label label-'.$cat.'">' !!}{!!$note->categorie!!}</span>
                                          
                    <div class="action" style=" margin-bottom:0px">
                        <ul >
                             <li><a href="{!! route('notes.edit',$note) !!}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                             </a></li>
                            <li><a href="{!! route('notes.show',$note) !!}" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a></li>
                       </ul> 
                    </div>

                </td>
    		</tr>

    	@elseif($note->type=='Refus')
			<tr class="active">
				<td >{!! $i!!}</td>
                <td ><span class="info">{!! $note->nom!!}</span>   
                   {!!'<span class="label label-'.$cat.'">' !!}{!! $note->categorie!!}</span>
                                          
                    <div class="action" style=" margin-bottom:0px">
                        <ul >
                             <li><a href="{!! route('notes.edit',$note) !!}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                             </a></li>
                            <li><a href="{!! route('notes.show',$note) !!}" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a></li>
                       </ul> 
                    </div>

                </td>
    		</tr>

    	@else
			<tr class="bg-info">
    			<td >{!! $i!!}</td>
                <td ><span class="info">{!! $note->nom!!}</span>   
                   {!!'<span class="label label-'.$cat.'">' !!}{!! $note->categorie!!}</span>
                   			              
                    <div class="action" style=" margin-bottom:0px">
                        <ul >
                             <li><a href="{!! route('notes.edit',$note) !!}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                             </a></li>
                            <li><a href="{!! route('notes.show',$note) !!}" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a></li>
                       </ul> 
                    </div>

				</td>

    		</tr>

    	@endif
    	{{--*/ $i++; /*--}}
    	 @endif
    	 @endif
       @endforeach

    </table>

</div>
    

@stop