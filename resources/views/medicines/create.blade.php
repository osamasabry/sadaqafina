@extends('layouts.adminlayout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Medicines / Create </h1>
    </div>
    <script src="/Admin/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="/Admin/vaild.js" type="text/javascript"></script>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Case Name</label>
                       <span style="color:red; margin-left: 10px;">*</span>
                    <input required type="text" class="form-control" id="name-field" rows="3" name="name"/>{{ old("name") }}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('address')) has-error @endif">
                       <label for="address-field">Case Address</label>
                       <span style="color:red; margin-left: 10px;">*</span>
                    <input required type="text" class="form-control" id="address-field" rows="3" name="address"/>{{ old("address") }}
                       @if($errors->has("address"))
                        <span class="help-block">{{ $errors->first("address") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('birthdate')) has-error @endif">
                       <label for="birthdate-field">Case BirthDate</label>
                    <input required type="date" id="birthdate-field" name="birthdate" class="form-control" value="{{ old("birthdate") }}"/>
                       @if($errors->has("birthdate"))
                        <span class="help-block">{{ $errors->first("birthdate") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="governorate_id_field">Governorate Name </label>
                       <span style="color:red; margin-left: 10px;">*</span>
                      <select required name="governorate_id" id="governorate_id_field" class="form-control">
                          @foreach ($governorates as $key => $value)
                              <option value="{{ $key+1 }}">{{ $value['name'] }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="city_id_field">City Name </label>
                       <span style="color:red; margin-left: 10px;">*</span>
                      <select required name="city_id" id="city_id_field" class="form-control">
                          @foreach ($cities as $key => $value)
                              <option value="{{ $key+1 }}">{{ $value['name'] }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group @if($errors->has('gender')) has-error @endif">
                       <label for="gender-field">Case Gender</label>
                    <input required type="text" id="gender-field" name="gender" class="form-control" value="{{ old("gender") }}"/>
                       @if($errors->has("gender"))
                        <span class="help-block">{{ $errors->first("gender") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('maritalstatus')) has-error @endif">
                       <label for="maritalstatus-field">Case Marital Status</label>
                    <input required type="text" id="maritalstatus-field" name="maritalstatus" class="form-control" value="{{ old("maritalstatus") }}"/>
                       @if($errors->has("maritalstatus"))
                        <span class="help-block">{{ $errors->first("maritalstatus") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                       <label for="phone-field">Case Phone</label>
                    <input required type="text" id="phone-field" name="phone" class="form-control" value="{{ old("phone") }}"/>
                       @if($errors->has("phone"))
                        <span class="help-block">{{ $errors->first("phone") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="interval_type_id_field">Interval Type </label>
                      <select required name="interval_type_id" id="interval_type_id_field" class="form-control">
                          @foreach ($interval_types as $key => $value)
                              <option value="{{ $key+1 }}">{{ $value['type'] }}</option>
                          @endforeach
                      </select>
                    </div>

                <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Medicine Name</label>
                       <span style="color:red; margin-left: 10px;">*</span>
                    <input required type="text" id="name-field" name="name" class="form-control" value="{{ old("name") }}"/>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('amount')) has-error @endif">
                       <label for="amount-field">Medicine Amount</label>
                       <span style="color:red; margin-left: 10px;">*</span>
                    <input required type="text" id="amount-field" name="amount" class="form-control" value="{{ old("amount") }}"/>
                       @if($errors->has("amount"))
                        <span class="help-block">{{ $errors->first("amount") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                    <label for="case_doc_field">Case Documents</label>
                       <span style="color:red; margin-left: 10px;">*</span>
                    <input type="file" id="case_doc_field" name="case_doc" required value="{{ old("case_doc") }}"/>
                       @if($errors->has("case_doc"))
                        <span class="help-block">{{ $errors->first("case_doc") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('medicines.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
