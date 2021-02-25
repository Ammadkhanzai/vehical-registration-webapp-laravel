
@extends('user.layouts.template')
@section('page-title','Vehicals')
@section('content')



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Vehicals</h1>
        
        
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
    
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="form-group">
            <div class="alert alert-danger" role="alert">{{ __($error) }}</div>
        </div>
        @endforeach        
    @endif    
    <!-- <h2>Current Vehicals Table</h2> -->
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Engine Number</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        

        @foreach ($vehicals as $vehical)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td >{{ $vehical->fetchVehical->model }}</td>
                    <td >{{ $vehical->fetchVehical->engine_number }}</td>
                    <td >{{ $vehical->fetchVehical->vehical_class }}</td>
                    <td >
                        <a href="{{ route('user.admin.show.vehical', $vehical->fetchVehical->id )}}"><button type="button" class="btn btn-outline-info btn-sm">View</button></a>
                        <a href="{{ route('user.admin.show.transfer-vehical', $vehical->fetchVehical->id ) }}"><button type="button" class="btn btn-outline-success btn-sm">Proceed To Transfer</button></a>
                        
                    </td>      
                </tr>       
        @endforeach
        </tbody>
    </table>
    </div>
</main>

@endsection