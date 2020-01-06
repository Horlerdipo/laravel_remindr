<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Remindr;
use App\User;
use App\Completed;
use App\Deleted;
use Carbon\Carbon;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $remindr['reminders'] = Remindr::where('user_id', Auth::user()->id)->get();

        $remindr['pending'] = Remindr::where(['user_id'=>Auth::user()->id,'completed'=>FALSE])->get();

        $remindr['complete'] = Remindr::where(['user_id'=>Auth::user()->id,'completed'=>TRUE])->get();
        
        $remindr['deleted']=Deleted::where(['user_id'=>Auth::user()->id])->get()->toArray();

        return view('welcome',$remindr);
        
    }

    public function create(){
        return view('create');
    }


    public function profile(){


        $remindr['user'] = User::where('id', Auth::user()->id)->get()->toArray();

        return view('profile',$remindr);
    }


    public function create_remindr(Request $request){

        $input=$request->all();
        
        $request->validate([
            'location' => 'required',
            'time' => 'required',
        ]);

        $location=$input['location'];
        $timestamps=$input['time'];
        
        $remindr=new Remindr;
        $remindr->user_id=Auth::user()->id;
        $remindr->location=$location;
        $remindr->time=$timestamps;

        $remindr->save();

        return back()->with('status', 'Reminder Created Successfully');
            
    }


    public function edit_remindr(Request $request){

        $input=$request->all();
        
        $request->validate([
            'location' => 'required',
            'time' => 'required',
            'id'=>'required'
        ]);

        $location=$input['location'];
        $timestamps=$input['time'];
        $id=$input['id'];
        
        $remindr=new Remindr;
        $remindr::where(['user_id'=>Auth::user()->id,'id'=>$id])->update(['location'=>$location,'time'=>$timestamps]);


        

        return back()->with('status', 'Reminder Edited Successfully');
            
    }


    public function profile_remindr(Request $request){


        $input=$request->all();
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number'=>'required|digits:11'
        ]);
        $email=$input['email'];
        $name=$input['name'];
        $number=$input['number'];

        $remindr=new User;
        $remindr::where(['id'=>Auth::user()->id])->update(['name'=>$name,'email'=>$email,'number'=>$number]);

        return back()->with('status', 'Profile Edited Successfully');



    }



    public function edit(){


        $remindr['pending'] = Remindr::where(['user_id'=>Auth::user()->id,'completed'=>FALSE])->get();
        return view('edit',$remindr);
    }


    public function history(){


        $remindr['all'] = Remindr::where(['user_id'=>Auth::user()->id])->get();
        return view('history',$remindr);
    }


    public function delete(){

        $remindr['pending'] = Remindr::where(['user_id'=>Auth::user()->id,'completed'=>FALSE])->get();
        return view('delete',$remindr);
    }


    public function delete_remindr(Request $request){

        $input=$request->all();
        
        $request->validate([
            'id' => 'required'
        ]);

        $the_id=$input['id'];
        
        $remindr=new Remindr;
        $delete=Remindr::where('id',$the_id)->delete();

        $deleted=new Deleted;
        $deletes=Deleted::where('user_id',Auth::user()->id)->get()->toArray();

        //print_r($deletes);
        if(empty($deletes)){

            $deleted->user_id=Auth::user()->id; 
            $deleted->count=1;
            $deleted->save(); 
        }
        else{
            $count=$deletes[0]['count'];
            $deleted::where('user_id',Auth::user()->id)->update(['count'=>$count+1]);
        }

        if($delete){

            return back()->with('status', 'Reminder Deleted Successfully');
        }

        
            
    }


    public function ajax_edit(Request $request){

        $input=$request->all();
        
        $request->validate([
            'id' => 'required'
        ]);

        $the_id=$input['id'];

        $remindr=new Remindr;
        $edit=Remindr::where('id',$the_id)->get()->toArray();

        return response()->json(array('msg'=> $edit), 200);
    }

    public function password(){
        
        return view('change');
    }

    public function change_pass(Request $request){

        $input=$request->all();
        
        $request->validate([
            'password' => 'required',
            'conf_password'=>'required'
        ]);

        $pass=$input['password'];
        $conf_pass=$input['conf_password'];

        if(Auth::check() && $pass==$conf_pass){

            $user=new User;
            $user=User::where(['id'=>Auth::user()->id])->update(['password'=> Hash::make($pass)]);; 

            if($user){

                return back()->with('status', 'Password Changed Successfully');
            }

        }else{
            return  back()->with('danger', 'Passwords are not the same');;
        }
    }

    

    public function time($id){
        $current=Carbon::now();
        $time=Remindr::find($id)->toArray();
        $time=Carbon::create($time['time']);
        $add_time= $current->addMinutes(15);    
        $sub_time=$current->subMinutes(15);  
        
        if($time->greaterThan($sub_time)){

            echo $time.'is greater than'.$sub_time;
        }

        if($time->lessThan($add_time)){

            echo $time.'is less than'.$add_time;
        }



    }

}
