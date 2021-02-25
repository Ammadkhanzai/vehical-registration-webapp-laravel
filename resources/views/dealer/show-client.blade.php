
@extends('dealer.layouts.template')
@section('page-title','Vehicals')
@section('content')



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Clients</h1>
        
        
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dealer.admin.view.clients')}}">Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">Client Details</li>
        </ol>
    </nav>
    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <button type="button" class="btn btn-primary">Large button</button>
    </div> -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- <h2>Current Vehicals Table</h2> -->
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <tbody>
        
                <tr>
                    <td class="w-25">
                        <b>{{  __('Name')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->first_name.' '.$user->last_name }}
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <b>{{  __('phone')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->phone }}
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <b>{{  __('Nationality')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->nationality }}
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <b>{{  __('Current Address')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->current_address }}
                    </td>
                </tr>       
                <tr>
                    <td class="w-25">
                        <b>{{  __('Postal Address')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->postal_address }}
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <b>{{  __('City')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->city }}
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <b>{{  __('State')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->state }}
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <b>{{  __('Zip')  }}</b>                            
                    </td>
                    <td class="w-75">
                        {{ $user->zip }}
                    </td>
                </tr>
        </tbody>
    </table>
    </div>
</main>

@endsection