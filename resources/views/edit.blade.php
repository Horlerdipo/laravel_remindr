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
                            <div class="card border-bottom-primary shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$reminder->location}}</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" >
                                            <div class="editing" href="#"  data-toggle="modal" data-target="#editModal" id="{{$reminder->id}}">
                                                {{$reminder->time}}       <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400 edit-button"></i>
                                            </div>

                                        </div>
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



        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Edit?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                
                    
                    <form action="{{route('edit_remindr')}}" method="POST">
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

                        <div class="form-group">
                            <input type="text" hidden class="form-control form-control-user" id="id"   name="id" required >
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


                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            </div>
        </div>

@endsection

@section('active_edit','active')


<script src="vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(()=>{
        
        $('.editing').on('click',(e)=>{

            let id= e.currentTarget.id;

            $.ajax({
                type:'POST',
                url:'/ajaxedit',
                data:{
                    _token : '<?php echo csrf_token() ?>',
                    id:id
                    },
                success:function(data) {
                    console.log(data['msg'][0]['location']);

                    let location=data['msg'][0]['location'];
                    $('#location').val(location);

                    let time=data['msg'][0]['time'];
                    $('#time').val(time);

                    let id=data['msg'][0]['id'];
                    $('#id').val(id);
                },
                error:(e)=>{
                    console.log(e);
                }
            });
            
        })
    })
</script>

