
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>

                @if(auth()->user()->usertype == 'admin')
                    <li class="{{ Request::is('home*') ? 'active' : '' }}">
                        <a href={!! route('home') !!}>
                            <i class="la la-dashboard"></i>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('barangays*') ? 'active' : '' }}
                    {{ Request::is('Ap-apaya.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Bol-lilising.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Cal-lao.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Lap-lapog.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Lumaba.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Poblacion.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Tamac.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Tuquib.Dashboard*') ? 'active' : '' }}
                    ">
                        <a href={!! route('barangays.index') !!}>
                            <i class='la la-info-circle'></i>
                            <span class="links_name">Barangay</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('users*') ? 'active' : '' }}">
                        <a href={!! route('users.index') !!}>
                            <i class='la la-users'></i>
                            <span class="links_name">Users</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('residents*') ? 'active' : '' }}">
                        <a href="{{route('residents.index')}}">
                            <i class='la la-group'></i>
                            <span class="links_name">Resident</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('family_heads*') ? 'active' : '' }}
                    {{ Request::is('farmers*') ? 'active' : '' }}
                    {{ Request::is('household_heads*') ? 'active' : '' }}
                    {{ Request::is('ofw*') ? 'active' : '' }}
                    {{ Request::is('out_of_school_youth*') ? 'active' : '' }}
                    {{ Request::is('person_with_disability*') ? 'active' : '' }}
                    {{ Request::is('senior_citizen*') ? 'active' : '' }}
                    {{ Request::is('solo_parent*') ? 'active' : '' }}
                    {{ Request::is('4ps*') ? 'active' : '' }}
                    {{ Request::is('business_owner*') ? 'active' : '' }}
                    {{ Request::is('children*') ? 'active' : '' }}
                    {{ Request::is('women*') ? 'active' : '' }}
                    ">
                        <a href={!! route('family.head') !!}>
                            <i class='la la-list-ul'></i>
                            <span class="links_name">Sectors</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('files*') ? 'active' : '' }}">
                        <a href={!! route('files.index') !!}>
                            <i class='la la-file-import'></i>
                            <span class="links_name">Files</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('activity_logs*') ? 'active' : '' }}
                    {{ Request::is('view.logs*') ? 'active' : '' }}
                    ">
                        <a href="/activity_logs">
                            <i class='la la-list-ol'></i>
                            <span class="links_name">Activity Logs</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('archives*') ? 'active' : '' }}">
                        <a href="/archives">
                            <i class='la la-box' ></i>
                            <span class="links_name">Archive</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                        <a href={!! route('settings.role') !!}>
                            <i class='la la-cogs' ></i>
                            <span class="links_name">Settings</span>
                        </a>
                    </li>

                @elseif(auth()->user()->usertype == 'department-dswdo' || auth()->user()->usertype == 'department-mdrrmo')
                    <li class="{{ Request::is('home*') ? 'active' : '' }}">
                        <a href={!! route('home') !!}>
                            <i class="la la-dashboard"></i>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('barangays*') ? 'active' : '' }}
                    {{ Request::is('Ap-apaya.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Bol-lilising.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Cal-lao.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Lap-lapog.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Lumaba.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Poblacion.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Tamac.Dashboard*') ? 'active' : '' }}
                    {{ Request::is('Tuquib.Dashboard*') ? 'active' : '' }}
                    ">
                        <a href={!! route('barangays.index') !!}>
                            <i class='la la-info-circle'></i>
                            <span class="links_name">Barangay</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('residents*') ? 'active' : '' }}">
                        <a href="{{route('residents.index')}}">
                            <i class='la la-group'></i>
                            <span class="links_name">Resident</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('family_heads*') ? 'active' : '' }}
                    {{ Request::is('farmers*') ? 'active' : '' }}
                    {{ Request::is('household_heads*') ? 'active' : '' }}
                    {{ Request::is('ofw*') ? 'active' : '' }}
                    {{ Request::is('out_of_school_youth*') ? 'active' : '' }}
                    {{ Request::is('person_with_disability*') ? 'active' : '' }}
                    {{ Request::is('senior_citizen*') ? 'active' : '' }}
                    {{ Request::is('solo_parent*') ? 'active' : '' }}
                    {{ Request::is('4ps*') ? 'active' : '' }}
                    {{ Request::is('business_owner*') ? 'active' : '' }}
                    {{ Request::is('children*') ? 'active' : '' }}
                    {{ Request::is('women*') ? 'active' : '' }}
                    ">
                        <a href={!! route('family.head') !!}>
                            <i class='la la-list-ul'></i>
                            <span class="links_name">Sectors</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('activity_logs*') ? 'active' : '' }}
                    {{ Request::is('view.logs*') ? 'active' : '' }}
                    ">
                        <a href="/activity_logs">
                            <i class='la la-list-ol'></i>
                            <span class="links_name">Activity Logs</span>
                        </a>
                    </li>
                @elseif(auth()->user()->usertype == 'barangay')
                    <li class="{{ Request::is('home*') ? 'active' : '' }}">
                        <a href="/home">
                            <i class="la la-dashboard"></i>
                            <span class="links_name">Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('information*') ? 'active' : '' }}">
                        <a href="/information">
                            <i class='la la-info-circle'></i>
                            <span class="links_name">Barangay Information</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('officials*') ? 'active' : '' }}">
                        <a href="/officials">
                            <i class='la la-user'></i>
                            <span class="links_name">Barangay Officials</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('residents*') ? 'active' : '' }}">
                        <a href={!! route('residents.index') !!}>
                            <i class='la la-list-ul'></i>
                            <span class="links_name">Residents</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('family_heads*') ? 'active' : '' }}
                    {{ Request::is('farmers*') ? 'active' : '' }}
                    {{ Request::is('household_heads*') ? 'active' : '' }}
                    {{ Request::is('ofw*') ? 'active' : '' }}
                    {{ Request::is('out_of_school_youth*') ? 'active' : '' }}
                    {{ Request::is('person_with_disability*') ? 'active' : '' }}
                    {{ Request::is('senior_citizen*') ? 'active' : '' }}
                    {{ Request::is('solo_parent*') ? 'active' : '' }}
                    {{ Request::is('4ps*') ? 'active' : '' }}
                    {{ Request::is('business_owner*') ? 'active' : '' }}
                    {{ Request::is('children*') ? 'active' : '' }}
                    {{ Request::is('women*') ? 'active' : '' }}
                    ">
                        <a href={!! route('family.head') !!}>
                            <i class='la la-list-ul'></i>
                            <span class="links_name">Sectors</span>
                        </a>
                    </li>

                    <li class="
                    {{ Request::is('activity_logs*') ? 'active' : '' }}
                    {{ Request::is('view.logs*') ? 'active' : '' }}
                    ">
                        <a href="/activity_logs">
                            <i class='la la-list-ol'></i>
                            <span class="links_name">Activity Logs</span>
                        </a>
                    </li>

                    <li class="menu-title">
                        <span>Forms</span>
                    </li>

                    <li class="{{ Request::is('certificates*') ? 'active' : '' }}">
                        <a href="/certificates">
                            <i class="fa fa-certificate"></i>
                            <span class="links_name">Certificate</span>
                        </a>
                    </li>

                    <li class="menu-title">
                        <span>REPORTS</span>
                    </li>

                    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
                        <a href="/reports">
                            <i class='la la-file' ></i>
                            <span class="links_name">Reports</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->