@extends('manufacturer.layouts.template')
@section('page-title','Vehicals')
@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Dealer Details</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('manufacturer.admin.view.dealers')}}">Dealers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dealer Details</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    </div>
    
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold"><u>Business Name :</u></label>
            <p class="lead text-uppercase ml-3">{{ $dealer->business_name }}</p>
            </div>
            
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Phone Number</u></label>
            <p class="lead text-uppercase ">{{ $dealer->business_phone }}</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>business Email :</u></label>
            <p class="lead text-uppercase ">{{ $dealer->business_email }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>business Website :</u></label>
            <p class="lead text-uppercase ">{{ $dealer->business_website }}</p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Address :</u></label>
            <p class="lead text-uppercase ">{{ $dealer->business_address }}</p>
            </div>
            <div class="form-group col-md-6">
            <label  class="font-weight-bold" ><u>Registeration Number :</u></label>
            <p class="lead text-uppercase ">{{ $dealer->business_registration_no }}</p>
            </div>
            
        </div>
        
       
    </form>

</main>
@endsection