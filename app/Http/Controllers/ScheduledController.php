<?php

namespace App\Http\Controllers;

use App\Matakuliah;
use App\Scheduled;
use App\Template;
use Illuminate\Http\Request;

class ScheduledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $scheduled = Scheduled::latest()->paginate(10)->appends($request->input());
               return view('content.schedule.schedule',compact('scheduled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.schedule.create');
    }
    
    public function send()
    {
        Notification::send($pendaftar, new NewMessageNotif($message));
    }

    public function destroy($id){
        Scheduled::find($id)->delete();
        return redirect()->route('cschedule.index');
    }
}
