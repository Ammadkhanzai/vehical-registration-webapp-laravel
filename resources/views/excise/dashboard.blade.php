@extends('excise.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary">Share</button>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
        </button>
    </div>
    </div> -->
    
    <div class="row">
    <div class="col-md-12">
		    <div class="">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>login Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-6">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                      @foreach($errors->all() as $error)
                      <div class="form-group">      
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                      </div>
                      @endforeach
                    @endif
                    
		                    <form action="{{ route('admin.update-profile')}}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="form-group row d-block">
                          <label for="email" class="col-12 col-form-label">Email <span class="text-danger">*</span></label> 
                          <div class="col-12">
                            <input  name="email" value="{{ old('email') ? old('email') : __($userModel->email) }}" placeholder="Email" class="form-control here" type="text">
                          </div>
                        </div>
                        <div class="form-group row d-block">
                          <label for="phone" class="col-12 col-form-label">New Password<span class="text-danger">*</span></label> 
                          <div class="col-12">
                            <input  name="newPassword" value="{{ old('phone') ? old('phone') : '' }}"  class="form-control here" required="required" type="password" placeholder="Type Old Password">
                          </div>
                        </div>
                        <div class="form-group row d-block">
                          <label for="phone" class="col-12 col-form-label">Confirm Password<span class="text-danger">*</span></label> 
                          <div class="col-12">
                            <input  name="confPassword" value="{{ old('phone') ? old('phone') : '' }}"  class="form-control here" required="required" type="password" placeholder="Type New Password">
                          </div>
                        </div>
                        <div class="form-group row  d-block">
                          <div class="col-12">
                            <button name="submit" type="submit" class="s btn btn-primary">Update Profile</button>
                          </div>
                        </div>
                      </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
    
    </div>
    </div>
</main>
@endsection