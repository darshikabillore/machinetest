<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\UserTherapist;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user,UserTherapist $usertherapist)
    {
        $this->user = $user;
        $this->usertherapist =$usertherapist;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $user = $this->user->orderBy('id','desc')->get();
            $therapist = $this->user->where('type','1')->orderBy('id','desc')->get();
            return view('home',compact('user','therapist'));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
    public function addUser(Request $data)
    {


        try
        {
            // dd($data->all());
            $newUser = $this->user->updateOrCreate([
                'email' => $data['email'],
            ],[
               'email' => $data['email'],
                'name' => $data['name'],
                'type' => (int)$data['type'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
            ]);
           
            $newUser->save();
            if($data['therapist'] != null){
               $therapist = $this->usertherapist->create([
                    'user_id' => (int)$data['therapist'],
                   ]);
               $therapist->save();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
   
    public function delete($id)
    {
        try
        {
            $this->user->where('id',$id)->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

}
