@extends('user.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dealers</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    

    <!-- <h2>Current Dealers Table</h2> -->
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Dealer Name</th>
            <th>Business Address</th>
            <th>Business Phone Number</th>
            <!-- <th>Actions</th> -->
        </tr>
        </thead>
        <tbody>
        @foreach($dealers as $dealer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td >{{ $dealer->business_name }}</td>
            <td >{{ $dealer->business_address }}</td>
            <td >{{ $dealer->business_phone }}</td>
            <!-- <td class="w-25">
                <a href="{{ route('manufacturer.admin.show.transfer-vehical', $dealer->id ) }}"><button type="button" class="btn btn-outline-info btn-sm">View</button></a>
                <a href="{{ route('manufacturer.admin.view.transfer-vehical',['id'=>  $dealer->id ]) }}"><button type="button" class="btn btn-outline-success btn-sm">Transfer Vehicals</button></a>
                
                
            </td>  -->
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</main>
@endsection