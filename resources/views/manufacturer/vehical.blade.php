
@extends('manufacturer.layouts.template')
@section('page-title','Vehicals')
@section('content')



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Vehicals</h1>
        <a href="{{ route('manufacturer.admin.create.vehical')}}">
            <button type="button" class="btn btn-primary btn-sm">Add New Vehical</button>
        </a>
        
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
                    <td class="w-25">{{ $vehical->vehical->model }}</td>
                    <td class="w-25">{{ $vehical->vehical->engine_number }}</td>
                    <td class="w-25">{{ $vehical->vehical->vehical_class }}</td>
                    <td class="w-25">
                        <a href="{{ route('manufacturer.admin.show.vehical', $vehical->vehical_id )}}"><button type="button" class="btn btn-outline-info btn-sm">View</button></a>
                        <a href="{{ route('manufacturer.admin.edit.vehical', $vehical->vehical_id )}}"><button type="button" class="btn btn-outline-dark btn-sm">Edit</button></a>
                        <form action="{{ route('manufacturer.admin.delete.vehical', $vehical->vehical_id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>      
                </tr>       
        @endforeach
        </tbody>
    </table>
    </div>
</main>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        document.onsubmit=function(){
           return confirm('Are you sure?');
       }
    });
</script>
@endsection