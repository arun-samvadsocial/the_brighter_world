<div class="archive_sidebar" >
    <div class="card">
        <div class="header">
            <p class="text-center font1">Archives</p>
        </div>
        <!-- <div class="container"> -->
        <ul>
            @php $archives = Helper::getArchives();
            $year="";

            $years = array();
            foreach ($archives as $c) {
            $years[$c->YEAR] = $c; // Get unique country by code.
            }
            @endphp

            @foreach($years as $p_row)
            <li> <i><strong>- {{$p_row->YEAR}}</strong></i> </li>
            @foreach($archives as $row)
            @if($row->YEAR == $p_row->YEAR)
            <li> <a href="{!! url('/').'/archives/'.$p_row->YEAR.'/'.$row->MONTHNAME !!}"> {{$row->MONTHNAME}}
                    ({{$row->TOTAL}}) </a></li>
            @endif
            @endforeach
            @endforeach
        </ul>
        <!-- </div>     -->
    </div>
</div>