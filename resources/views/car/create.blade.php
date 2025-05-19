<x-app-layout title="Add Car">
    <main>
    <div class="container-small">
        <h1 class="car-details-page-title">Add new car</h1>
        <form
            action="{{route('car.store')}}"
            method="POST"
            enctype="multipart/form-data"
            class="card add-new-car-form"
        >
        @csrf
        <div class="form-content">
            <div class="form-details">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Maker</label>
                        <select id="makerSelect" name="maker_id">
                            <option value="">Maker</option>
                            @if ($makers->count() > 0)
                                @foreach ($makers as $maker)
                                    <option value="{{$maker->id}}">{{$maker->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <p class="error-message">This field is required</p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Model</label>
                        <select id="modelSelect" name="model_id">
                        <option value="">Model</option>
                            @if ($makers->count() > 0)
                                @foreach ($makers as $maker)
                                    @if ($maker->models()->count() > 0)
                                        @foreach ($maker->models as $model)
                                            <option value="{{$model->id}}" data-parent="{{$maker->id}}" style="display: none">
                                                {{$model->name}}
                                            </option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Year</label>
                        <select id="yearSelect" name="year">
                        <option value="">Year</option>
                            @for ($y = 1970; $y < 2026; $y++)
                                <option value="{{$y}}">{{$y}}</option>
                            @endfor
                        
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="mb-medium">Type</label>
                        <select name="car_type_id">
                            <option value="">Type</option>
                            @if ($carTypes->count() > 0)
                            @foreach ($carTypes as $type)
                            
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" placeholder="Price" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Vin Code</label>
                        <input type="text" name="vin" placeholder="Vin Code" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Mileage (ml)</label>
                        <input type="text" name="mileage" placeholder="Mileage" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="mb-medium">Fuel Type</label>
                        <select name="fuel_type_id">
                            <option value="">Fuel Type</option>
                            @if ($fuelTypes->count() > 0)
                                @foreach ($fuelTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>   
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label>State/Region</label>
                    <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        @if ($states->count() > 0)
                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>City</label>
                    <select id="citySelect" name="city_id">
                        <option value="">City</option>
                        @if ($states->count() > 0)
                            @foreach ($states as $state)
                                @if ($state->cities()->count() > 0)
                                    @foreach ($state->cities as $city)
                                        <option value="{{$city->id}}" data-parent="{{$state->id}}" style="display: none">
                                            {{$city->name}}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label>Address</label>
                    <input name="address" placeholder="Address" />
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" placeholder="Phone" />
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col">
                    <label class="checkbox">
                    <input
                        type="checkbox"
                        name="air_conditioning"
                        value="1"
                    />
                    Air Conditioning
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="power_windows" value="1" />
                    Power Windows
                    </label>

                    <label class="checkbox">
                    <input
                        type="checkbox"
                        name="power_door_locks"
                        value="1"
                    />
                    Power Door Locks
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="abs" value="1" />
                    ABS
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="cruise_control" value="1" />
                    Cruise Control
                    </label>

                    <label class="checkbox">
                    <input
                        type="checkbox"
                        name="bluetooth_connectivity"
                        value="1"
                    />
                    Bluetooth Connectivity
                    </label>
                </div>
                <div class="col">
                    <label class="checkbox">
                    <input type="checkbox" name="remote_start" value="1" />
                    Remote Start
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="gps_navigation" value="1" />
                    GPS Navigation System
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="heated_seats" value="1" />
                    Heated Seats
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="climate_control" value="1" />
                    Climate Control
                    </label>

                    <label class="checkbox">
                    <input
                        type="checkbox"
                        name="rear_parking_sensors"
                        value="1"
                    />
                    Rear Parking Sensors
                    </label>

                    <label class="checkbox">
                    <input type="checkbox" name="leather_seats" value="1" />
                    Leather Seats
                    </label>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label>Detailed Description</label>
                <textarea name="description" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label class="checkbox">
                <input type="checkbox" name="published" />
                Published
                </label>
            </div>
            </div>
            <div class="form-images">
            <div class="form-image-upload">
                <div class="upload-placeholder">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 48px"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                </svg>
                </div>
                <input id="carFormImageUpload" name="images[]" type="file" multiple />
            </div>
            <div id="imagePreviews" class="car-form-images"></div>
            </div>
        </div>
        <div class="p-medium" style="width: 100%">
            <div class="flex justify-end gap-1">
            <button 
                type="button" 
                class="btn btn-default"
                id="searchResetBtn"
                value="{{route('car.create')}}">
                Reset
            </button>
            <button class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
    </main>
</x-app-layout>
