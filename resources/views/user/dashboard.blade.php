@extends('user.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    


    <div class="row">
    <div class="col-md-12">
		    <div class="">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4><b>User Profile</b></h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php if($errors->any()): ?>
                        <div class="form-group">
                            
                        <?php foreach($errors->all() as $error ): ?>
                            <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                        <?php endforeach;?>
                            
                        </div>
                    <?php endif; ?>
		                    <form action="{{ route('user.admin.update.user-profile') }}" method="POST">
                        @method('POST')
                        @csrf
                        
                              <div class="form-group row">
                                
                                <div class="col-4">
                                  <label> <b>First Name </b><span class="text-danger">*</span></label> 
                                  <input name="firstName" value="{{ old('firstName') ? old('firstName') : __($userModel->first_name) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-4">
                                  <label> <b>Middle Name</b> <span class="text-danger">*</span></label> 
                                  <input  name="middleName" value="{{ old('middleName') ? old('middleName') : __($userModel->middle_name) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-4">
                                  <label><b>Last Name</b> <span class="text-danger">*</span></label> 
                                  <input  name="lastName" value="{{ old('lastName') ? old('lastName') : __($userModel->last_name) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                
                                <div class="col-6">
                                  <label> <b>Father Name </b><span class="text-danger">*</span></label> 
                                  <input name="fatherName" value="{{ old('fatherName') ? old('fatherName') : __($userModel->father_name) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-6">
                                  <label> <b>Father Cnic</b> <span class="text-danger">*</span></label> 
                                  <input  name="fatherCnic" value="{{ old('fatherCnic') ? old('fatherCnic') : __($userModel->father_cnic) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                
                                <div class="col-4">
                                  <label> <b>Date of birth </b><span class="text-danger">*</span></label> 
                                  <input name="dob" value="{{ old('dob') ? old('dob') : __($userModel->dob) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-4">
                                  <label> <b>Nationality</b> <span class="text-danger">*</span></label> 
                                  <input  name="nationality" value="{{ old('nationality') ? old('nationality') : __($userModel->nationality) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-4">
                                  <label><b>Phone Number</b> <span class="text-danger">*</span></label> 
                                  <input  name="phone" value="{{ old('phone') ? old('phone') : __($userModel->phone) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                
                                <div class="col-6">
                                  <label> <b>Current Address </b><span class="text-danger">*</span></label> 
                                  <input name="currentAddress" value="{{ old('currentAddress') ? old('currentAddress') : __($userModel->current_address) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-6">
                                  <label> <b>Postal Address</b> <span class="text-danger">*</span></label> 
                                  <input  name="postalAddress" value="{{ old('postalAddress') ? old('postalAddress') : __($userModel->postal_address) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                
                                <div class="col-4">
                                  <label> <b>City</b><span class="text-danger">*</span></label> 
                                  <input name="city" value="{{ old('city') ? old('city') : __($userModel->city) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-4">
                                  <label> <b>State</b> <span class="text-danger">*</span></label> 
                                  <input  name="state" value="{{ old('state') ? old('state') : __($userModel->state) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                                <div class="col-4">
                                  <label><b>Zip</b> <span class="text-danger">*</span></label> 
                                  <input  name="zip" value="{{ old('zip') ? old('zip') : __($userModel->zip) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-4">
                                  <input type="submit" value="Update" class="btn btn-outline-success btn-sm">
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