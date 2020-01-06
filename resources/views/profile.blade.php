@extends('layouts.dashboard')
@section('title','Profile')



@section('content')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                    <div class="card-body">
                        <form action="{{route('profile_remindr')}}" method="POST">
                            @csrf
                            
                            <div class="form-label">
                                <label for="location"><h5><b> Name:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" aria-describedby="emailHelp" name="name" value="{{ $user[0]['name'] }}" required >
                            </div>

                            @error('name')
                                <br>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                            <div class="form-label">
                                <label for="time"><h5><b> Email:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="email" value="{{ $user[0]['email'] }}" required >
                            </div>

                            @error('email')
                                <br>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="form-label">
                                <label for="number"><h5><b> Number:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="number" aria-describedby="emailHelp" name="number" value="{{ $user[0]['number'] }}" required >
                            </div>

                            @error('number')
                                <br>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

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