<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\message;
use App\Models\event;
use App\Models\cause;
use App\Models\blog;
use Carbon\Carbon;


use Illuminate\Support\Facades\Redirect;

class GuestController extends Controller
{
    //


    // add memebers

    public function index()
    {
        // return view('home');


        // return view('causes');
        $member=member::where('email','=',request('email'))->get();

        if(count($member)<1){

            $member_details= new member();

            $member_details->fullname=request('fullname');
            $member_details->location=request('location');
            $member_details->phone_no=request('phone_no');
            $member_details->email=request('email');
            $member_details->save();

            return Redirect::back()->with('success', 'Your information has been submitted successfully!');


        }

        else{

            return Redirect::back()->with('error', 'Account already registered');
            
        }






    }

    // add messages

    public function message()
    {

        $message=message::where('email','=',request('email'))->where('message','=',request('message'))->get();

        if(count($message)<1)
        {

            $messages= new message();

            $messages->fullname=request('fullname');
            $messages->email=request('email');

            $messages->message=request('message');

            $messages->save();

            return Redirect::back()->with('success','Thanks for getting in touch');



        }

        else{

            return Redirect::back();

        }



    }



// show all eventes
    public function show()
    {

        // $Events=new event();


        $events=event::all();
         return view('events')->with('all_events',$events);




         
    }

// show specific events
public function eventquery()
{

    $id=request('id');


    $event=event::where("id","=",$id)->get();

    return view('eventsexpanded')->with('event',$event);
}



public function showCause(){

    $causes=cause::all();



    return view('causes')->with('all_causes',$causes);
}


public function singleCause()
{

    $id=request('id');

    $cause=cause::where("id","=",$id)->get();
    $relatedCauses = cause::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();

    return view('causesexpanded')->with('cause',$cause)->with('all_cause',$relatedCauses);


}


public function blog()
{



$blogs=blog::all();

return view('blogs')->with('all_blogs',$blogs);


}



public function singleBlog()
{
    $id=request('id');

    $blog=blog::where("id","=",$id)->get();
    $relatedBlogs = blog::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();
return view('blogsexpanded')->with('blog',$blog)->with('all_blogs',$relatedBlogs);


}



public function welcome ()
{

    $today = Carbon::now()->startOfDay();


    $events=event::where("event_date",">",$today)->limit(2)->get();

    return view('welcome')->with('events',$events);

}


}
