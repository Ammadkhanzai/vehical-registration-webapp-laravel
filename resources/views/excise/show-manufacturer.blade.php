@extends('excise.layouts.template')
@section('page-title','Vehicals')
@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Manufacturer Details</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.manufacturer-profile-view')}}">Manufacturers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manufacturer Details</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    </div>
    
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold"><u>Company Name :</u></label>
            <p class="lead text-uppercase ml-3">{{ $manufacturer->company_name }}</p>
            </div>
            
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Phone Number</u></label>
            <p class="lead text-uppercase ">{{ $manufacturer->company_phone }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Company Email :</u></label>
            <p class="lead text-uppercase ">{{ $manufacturer->company_email }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Company Website :</u></label>
            <p class="lead text-uppercase ">{{ $manufacturer->company_website }}</p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Address :</u></label>
            <p class="lead text-uppercase ">{{ $manufacturer->company_address }}</p>
            </div>
            <div class="form-group col-md-3">
            <label  class="font-weight-bold" ><u>Registeration Number :</u></label>
            <p class="lead text-uppercase ">{{ $manufacturer->company_registration_no }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label  class="font-weight-bold" ><u>Registeration Date :</u></label>
                <p class="lead text-uppercase ">{{ $manufacturer->registration_date }}</p>
            </div>
        </div>
        
       
    </form>

</main>
@endsection