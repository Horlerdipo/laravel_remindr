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
            
        <div class="card shadow mb-4 col-lg-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Remindr History</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>#</th>
                      <th>Location</th>
                      <th>Completed</th>
                      <th>Scheduled Time</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Location</th>
                      <th>Completed</th>
                      <th>Scheduled Time`</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php $count=0;?>
                  @foreach($all as $rem)
                  <?php $count++;?>
                    <tr>
                      <td>{{$count}}</td>
                      <td>{{$rem->location}}</td>
                      <td>
                        @if($rem->completed)
                            <p>Yes</p>
                        @else
                            <p>No</p>
                        @endif
                      </td>
                      <td>{{$rem->time}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
@endsection


@section('active_history','active')

