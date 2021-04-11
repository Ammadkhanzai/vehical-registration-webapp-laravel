
@extends('dealer.layouts.template')
@section('page-title','Vehicals')
@section('content')



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Receive New Vehicles</h1>
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
        <div class="alert alert-danger">
        @foreach ($errors->all() as $input_error)
            {{ $input_error }}
        @endforeach 
        </div>
    @endif

    <!-- <h2>Current Vehicals Table</h2> -->
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Engine Number</th>
            <!-- <th>Transfered To</th> -->
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        
        
        @foreach ($vehicals as $vehical)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vehical->fetchVehical->model }}</td>
                    <td>{{ $vehical->fetchVehical->engine_number }}</td>
                    <!-- <td class="w-25"><a href="{{ route('manufacturer.admin.show.transfer-vehical', $vehical->fetchDealer->id )}}">{{ $vehical->fetchDealer->business_name }}</a></td> -->
                    <td>
                    <form action="{{route('dealer.admin.receive.transfered-vehical') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value="{{ $vehical->id }}">
                    <button type="submit" class="btn btn-outline-success btn-sm">Receive</button>                
                    </form>
                    </td>  
                    
                </tr>       
        @endforeach
        </tbody>
    </table>
    </div>
</main>

@endsection