<?php

namespace App\Http\Controllers;

use App\Matakuliah;
use App\Notifications\NewMessageNotif;
use App\Pendaftar;
use App\Period;
use App\Template;
use Illuminate\Http\Request;

class MessageGroupController extends Controller
{
    public function index(\Illuminate\Http\Request $request){
        
        $pendaftar = Pendaftar::query();
        
        // Searching
        if($query = $request->get('query')){
            $pendaftar = $pendaftar->where('npm','like',"%{$query}%")->orWhere('name','like',"%{$query}%")->orWhereHas('matakuliah',function ($q)use($query){
                $q->where('name','like',"%{$query}%");
            });
        }
        else {
            //Selection
            if($matakuliah = $request->get('jurusan')){
                $pendaftar = $pendaftar->whereHas('jurusan',function ($q)use($matakuliah){
                    $q->where('id',$matakuliah);
                });
            }
            if($period = $request->get('period')){
                $pendaftar= $pendaftar->whereHas('matakuliah',function ($q)use($period){
                    $q->where('matakuliah_asisten.period_id',$period);
                });
            }
        }

        //searching
        if($query = $request->get('query')){
            $pendaftar = $pendaftar->where('npm','like',"%{$query}%")->orWhere('name','like',"%{$query}%");
        }
        $pendaftar = $pendaftar->paginate(7)->appends($request->input());
        
        //tampilan
        $matakuliah = $this->getMatakuliah();
        $period = $this->getPeriod();
        return view('content.message.group',compact('pendaftar','matakuliah','period'));
    }
    
    
    public function getTemplate(){
        $template = Template::select('title','message')->get();
        return $template;
    }
    public function getMatakuliah(){
        $matakuliah=Matakuliah::select('kode','name','semester_period','semester')->get();
        return $matakuliah;
    }
    public function getPeriod(){
        $period=Period::select('id','semester','year')->get();
        return $period;
    }
    public function send()
    {
        Notification::send($pendaftar, new NewMessageNotif($message));
    }
}
