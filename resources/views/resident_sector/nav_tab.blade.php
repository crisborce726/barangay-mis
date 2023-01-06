<li class="nav-item">
    <a class="nav-link {{ Request::is('family_heads/list*') ? 'active' : '' }}"  href="{{route('family.head') }}" role="tab">Family</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('farmers/list*') ? 'active' : null }}"  href="{{route('farmers.list') }}" role="tab">Farmers</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('household_heads/list*') ? 'active' : null }}"  href="{{route('household.head') }}" role="tab">Household</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('ofw/list*') ? 'active' : null }}"  href="{{route('ofw.list') }}" role="tab">OFW</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('out_of_school_youth/list*') ? 'active' : null }}"  href="{{route('osy.list') }}" role="tab">Out of School Youth</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('person_with_disability/list*') ? 'active' : null }}"  href="{{route('pwd.list') }}" role="tab">PWD</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('senior_citizen/list*') ? 'active' : null }}"  href="{{route('senior_citisen.list') }}" role="tab">Senior Citizens</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('solo_parent/list*') ? 'active' : null }}"  href="{{route('solo_parent.list') }}" role="tab">Solo Parent</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('4ps/list*') ? 'active' : '' }}"  href="{{route('4ps.list') }}" role="tab">4Ps</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('business_owner/list*') ? 'active' : null }}"  href="{{route('business_owner.list') }}" role="tab">Business Owner</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('children/list*') ? 'active' : null }}"  href="{{route('children.list') }}" role="tab">Children</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('women/list*') ? 'active' : null }}"  href="{{route('women.list') }}" role="tab">Women</a>
</li>