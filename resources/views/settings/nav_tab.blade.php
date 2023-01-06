<li class="nav-item">
    <a class="nav-link {{ Request::is('settings/user_roles*') ? 'active' : '' }}"  href="{{route('settings.role') }}" role="tab">User Role</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('settings/barangay*') ? 'active' : '' }}"  href="{{route('settings.brgy') }}" role="tab">Barangays</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('settings/sector*') ? 'active' : '' }}"  href="{{route('settings.sector') }}" role="tab">Sectors</a>
</li>
          
          