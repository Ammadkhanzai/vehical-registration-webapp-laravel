
@extends('dealer.layouts.template')
@section('page-title','Vehicals')
@section('content')



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Clients</h1>
        
        
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <button type="button" class="btn btn-primary">Large button</button>
    </div> -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- <h2>Current Vehicals Table</h2> -->
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        

        @foreach ($clients as $users)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td >{{ $users->first_name.' '.$users->last_name }}</td>
                    <td >{{ $users->current_address }}</td>
                    <td >{{ $users->phone }}</td>
                    <td >
                        <a href="{{route('dealer.admin.view.client',$users->id )}}"><button type="button" class="btn btn-outline-info btn-sm">View</button></a>
                        
                    </td>      
                </tr>       
        @endforeach
        </tbody>
    </table>
    </div>
</main>

@endsection