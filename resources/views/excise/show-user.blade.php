@extends('excise.layouts.template')
@section('page-title','Vehicals')
@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">User Details</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.user-profile-view')}}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Details</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    </div>
    
    <form>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label  class="font-weight-bold"><u>First Name :</u></label>
            <p class="lead text-uppercase ml-3">{{ $user->first_name }}</p>
            </div>
            
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>Middle Name</u></label>
            <p class="lead text-uppercase ">{{ $user->middle_name }}</p>
            </div>
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>Last Name</u></label>
            <p class="lead text-uppercase ">{{ $user->last_name }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Father Name:</u></label>
            <p class="lead text-uppercase ">{{ $user->father_name }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Father Cnic :</u></label>
            <p class="lead text-uppercase ">{{ $user->father_cnic }}</p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>Date of birth :</u></label>
            <p class="lead text-uppercase ">{{ $user->dob }}</p>
            </div>
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>Phone Number :</u></label>
            <p class="lead text-uppercase ">{{ $user->phone }}</p>
            </div>
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>Nationality :</u></label>
            <p class="lead text-uppercase ">{{ $user->nationality }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Current Address :</u></label>
            <p class="lead text-uppercase ">{{ $user->current_address }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Postal Address :</u></label>
            <p class="lead text-uppercase ">{{ $user->postal_address }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>City :</u></label>
            <p class="lead text-uppercase ">{{ $user->city }}</p>
            </div>
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>State :</u></label>
            <p class="lead text-uppercase ">{{ $user->state }}</p>
            </div>
            <div class="form-group col-md-4">
            <label  class="font-weight-bold" ><u>Zip :</u></label>
            <p class="lead text-uppercase ">{{ $user->zip }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Licence Number :</u></label>
            <p class="lead text-uppercase ">{{ $user->licence_number }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Licence Class :</u></label>
            <p class="lead text-uppercase ">{{ $user->licence_class }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>User Registration Number :</u></label>
            <p class="lead text-uppercase ">{{ $user->user_registration_no }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Registeration Date :</u></label>
            <p class="lead text-uppercase ">{{ $user->registration_date }}</p>
            </div>
        </div>
       
       
    </form>

</main>
@endsection