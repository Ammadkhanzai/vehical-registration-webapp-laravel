@extends('excise.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Manufacturer Profile Approvals</h1>    
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>User Cnic</th>
            <th>User Email</th>
            <th>Manufacturer Company Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($manufacturers as $manufacture)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="/{{$manufacture->user_id}}">{{ $manufacture->fetchforadmin->cnic }}</td>
            <td>{{ $manufacture->fetchforadmin->email }}</td>
            <td><a href="/{{$manufacture->id}}">{{ $manufacture->company_name }}</a></td>
            <td class="d-flex">
                <form action="{{ route('admin.manufacturer-profile-approval-submit')}}" method="POST" class="mr-1">
                @csrf
                @method('POST') 
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="profile-id" value="{{ $manufacture->id }}">
                <input type="submit" value="Approve" class="btn btn-outline-success btn-sm">
                </form>
                <form action="{{ route('admin.manufacturer-profile-approval-submit')}}" method="POST">
                @csrf
                @method('POST') 
                <input type="hidden" name="status" value="0">
                <input type="hidden" name="profile-id" value="{{ $manufacture->id }}">
                <input type="submit" value="Decline" class="btn btn-outline-danger btn-sm">
                </form>
            </td> 
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</main>
@endsection