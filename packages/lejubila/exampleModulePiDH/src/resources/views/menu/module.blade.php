<li class="header"><span>Example module</span></li>
@foreach($menu as $key => $item)
    <li>
        <a href="{{$item['link']}}" class="">
            <i class="fa {{$item['fa-icon'] or ''}}"></i> <span>{{$item['name']}}</span>
        </a>
    </li>
@endforeach