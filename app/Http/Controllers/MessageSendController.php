<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Matakuliah;
use App\Notifications\NewMessageNotif;
use App\Pendaftar;
use App\Scheduled;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageSendController extends Controller

{
    public  function sendMessage(Request $request){
        $pendaftar=Pendaftar::whereIn('id',$request->get('pendaftar',[]))->get();
        Notification::send($pendaftar,new NewMessageNotif($request->get('message')));
    }
    
    public function sendMessageGroup(Request $request){
        $pendaftar=Matakuliah::find($request->get('matakuliah'))->pendaftar()->wherePivot('period_id',$request->get('period'))->get();
        Notification::send($pendaftar,new NewMessageNotif($request->get('message')));
    }
    
    public function sendMessageScheduler(Request $request)
    {
        $message=$request->get('message');
        $datetime=new Carbon($request->get('datetime'));

        $matakuliah = Matakuliah::find($request->get('matakuliah'));

        $pendaftar=$matakuliah->pendaftar()->wherePivot('period_id', $request->get('period'))->get();
        
        $schedule=$matakuliah->scheduled()->create([
            'message'=>$message,
            'datetime'=>$datetime
        ]);
        
        $job = new SendMessage($pendaftar,$message,$schedule);

        dispatch($job->delay($datetime)->onConnection('sync'));

        return $datetime;
    } 
}
