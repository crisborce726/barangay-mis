@if(auth()->user()->usertype == 'admin')
    <!-- Row -->
    <div class="row">
        <!-- Users -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($users, 0, '.', ','); @endphp</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="/users" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Users -->

        <!-- Online Users -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($onlineUsers, 0, '.', ','); @endphp</h3>
                    <p>Online Users</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="/users" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Online Users -->

        <!-- Residents -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($residents, 0, '.', ','); @endphp</h3>
                    <p>Population</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('residents.index')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Residents -->

        <!-- Activity Logs -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($files, 0, '.', ','); @endphp</h3>
                    <p>Files</p>
                </div>
                <div class="icon">
                    <i class='la la-list-ul'></i>
                </div>
                <a href="{{route('files.index')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Activity Logs -->

        <!-- Archive -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($archives, 0, '.', ','); @endphp</h3>
                    <p>Archive</p>
                </div>
                <div class="icon">
                    <i class='la la-archive'></i>
                </div>
                <a href="{{route('archive.index')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Archive -->

        <!-- Activity Logs -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($userlog, 0, '.', ','); @endphp</h3>
                    <p>Activity Logs</p>
                </div>
                <div class="icon">
                    <i class='la la-list-ol'></i>
                </div>
                <a href="{{route('activity_logs.index')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Activity Logs -->

    </div>
    <!-- Close Row -->

    <!-- Row -->
    <div class="row">

        <!-- Family Head -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($family_heads, 0, '.', ','); @endphp</h3>
                    <p>Family Head</p>
                </div>
                <span class="icon">
                    <i class="la la-users"></i>
                </span>
                <a href="{{route('family.head')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Family Head -->

        <!-- Farmers -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($farmers, 0, '.', ','); @endphp</h3>
                    <p>Farmers</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('farmers.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Farmers -->

        <!-- Household Head -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($household_heads, 0, '.', ','); @endphp</h3>
                    <p>Household Head</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('household.head')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Household Head -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($ofws, 0, '.', ','); @endphp</h3>
                    <p>OFW</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('ofw.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

        <!-- OUT OF SCHOOL YOOUTH -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($osy, 0, '.', ','); @endphp</h3>
                    <p>Out of School Youth</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('osy.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OUT OF SCHOOL YOOUTH -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($pwds, 0, '.', ','); @endphp</h3>
                    <p>PWD</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('pwd.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

    </div>
    <!-- Close Row -->

    <!-- Row -->
    <div class="row">

        <!-- Senior -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($senior_citizens, 0, '.', ','); @endphp</h3>
                    <p>Senior Citizen</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('senior_citisen.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Senior -->

        <!-- SOLO PARENTS -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($solo, 0, '.', ','); @endphp</h3>
                    <p>Solo Parents</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('solo_parent.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag SOLO PARENTS -->

        <!-- 4Ps -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($fourps, 0, '.', ','); @endphp</h3>
                    <p>4Ps</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('4ps.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag 4Ps -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($business, 0, '.', ','); @endphp</h3>
                    <p>Business Owner</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('business_owner.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

        <!-- Children -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($children, 0, '.', ','); @endphp</h3>
                    <p>Children</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('children.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Children -->

        <!-- Women -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($women, 0, '.', ','); @endphp</h3>
                    <p>Women</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('women.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Women -->

    </div>
    <!-- Close Row -->
@elseif(auth()->user()->usertype == 'department-dswdo' || auth()->user()->usertype == 'department-mdrrmo')
    <!-- Row -->
    <div class="row">

        <!-- Family Head -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($family_heads, 0, '.', ','); @endphp</h3>
                    <p>Family Head</p>
                </div>
                <span class="icon">
                    <i class="la la-users"></i>
                </span>
                <a href="{{route('family.head')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Family Head -->

        <!-- Farmers -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($farmers, 0, '.', ','); @endphp</h3>
                    <p>Farmers</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('farmers.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Farmers -->

        <!-- Household Head -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($household_heads, 0, '.', ','); @endphp</h3>
                    <p>Household Head</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('household.head')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Household Head -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($ofws, 0, '.', ','); @endphp</h3>
                    <p>OFW</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('ofw.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

        <!-- OUT OF SCHOOL YOOUTH -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($osy, 0, '.', ','); @endphp</h3>
                    <p>Out of School Youth</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('osy.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OUT OF SCHOOL YOOUTH -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($pwds, 0, '.', ','); @endphp</h3>
                    <p>PWD</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('pwd.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

    </div>
    <!-- Close Row -->

    <!-- Row -->
    <div class="row">

        <!-- Senior -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($senior_citizens, 0, '.', ','); @endphp</h3>
                    <p>Senior Citizen</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('senior_citisen.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Senior -->

        <!-- SOLO PARENTS -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($solo, 0, '.', ','); @endphp</h3>
                    <p>Solo Parents</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('solo_parent.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag SOLO PARENTS -->

        <!-- 4Ps -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($fourps, 0, '.', ','); @endphp</h3>
                    <p>4Ps</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('4ps.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag 4Ps -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($business, 0, '.', ','); @endphp</h3>
                    <p>Business Owner</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('business_owner.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

        <!-- Children -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($children, 0, '.', ','); @endphp</h3>
                    <p>Children</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('children.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Children -->

        <!-- Women -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($women, 0, '.', ','); @endphp</h3>
                    <p>Women</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('women.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Women -->

    </div>
    <!-- Close Row -->
@elseif(auth()->user()->usertype == 'barangay')
    <!-- Row -->
    <div class="row">

        <!-- Family Head -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>{{$family_heads}}</h3>
                    <p>Family Head</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('family.head')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Family Head -->

        <!-- Farmers -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>{{$farmers}}</h3>
                    <p>Farmers</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('farmers.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Farmers -->

        <!-- Household Head -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>{{$household_heads}}</h3>
                    <p>Household Head</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('household.head')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Household Head -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>{{$ofws}}</h3>
                    <p>OFW</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('ofw.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

        <!-- OUT OF SCHOOL YOOUTH -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>{{$osy}}</h3>
                    <p>Out of School Youth</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('osy.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OUT OF SCHOOL YOOUTH -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>{{$pwds}}</h3>
                    <p>PWD</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('pwd.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

    </div>
    <!-- Close Row -->

    <!-- Row -->
    <div class="row">

        <!-- Senior -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($senior_citizens, 0, '.', ','); @endphp</h3>
                    <p>Senior Citizen</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('senior_citisen.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Senior -->

        <!-- SOLO PARENTS -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($solo, 0, '.', ','); @endphp</h3>
                    <p>Solo Parents</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('solo_parent.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag SOLO PARENTS -->

        <!-- 4Ps -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($fourps, 0, '.', ','); @endphp</h3>
                    <p>4Ps</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('4ps.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag 4Ps -->

        <!-- OFW -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($business, 0, '.', ','); @endphp</h3>
                    <p>Business Owner</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('business_owner.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag OFW -->

        <!-- Women -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($children, 0, '.', ','); @endphp</h3>
                    <p>Children</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('business_owner.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Women -->

        <!-- Women -->
        <div class="col-md-2">
            <div class="small-box" style="background-color:rgb(255, 255, 255);
            background-image:
            linear-gradient(
                rgb(253, 108, 108), #C69749
            );">
                <div class="inner">
                    <h3>@php echo number_format($women, 0, '.', ','); @endphp</h3>
                    <p>Women</p>
                </div>
                <div class="icon">
                    <i class="la la-users"></i>
                </div>
                <a href="{{route('business_owner.list')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Close Tag Women -->

    </div>
    <!-- Close Row -->
@endif
                
        
