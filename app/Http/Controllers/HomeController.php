<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\task;
use Hash;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $showtask=task::all();

        return view('dashboard.index',compact('showtask'));
    }

    public function home()
    {

        return view('auth.login');
    }

    public function addtask(Request $request)
    {

 $add= new task();
        $add->task=$request->task;
        $save=$add->save();
        if(!$save){
        return Response()->json('false');

        } else{
          return Response()->json('true');
        }

    }


    public function edittask(Request $request)
    {

 $save= task::where('id',$request->taskid)->update(['task'=>$request->task]);

        if(!$save){
        return Response()->json('false');

        } else{
          return Response()->json('true');
        }

    }

    public function delete($id)
    {
        // return $id;
        $del=task::where('id', $id)->delete();
        if(!$del)
        {
            return back()->with('failed','could not delete task');

        }

        return back()->with('success','Task deleted successfully');

    }

    public function logout()
    {
 if(Session::has('loginid')){
 Session::pull('loginid');
 return redirect('auth.login')->with('failed', 'You just logout');


 }

    }
}
