@extends('manufacturer.layouts.template')
@section('page-title','Vehicals')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Add new vehical</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('manufacturer.admin.view.vehicals')}}">Vehicals</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Vehical</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <!-- <button type="button" class="btn btn-primary">Large button</button> -->
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('manufacturer.admin.store.vehical')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputModel">Model <span class="text-danger">*</span></label>
            @if($errors->has('model'))
                <div class="text-danger">{{ $errors->first('model') }}</div>
            @endif
            <input type="text" name="model" value="{{old('model')}}" class="form-control" id="inputModel" placeholder="Vehical Model">
            </div>
            
            <div class="form-group col-md-6">
            <label for="inputColor">Color <span class="text-danger">*</span></label>
            @if($errors->has('color'))
                <div class="text-danger">{{ $errors->first('color') }}</div>
            @endif
            <input type="text" name="color" value="{{old('color')}}" class="form-control" id="inputColor" placeholder="Vehical Color">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputMaker">Maker <span class="text-danger">*</span></label>
            @if($errors->has('maker'))
                <div class="text-danger">{{ $errors->first('maker') }}</div>
            @endif
            <input type="text" name="maker" value="{{old('maker')}}" class="form-control" id="inputMaker" placeholder="Maker Name">
            </div>
            <div class="form-group col-md-6">
            <label for="inputEngine">Engine Number <span class="text-danger">*</span></label>
            @if($errors->has('engine_number'))
                <div class="text-danger">{{ $errors->first('engine_number') }}</div>
            @endif
            <input type="text" name="engine_number" value="{{old('engine_number')}}" class="form-control" id="inputEngine" placeholder="Engine Number">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputChassis">Chassis Number <span class="text-danger">*</span></label>
            @if($errors->has('chassis_number'))
                <div class="text-danger">{{ $errors->first('chassis_number') }}</div>
            @endif
            <input type="text" name="chassis_number" value="{{old('chassis_number')}}" class="form-control" id="inputChassis" placeholder="Chassis Number">
            </div>
            <div class="form-group col-md-6">
            <label for="inputCapacity">Engine Capacity <span class="text-danger">*</span></label>
            @if($errors->has('engine_capacity'))
                <div class="text-danger">{{ $errors->first('engine_capacity') }}</div>
            @endif
            <input type="text" name="engine_capacity" value="{{old('engine_capacity')}}" class="form-control" id="inputCapacity" placeholder="Engine Capacity">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputClass">Class <span class="text-danger">*</span></label>
            @if($errors->has('class'))
                <div class="text-danger">{{ $errors->first('class') }}</div>
            @endif
            <input type="text" name="class" value="{{old('class')}}" class="form-control" id="inputClass" placeholder="Vehical Class">
            </div>
            <div class="form-group col-md-6">
            <label for="inputTransmission">Transmission <span class="text-danger">*</span></label>
            @if($errors->has('transmission'))
                <div class="text-danger">{{ $errors->first('transmission') }}</div>
            @endif
            <input type="text" name="transmission" value="{{old('transmission')}}" class="form-control" id="inputTransmission" placeholder="Transmission">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="inputInterior">Interior Features</label>
            @if($errors->has('interior_features'))
                <div class="text-danger">{{ $errors->first('interior_features') }}</div>
            @endif
            <textarea class="form-control" name="interior_features" value="{{old('interior_features')}}" id="inputInterior" placeholder="Interior Features" rows="6"></textarea>
            </div>
            <div class="form-group col-md-4">
            <label for="inputExterior">Exterior Features</label>
            @if($errors->has('exterior_features'))
                <div class="text-danger">{{ $errors->first('exterior_features') }}</div>
            @endif
            <textarea class="form-control" name="exterior_features" value="{{old('exterior_features')}}" id="inputExterior" placeholder="Exterior Features" rows="6"></textarea>
            </div>
            <div class="form-group col-md-4">
            <label for="inputSafety">Safety</label>
            @if($errors->has('safety'))
                <div class="text-danger">{{ $errors->first('safety') }}</div>
            @endif
            <textarea class="form-control" name="safety" value="{{old('safety')}}" id="inputSafety" placeholder="Safety Features" rows="6"></textarea>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputFuel">Fuel Type <span class="text-danger">*</span></label>
            @if($errors->has('fuel_type'))
                <div class="text-danger">{{ $errors->first('fuel_type') }}</div>
            @endif
            <input type="text" name="fuel_type" value="{{old('fuel_type')}}" class="form-control" id="inputFuel" placeholder="Fuel Type">
            </div>

            <div class="form-group col-md-6">
            <label for="inputSeating">Seating Capacity <span class="text-danger">*</span></label>
            @if($errors->has('seating_capacity'))
                <div class="text-danger">{{ $errors->first('seating_capacity') }}</div>
            @endif
            <input type="text" name="seating_capacity" value="{{old('seating_capacity')}}" class="form-control" id="inputSeating" placeholder="Seating Capacity">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

</main>
@endsection