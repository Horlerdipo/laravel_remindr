@extends('layouts.dashboard')
@section('title','Dashboard')


@section('content')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <span class="h6 mb-0">Welcome {{Auth::user()->name}}</span>
        </div>

        <div class ="row">
            

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pending Remindrs</h6>
                  
                </div>
                
                <div class="card-body">
                  



                    <div class="row">
                    @foreach($pending as $reminder)
                        

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-bottom-danger shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$reminder->location}}</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" >
                                            <div class="editing" href="#"  data-toggle="modal" data-target="#editModal" id="{{$reminder->id}}" onclick="event.preventDefault();document.getElementById('logout-form-{{$reminder->id}}').submit();">
                                                {{$reminder->time}}<i class="fas fa-recycle fa-sm fa-fw mr-2 text-gray-400 edit-button"></i>
                                            </div>

                                            <form id="logout-form-{{$reminder->id}}" action="{{ route('delete_remindr') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="text" value="{{$reminder->id}}" name="id">
                                            </form>

                                        </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </div>


                </div>
              </div>
            </div>




        </div>

@endsection

@section('active_delete','active')





