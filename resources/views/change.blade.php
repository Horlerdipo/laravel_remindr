@extends('layouts.dashboard')
@section('title','Change Password')



@section('content')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
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

            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                    <div class="card-body">
                        <form action="{{route('change_password')}}" method="POST">
                            @csrf
                            
                            <div class="form-label">
                                <label for="location"><h5><b> New Password:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="name" aria-describedby="emailHelp" name="password"  required >
                            </div>


                            <div class="form-label">
                                <label for="time"><h5><b> Confirm new Password:</b></h5></label>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="conf_password"  required >
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