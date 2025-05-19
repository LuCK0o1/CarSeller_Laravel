@props([
    'action'=>route('car.search'), 
    'method'=>'GET',
    'makers'=>null,
    'carTypes'=>null,
    'fuelTypes'=>null,
    'states'=>null,
    ])
<section class="find-a-car">
    <div class="container">
        <form
        action="{{$action}}"
        method="{{$method}}"
        class="find-a-car-form card flex p-medium"
        >
        <div class="find-a-car-inputs">
            <div>
            <select id="makerSelect" name="maker_id">
                <option value="">Maker</option>
                @if ($makers->count() > 0)
                    @foreach ($makers as $maker)
                        <option value="{{$maker->id}}">{{$maker->name}}</option>
                    @endforeach
                @endif
            </select>
            </div>
            <div>
            <select id="modelSelect" name="model_id">
                <option value="" style="display: block">Model</option>
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
            <div>
            <select id="stateSelect" name="state_id">
                <option value="">State/Region</option>
                @if ($states->count() > 0)
                    @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                @endif
            </select>
            </div>
            <div>
            <select id="citySelect" name="city_id">
                <option value="" style="display: block">City</option>
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
            <div>
            <select name="car_type_id">
                <option value="">Type</option>
                @if ($carTypes->count() > 0)
                    @foreach ($carTypes as $type)
                    
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    
                    @endforeach
                @endif
            </select>
            </div>
            <div>
            <input type="number" placeholder="Year From" name="year_from" />
            </div>
            <div>
            <input type="number" placeholder="Year To" name="year_to" />
            </div>
            <div>
            <input
                type="number"
                placeholder="Price From"
                name="price_from"
            />
            </div>
            <div>
            <input type="number" placeholder="Price To" name="price_to" />
            </div>
            <div>
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
        <div>
            <button type="button" class="btn btn-find-a-car-reset">
            Reset
            </button>
            <button class="btn btn-primary btn-find-a-car-submit">
            Search
            </button>
        </div>
        </form>
    </div>
</section>