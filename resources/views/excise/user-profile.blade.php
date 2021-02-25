@extends('excise.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">User Profiles</h1>
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
            <th>User Name</th>
            <th>User Address</th>
            <th>User Phone Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td >{{ $user->first_name.' '.$user->last_name }}</td>
            <td >{{ $user->current_address }}</td>
            <td >{{ $user->phone }}</td>
            <td >
                <a href="{{ route('admin.user-profile-details', $user->id ) }}"><button type="button" class="btn btn-outline-info btn-sm">View</button></a>
                <!-- <a href=""><button type="button" class="btn btn-outline-success btn-sm">Transfer Vehicals</button></a> -->
            </td> 
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</main>
@endsection