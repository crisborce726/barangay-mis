
<li class="nav-item">
    <a class="nav-link {{ Request::is('barangays*') ? 'active' : '' }}"  href="{{url('barangays') }}" role="tab">Barangay Dashboard</a>
</li>
@foreach ($bgry as $item)
    <li class="nav-item">
        <a class="nav-link {{ Request::is('Dashboard/'.$item->barangay) ? 'active' : null }}"  href="{{url('Dashboard/'.$item->barangay) }}" role="tab">{{$item->barangay}}</a>
    </li>
@endforeach

          