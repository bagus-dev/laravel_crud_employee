@extends('layouts.app', ['title' => 'Employee'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i> EMPLOYEE</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('dashboard.employee.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>EMPLOYEE NAME</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name" value="{{ old('name') }}">
                            
                                @error('name')
                                    <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>EMAIL ADDRESS</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email Address" value="{{ old('email') }}">
                                
                                @error('email')
                                    <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>PHONE NUMBER</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Input Phone Number" value="{{ old('phone') }}">
                            
                                @error('phone')
                                    <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>ADDRESS</label>
                                <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Input Address">{{ old('address') }}</textarea>

                                @error('address')
                                    <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                                @enderror
                            </div>

                            <a href="{{ route('dashboard.employee.index') }}" class="btn btn-warning"><i class="fa fa-arrow-alt-circle-left"></i> BACK TO LIST</a>
                            <button type="submit" class="btn btn-primary mr-1 btn-submit"><i class="fa fa-save"></i> SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection