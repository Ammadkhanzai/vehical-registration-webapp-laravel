@extends('user.layouts.template')
@section('page-title','Vehicals')
@section('content')



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Transfered Vehicals</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Engine Number</th>
            <th>Transfered To</th>
            
        </tr>
        </thead>
        <tbody>
        

        @foreach ($list as $vehical)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vehical->fetchVehical->model }}</td>
                    <td><a href="{{route('user.admin.show.vehical',$vehical->fetchVehical->id)}}">{{ $vehical->fetchVehical->engine_number }}</a></td>
                    <td>{{ $vehical->fetchUser->first_name.' '.$vehical->fetchUser->last_name }}</td>
                    
                </tr>       
        @endforeach
        </tbody>
    </table>
    </div>
</main>

@endsection