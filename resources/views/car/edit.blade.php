<x-app-layout title="Edit Car">
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Update car</h1>
            <form
                action="{{route('car.update' , $car)}}"
                method="POST"
                enctype="multipart/form-data"
                class="card add-new-car-form"
            >
                @csrf
                @method('PUT')
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
                                                <option 
                                                    value="{{$maker->id}}" 
                                                    @selected($maker->id == $car->maker_id)>
                                                    {{$maker->name}}
                                                </option>
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
                                                        <option 
                                                            value="{{$model->id}}" 
                                                            data-parent="{{$maker->id}}" 
                                                            style="display: none"
                                                            @selected($model->id == $car->model_id)>
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
                                    <select name="year">
                                    <option value="">Year</option>
                                        @for ($y = 1970; $y < 2026; $y++)
                                            <option 
                                                value="{{$y}}"
                                                @selected($y == $car->year)
                                                >
                                                {{$y}}
                                            </option>
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
                                            
                                                <option 
                                                    value="{{$type->id}}"
                                                    @selected($type->id == $car->car_type_id)>
                                                    {{$type->name}}
                                                
                                                </option>
                                            
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
                                    <input value="{{$car->price}}" name="price" type="number" placeholder="Price" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input value = {{$car->vin}} name="vin" type="text" placeholder="Vin Code" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (ml)</label>
                                    <input name="mileage" value="{{$car->mileage}}" type="text" placeholder="Mileage" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="mb-medium">Fuel Type</label>
                                    <select name="fuel_type_id">
                                        <option value="">Fuel Type</option>
                                        @if ($fuelTypes->count() > 0)
                                            @foreach ($fuelTypes as $type)
                                                <option 
                                                    value="{{$type->id}}"
                                                    @selected($type->id == $car->fuel_type_id)>
                                                    {{$type->name}}
                                                </option>   
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
                                            <option 
                                                value="{{$state->id}}"
                                                @selected($state->id == $car->city->state_id)>
                                                {{$state->name}}
                                            </option>
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
                                                    <option 
                                                        value="{{$city->id}}" 
                                                        data-parent="{{$state->id}}" 
                                                        style="display: none"
                                                        @selected($city->id == $car->city_id)>
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
                                <input name="address" value="{{$car->address}}" placeholder="Address" />
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                                <label>Phone</label>
                                <input name="phone" value="{{$car->phone}}" placeholder="Phone" />
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
                                    @checked($car->features->air_conditioning)
                                />
                                Air Conditioning
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="power_windows" 
                                    @checked($car->features->power_windows)
                                    value="1" />
                                Power Windows
                                </label>

                                <label class="checkbox">
                                <input
                                    type="checkbox"
                                    name="power_door_locks"
                                    value="1"
                                    @checked($car->features->power_door_locks)
                                
                                />
                                Power Door Locks
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="abs" 
                                    value="1"
                                    @checked($car->features->abs)
                                     />
                                ABS
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="cruise_control" 
                                    value="1" 
                                    @checked($car->features->cruise_control)
                                    />
                                Cruise Control
                                </label>

                                <label class="checkbox">
                                <input
                                    type="checkbox"
                                    name="bluetooth_connectivity"
                                    value="1"
                                    @checked($car->features->bluetooth_connectivity)

                                />
                                Bluetooth Connectivity
                                </label>
                            </div>
                            <div class="col">
                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="remote_start" 
                                    value="1" 
                                    @checked($car->features->remote_start)
                                    />
                                Remote Start
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="gps_navigation" 
                                    value="1" 
                                    @checked($car->features->gps_navigation)
                                    />
                                GPS Navigation System
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="heated_seats" 
                                    value="1" 
                                    @checked($car->features->heated_seats)
                                    />
                                Heated Seats
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="climate_control" 
                                    value="1" 
                                    @checked($car->features->climate_control)
                                    />
                                Climate Control
                                </label>

                                <label class="checkbox">
                                <input
                                    type="checkbox"
                                    name="rear_parking_sensors"
                                    value="1"
                                    @checked($car->features->rear_parking_sensors)

                                />
                                Rear Parking Sensors
                                </label>

                                <label class="checkbox">
                                <input 
                                    type="checkbox" 
                                    name="leather_seats" 
                                    value="1" 
                                    @checked($car->features->leather_seats)
                                    />
                                Leather Seats
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea name="description" rows="10">{{$car->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                            <input 
                                type="checkbox" 
                                name="published"
                                @checked($car->published_at != null) />
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
                        <div id="imagePreviews" class="car-form-images">
                            @if ($car->images->count() > 0)
                                @foreach ($car->images as $image)
                                    <a href="" class="car-form-image-preview">
                                        <img src="{{$car->id > 102 ? asset('storage/' . $image->image_path) : $image->image_path }}" alt="Car Image" />
                                    </a>
                                @endforeach
                            @endif
                        </div>
                        </div>
                </div>
                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                    <button 
                        type="button" 
                        class="btn btn-default"
                        id="searchResetBtn"
                        value="{{route('car.update' , $car)}}">
                        Reset
                    </button>
                    <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>