@extends('dealer.layouts.template')
@section('page-title','Home | Dashboard')
@section('content')


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
<form>
  <div class="form-group">
    <label for="cnic">SEARCH CNIC NUMBER</label>
    <input type="text" class="form-control" onkeyup="myFunction()" id="search" aria-describedby="cnicHelp" placeholder="example:44130888408">
    <small id="cnicHelp" class="form-text text-muted">Search user by cnic number.</small>
  </div>
</form>
<div class="table-responsive">
    <table class="table table-striped table-sm" id="myTable">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Cnic Number</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        </thead>
        
        @foreach($userProfile as $user)
        <tr>
            <td>{{ __($loop->iteration) }}</td>
            <td>{{ __($user->first_name.' '.$user->last_name) }} </td>
            <td>{{ __($user->getusers->cnic) }}</td>
            <td>{{ __($user->phone) }}</td>
            <td class="w-25">{{ __($user->current_address) }}</td>
            <td class="w-25">
            <a href="{{route('dealer.admin.transfer.vehicals.proceed',$user->id)}}"><button type="button" class="btn btn-outline-success btn-sm">Transfer Vehicals</button></a>
            </td> 
        </tr>
        @endforeach
        
        
    </table>
    </div>
</main>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

@endsection