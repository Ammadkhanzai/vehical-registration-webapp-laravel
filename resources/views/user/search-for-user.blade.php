@extends('user.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
    <div class="col-md-12">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4><b>Transfer Vehical</b></h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-6">
                        <div class="form-group">
                          <div id="success" class="alert alert-success" style="display:none"></div>
                          <div id="error" class="alert alert-danger"  style="display:none" role="alert"></div>
                        </div>
                    <style>
                      .ajax-image{
                          width: 25px;
                          display: none;
                          
                      }
                    </style>
		                    <form id="user-form">
                        
                        <div class="form-group row">
                          
                          <div class="col-8">
                            <label for="cnic">CNIC NUMBER</label>
                            <input name="cnic" id="cnic" type="text" class="form-control" placeholder="example:44130888408">
                            <small class="form-text text-muted">Search user by cnic number.</small>
                          </div>
                          
                        </div>
                        <div class="form-group row">
                          <div class="col-4">
                            <input id="submit-button" type="submit" class="btn btn-outline-info btn-sm" value="Search">
                            <img class="ajax-image" src="{{asset('ajax/ezgif.com-crop.gif')}}">
                          </div>
                        </div>                              
                      </form>
		                </div>
		              </div>
		            </div>
                <div class="row" id="userdetails" style="display:none;">
		                <div class="col-md-12">
		                    <h6><b>User Details</b></h6>
		                    <hr>
                        <div class="form-group row">
                          <div class="col-3">
                            <label class="m-0 p-0"><b>First Name</b></label>
                            <text class="form-text" id="firstname">Search user by cnic number.</text>
                          </div>
                          <div class="col-3">
                            <label class="m-0 p-0"><b>Middle Name</b></label>
                            <text class="form-text" id="middlename">Search user by cnic number.</text>
                          </div>
                          <div class="col-3">
                            <label class="m-0 p-0"><b>Last Name</b></label>
                            <text class="form-text" id="lastname">Search user by cnic number.</text>
                          </div>
                          <div class="col-3">
                            <label class="m-0 p-0"><b>Father Name</b></label>
                            <text class="form-text" id="fathername">Search user by cnic number.</text>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-2">
                            <label class="m-0 p-0"><b>Phone</b></label>
                            <text class="form-text" id="phone">Search user by cnic number.</text>
                          </div>
                          <div class="col-2">
                            <label class="m-0 p-0"><b>Nationality</b></label>
                            <text class="form-text" id="nationality">Search user by cnic number.</text>
                          </div>
                          <div class="col-2">
                            <label class="m-0 p-0"><b>City</b></label>
                            <text class="form-text" id="city">Search user by cnic number.</text>
                          </div>
                          <div class="col-2">
                            <label class="m-0 p-0"><b>State</b></label>
                            <text class="form-text" id="state">Search user by cnic number.</text>
                          </div>
                          <div class="col-2 ">
                            <label class="m-0 p-0"><b>Zip</b></label>
                            <text class="form-text" id="zip">Search user by cnic number.</text>
                          </div>
                
                        </div>
                        <div class="form-group row">
                          <div class="col-6">
                            <label class="m-0 p-0"><b>Current Address</b></label>
                            <text class="form-text" id="currentaddress">Search user by cnic number.</text>
                          </div>
                          <div class="col-6">
                            <label class="m-0 p-0"><b>Postal Address</b></label>
                            <text class="form-text" id="postaladdress">Search user by cnic number.</text>
                          </div>
                          
                        </div>
                        <div class="form-group row">
                          <div class="col-6">
                            <form action="{{ route('user.admin.transfer-vehical')}}" method="POST">
                            @csrf
                            @method('POST')
                              <input type="hidden" name="vehicalID" value="{{ $vehical_id }}" >
                              <input type="hidden" name="profile" value="" id="profileID">
                              <input type="submit" value="Proceed Transfer" class="btn btn-outline-success btn-sm">
                            </form>
                          </div>
                        </div>
                    </div>
		            </div>
            </div>
		  </div>
    </div>
</main>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script>
    $('document').ready(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        
        $('#user-form').submit(function(e){
          $('#userdetails').hide();
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                beforeSend: function() {
                    $('#profileID').val();
                    $('#error').hide();
                    $('#success').hide();
                    $('#submit-button').hide();
                    $('.ajax-image').css("display", "inline-block");    
                },
                url: "{{ route('user.admin.search.user')}}",
                data: form.serialize(),
                success: function (data) {
                    if(data.status == "true"){
                      $('#profileID').val(data.profile['id']);
                      $('#userdetails').show();
                      $('#firstname').text(data.profile['first_name']);
                      $('#lastname').text(data.profile['last_name']);
                      $('#middlename').text(data.profile['middle_name']);
                      $('#fathername').text(data.profile['father_name']);
                      $('#phone').text(data.profile['phone']);
                      $('#nationality').text(data.profile['nationality']);
                      $('#city').text(data.profile['city']);
                      $('#state').text(data.profile['state']);
                      $('#zip').text(data.profile['zip']);
                      $('#currentaddress').text(data.profile['current_address']);
                      $('#postaladdress').text(data.profile['postal_address']);
                    }
                    if(data.status == "false"){
                      $('#error').show().text('No result found!');
                      console.log('No result found!');
                    }                    
                },
                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function() {
                    $('.ajax-image').css("display", "none");
                    $('#submit-button').show();
                },
            });
        });
    })
</script>
@endsection