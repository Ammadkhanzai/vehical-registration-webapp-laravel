@extends('dealer.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
    <div class="col-md-12">
		    <div class="">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Profile</h4>
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
                    <?php if($errors->any()): ?>
                        <div class="form-group">
                            
                        <?php foreach($errors->all() as $error ): ?>
                            <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                        <?php endforeach;?>
                            
                        </div>
                    <?php endif; ?>
                    
		                    <form action="{{ route('dealer.admin.update.dealer-profile') }}" method="POST">
                        @method('POST')
                        @csrf
                        
                              <div class="form-group row d-block">
                                <label for="name" class="col-12 col-form-label">Business Name <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="name" name="name" value="{{ old('name') ? old('name') : __($userModel->business_name) }}" placeholder="Business Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="email" class="col-12 col-form-label">Business Email <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="email" name="email" value="{{ old('email') ? old('email') : __($userModel->business_email) }}" placeholder="Business Email" class="form-control here" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="phone" class="col-12 col-form-label">Business Phone <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="phone" name="phone" value="{{ old('phone') ? old('phone') : __($userModel->business_phone) }}" placeholder="Business Phone" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="wesite" class="col-12 col-form-label">Business Website <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="website" name="website" value="{{ old('website') ? old('website') : __($userModel->business_website) }}" placeholder="Business Website" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="address" class="col-12 col-form-label">Business Address <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <textarea id="address" name="address" class="form-control">{{ old('address') ? old('address') : __($userModel->business_address) }}</textarea>
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