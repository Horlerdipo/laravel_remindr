@extends('layouts.dashboard')
@section('title','Create Remindr')



@section('content')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Remindr</h1>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <span class="h6 mb-0">Howdy {{Auth::user()->name}},</span>
        </div>

        <div class ="row">
            <div class="col-lg-8 offset-lg-2">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Remindr</h6>
                </div>
                    <div class="card-body">
                        <form action="{{route('create_remindr')}}" method="POST">
                            @csrf
                            
                            <div class="form-label">
                                <label for="location"><h5><b> Location:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="location" aria-describedby="emailHelp" placeholder="Enter the desired location..."  name="location" value="{{ old('location') }}" required >
                            </div>


                            <div class="form-label">
                                <label for="time"><h5><b> Time:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="time" class="form-control form-control-user" id="time" aria-describedby="emailHelp" placeholder="Enter the time for the weather update..."  name="time" value="{{ old('time') }}" required >
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary btn-user offset-lg-10" type="submit">
                                    Submit
                                </button>
                                
                            </div>

                        </form>
                    </div>
                </div>
            
            </div>
        </div>
@endsection


@section('active','active')