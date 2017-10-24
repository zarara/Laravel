<?php

namespace App\Http\Controllers;

use App\Pendaftar;
use App\Template;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\Request;
use Notifications;
use App\Notifications\NewMessageNotif;

class PersonalController extends Controller
{
    public function index(\Illuminate\Http\Request $request){
        $pendaftar = Pendaftar::query();
        //searching
        if($query = $request->get('query')){
            $pendaftar = $pendaftar->where('npm','like',"%{$query}%")->orWhere('name','like',"%{$query}%");
        }
        $pendaftar = $pendaftar->paginate(7)->appends($request->input());
        
        $template = $this->getTemplate();
        return view('content.message.personal',compact('pendaftar','template'));
    }
    public function store(){
        
    }
    public function getTemplate(){
        $template = Template::select('title','message')->get();
        return $template;
    }

    public function send()
    {
        Notification::send($pendaftar, new NewMessageNotif($message));
    }
}
