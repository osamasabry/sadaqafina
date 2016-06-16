@extends('layouts.adminlayout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
<script src="/Admin/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="/Admin/vaild.js" type="text/javascript"></script>
  <script>
      
      $(document).ready(function () {

          $('#governorate_id_field').change(function(){
                  $.get("{{ url('api/dropdown')}}", 
                      { option: $(this).val() }, 
                      function(data) {
                        console.log(data);
                          var city = $('#citySelect');
                          city.empty();
                          console.log(city.id);
                          $.each(data, function(index, element) {
                              city.append("<option value='"+ element['id'] +"'>" + element['name'] + "</option>");
                          });
                      });
              });
        });
    </script>
    
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> People / Edit #{{$person->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('people.update', $person->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


              <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Name</label>
                    <textarea class="form-control" id="name-field" rows="3" name="name">{{ $person->personInfo->name }}</textarea>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('address')) has-error @endif">
                       <label for="address-field">Address</label>
                    <textarea class="form-control" id="address-field" rows="3" name="address">{{ $person->personInfo->address }}</textarea>
                       @if($errors->has("address"))
                        <span class="help-block">{{ $errors->first("address") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('birthdate')) has-error @endif">
                       <label for="birthdate-field">BirthDate</label>
                    <input type="text" id="birthdate-field" name="birthdate" class="form-control" value="{{ $person->personInfo->birthdate }}"/>
                       @if($errors->has("birthdate"))
                        <span class="help-block">{{ $errors->first("birthdate") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="governorate_id_field">Governorate Name </label>
                      <select name="governorate_id" id="governorate_id_field">
                         @foreach ($governorates as $key => $value)
                              @if($value["name"] == $person->personInfo->governorate->name )
                                <option value="{{ $key+1 }}" selected>{{ $value["name"] }}</option>
                              @else
                                <option value="{{ $key+1 }}">{{ $value["name"] }}</option>
                              @endif
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="city_id_field">City Name </label>
                      <select required name="city_id" id="citySelect" class="form-control">
                          <option value="$person->personInfo->city->id">{{$person->personInfo->city->name}}</option>
                          <option></option>
                            
                      </select>
                    <div class="form-group @if($errors->has('gender')) has-error @endif">
                       <label for="gender-field">Gender</label>
                     <select required id="gender-field" name="gender" class="form-control">
                        @if ( $person->personInfo->gender == "male")
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        @else
                            <option value="male">male</option>
                            <option value="female" selected>female</option>
                        @endif
                    </select>
                    </div>
                    <div class="form-group @if($errors->has('maritalstatus')) has-error @endif">
                       <label for="maritalstatus-field">Maritalstatus</label>
                    <select required type="text" id="maritalstatus-field" name="maritalstatus" class="form-control">
                    @if($person->personInfo->maritalstatus == "single")
                        <option value="single" selected>Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widow">Widow</option>
                    @elseif($person->personInfo->maritalstatus == "married")
                        <option value="single">Single</option>
                        <option value="married" selected>Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widow">Widow</option>
                    @elseif($person->personInfo->maritalstatus == "divorced")
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced" selected>Divorced</option>
                        <option value="widow">Widow</option>
                    @else
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widow" selected>Widow</option>
                    @endif
                    </select>
                       @if($errors->has("maritalstatus"))
                        <span class="help-block">{{ $errors->first("maritalstatus") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                       <label for="phone-field">Phone</label>
                    <input type="text" id="phone-field" name="phone" class="form-control" value="{{ $person->personInfo->phone }}"/>
                       @if($errors->has("phone"))
                        <span class="help-block">{{ $errors->first("phone") }}</span>
                       @endif
                    </div>
                <div class="form-group @if($errors->has('publishat')) has-error @endif">
                       <label for="publishat-field">Publishat</label>
                    <input type="text" id="publishat-field" name="publishat" class="form-control" value="{{ $person->publishat }}" disabled/>
                       @if($errors->has("publishat"))
                        <span class="help-block">{{ $errors->first("publishat") }}</span>
                       @endif
                    </div>
                <div class="form-group">
                      <label for="donation_type_id_field">Donation Type </label>
                      <select name="donation_type_id" id="donation_type_id_field" disabled>
                          @foreach ($donate_types as $key => $value)
                              <option value="{{ $key+1 }}">
                              {{ $person->donationType->type }}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="interval_type_id_field">Interval Type </label>
                      <select name="interval_type_id" id="interval_type_id_field" disabled>
                          @foreach ($interval_types as $key => $value)
                              @if($value['type'] == $person->intervalType->type )
                                <option value="{{ $person->intervalType->id }}" selected>{{ $person->intervalType->type }}</option>
                              @else
                                <option value="{{ $key+1 }}">{{ $value['type']}}</option>
                              @endif
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group @if($errors->has('amount')) has-error @endif">
                       <label for="amount-field">Donation Money Amount</label>
                    <input type="text" id="amount-field" name="amount" class="form-control" value="{{ old("amount") }}"/>
                       @if($errors->has("amount"))
                        <span class="help-block">{{ $errors->first("amount") }}</span>
                       @endif
                    </div>




                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('people.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
