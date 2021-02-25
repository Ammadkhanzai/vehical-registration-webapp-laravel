@extends('user.layouts.template')
@section('page-title','Vehicals')
@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Vehical Details</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.admin.view.vehicals')}}">Vehicals</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehical Details</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    </div>
    
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputModel">Model</label>
            <input type="text" name="model" value="{{ __($vehical->fetchVehical->model) }}" class="form-control" id="inputModel" placeholder="Vehical Model" disabled >
            </div>
            
            <div class="form-group col-md-6">
            <label for="inputColor">Color</label>
            <input type="text" name="color" value="{{ __($vehical->fetchVehical->color) }}" class="form-control" id="inputColor" placeholder="Vehical Color" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputMaker">Maker</label>
            <input type="text" name="maker" value="{{ __($vehical->fetchVehical->maker) }}" class="form-control" id="inputMaker" placeholder="Maker Name" disabled>
            </div>
            <div class="form-group col-md-6">
            <label for="inputEngine">Engine Number</label>
            <input type="text" name="engine_number" value="{{ __($vehical->fetchVehical->engine_number) }}" class="form-control" id="inputEngine" placeholder="Engine Number" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputChassis">Chassis Number</label>
            <input type="text" name="chassis_number" value="{{ __($vehical->fetchVehical->chassis_number) }}" class="form-control" id="inputChassis" placeholder="Chassis Number" disabled>
            </div>
            <div class="form-group col-md-6">
            <label for="inputCapacity">Engine Capacity</label>
            <input type="text" name="engine_capacity" value="{{ __($vehical->fetchVehical->engine_capacity) }}" class="form-control" id="inputCapacity" placeholder="Engine Capacity" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputClass">Class</label>
            <input type="text" name="class" value="{{ __($vehical->fetchVehical->vehical_class) }}" class="form-control" id="inputClass" placeholder="Vehical Class" disabled>
            </div>
            <div class="form-group col-md-6">
            <label for="inputTransmission">Transmission</label>
            <input type="text" name="transmission" value="{{ __($vehical->fetchVehical->transmission) }}" class="form-control" id="inputTransmission" placeholder="Transmission" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="inputInterior">Interior Features</label>
            <textarea class="form-control" name="interior_features"  id="inputInterior" placeholder="Interior Features" rows="6" disabled>{{ __($vehical->fetchVehical->interior_features) }}</textarea>
            </div>
            <div class="form-group col-md-4">
            <label for="inputExterior">Exterior Features</label>
            <textarea class="form-control" name="exterior_features"  id="inputExterior" placeholder="Exterior Features" rows="6" disabled>{{ __($vehical->fetchVehical->exterior_features) }}</textarea>
            </div>
            <div class="form-group col-md-4">
            <label for="inputSafety">Safety</label>
            
            <textarea class="form-control" name="safety"  id="inputSafety" placeholder="Safety Features" rows="6" disabled>{{ __($vehical->fetchVehical->safety) }}</textarea>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputFuel">Fuel Type</label>
            <input type="text" name="fuel_type" value="{{ __($vehical->fetchVehical->fuel_type) }}" class="form-control" id="inputFuel" placeholder="Fuel Type" disabled>
            </div>

            <div class="form-group col-md-6">
            <label for="inputSeating">Seating Capacity</label>
            <input type="text" name="seating_capacity" value="{{ __($vehical->fetchVehical->seating_capacity) }}" class="form-control" id="inputSeating" placeholder="Seating Capacity" disabled>
            </div>
        </div>
    </form>

</main>
@endsection