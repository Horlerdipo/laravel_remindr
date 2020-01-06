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
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Remindr</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($pending)}}</div>
                            </div>
                            
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed Remindr</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($complete)}}</div>
                            </div>
                            
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-smile fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Deleted Remindr</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            @if(!empty($deleted))
                                <span>{{$deleted[0]['count']}}</span>
                            @else
                                <span>0</span>
                            @endif
                            </div>
                            </div>
                            
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-recycle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>




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
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$reminder->location}}</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$reminder->time}}</div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
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

