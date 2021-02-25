@extends('manufacturer.layouts.template')
@section('page-title','Home | Dashboard')
@section('head')
@endsection
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Transfer Vehicals</h1>
    <!-- <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary">Share</button>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
        </button>
    </div> -->
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('manufacturer.admin.view.dealers')}}">Dealers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transfer Vehicals</li>
        </ol>
    </nav>
    
    <h2>Current Vehicals</h2>
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Engine Number</th>
            <th>Class</th>            
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @isset($vehicals)
        @foreach ($vehicals as $vehical)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $vehical->vehical->model }}</td>
            <td>{{ $vehical->vehical->engine_number }}</td>
            <td>{{ $vehical->vehical->vehical_class }}</td>
            <style>
                .ajax-image{
                    width: 50%;
                    display: block;
                    margin: 0 auto;
                    margin-top: 3px;
                }
                .ajax-div{
                    display:none;
                }
            </style>
            <td class="d-flex">
                
                <form class="transfer-vehical-form">
                
                <input type="hidden" name="vehicalID" value="{{ $vehical->id }}">
                <input type="hidden" name="dealerID" value="{{ $dealerID }}" >
                <button type="submit" class="btn btn-outline-success btn-sm">Proceed Transfer</button>                
                </form>
                <div class="ajax-div">
                    <img class="ajax-image" src="{{asset('ajax/ezgif.com-crop.gif')}}">
                </div>
            </td> 
        </tr>
        @endforeach
        @endisset
        </tbody>
    </table>
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
        
        $('.transfer-vehical-form').submit(function(e){
            var element = $( this ).parent();
            e.preventDefault();
            if(!confirm('Are you sure?')){
                return false;
            }
            var form = $(this);
            $.ajax({
                type: "POST",
                beforeSend: function() {
                    element.children('.ajax-div').css("display", "block");
                    element.children('form').remove();
                },
                url: "{{route('manufacturer.admin.store.transfer-vehical')}}",
                data: form.serialize(),
                success: function (data) {
                    if(data.status == "true"){
                        element.append("<b>Vehical Successfully Transfered.</b>");
                    }else{
                        element.append("<b>Error While Transfered.</b>");
                    }
                    console.log(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function() {
                    element.children('.ajax-div').css("display", "none");
                },
            });
        });
    })
</script>
@endsection
