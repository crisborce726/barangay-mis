@extends('layouts.app')
@section('title','Household Member List | ' . config('app.name'))

@section('content')

    <section class="content-header">
        <h1 class="page-title">Household Member List</h1>
    </section>
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
            <li class="breadcrumb-item "><a href={{ route('family.head') }}>Sector</a></li>
            <li class="breadcrumb-item active">Holsehold Member</li>
        </ul>
    </div>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-hover table-bordered table-mini" id="member-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Household No.</th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Suffix</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Sitio</th>
                            <th>Barangay</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($data as $item)
                            <tr>
                                <td scope="row">
                                    <span class="badge">{{ $i }} </span>
                                </td>
                                <td>{{$item->household_no}}</td>
                                <td>{{$item->lastname}}</td>
                                <td>{{$item->firstname}}</td>
                                <td>{{$item->middlename}}</td>
                                <td>
                                    @if(!empty($item->suffix))
                                    {{$item->suffix}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{$item->gender}}</td>
                                
                                <td>{{$item->birth}}</td>
                                <td>{{$item->age}}</td>
                                <td>
                                    @if(!empty($item->sitio))
                                    {{$item->sitio}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{$item->brgy}}</td>
                            </tr>
                        @php $i ++;  @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

<script type="text/javascript">
  
  $(document).ready(function() {
        $('#member-datatable').DataTable({
        });
    } );

</script>
@endsection