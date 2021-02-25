@extends('manufacturer.layouts.template')
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
		                    <h4>Your Profile</h4>
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
		                    <form action="{{route('manufacturer.admin.update.manufacturer-profile',$userModel)}}" method="POST">
                        @method('PUT')
                        @csrf
                        
                              <div class="form-group row d-block">
                                <label for="name" class="col-12 col-form-label">Company Name <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="name" name="name" value="{{ old('name') ? old('name') : __($userModel->company_name) }}" placeholder="Company Name" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="email" class="col-12 col-form-label">Company Email <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="email" name="email" value="{{ old('email') ? old('email') : __($userModel->company_email) }}" placeholder="Company Email" class="form-control here" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="phone" class="col-12 col-form-label">Company Phone <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="phone" name="phone" value="{{ old('phone') ? old('phone') : __($userModel->company_phone) }}" placeholder="Company Phone" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="wesite" class="col-12 col-form-label">Company Website <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <input id="website" name="website" value="{{ old('website') ? old('website') : __($userModel->company_website) }}" placeholder="Company Website" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row d-block">
                                <label for="address" class="col-12 col-form-label">Company Address <span class="text-danger">*</span></label> 
                                <div class="col-12">
                                  <textarea id="address" name="address" class="form-control">{{ old('address') ? old('address') : __($userModel->company_address) }}</textarea>
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