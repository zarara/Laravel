<?php

namespace App\Http\Controllers;

use App\Matakuliah;
use App\Outbox;
use App\Pendaftar;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(){
        $pendaftar=Pendaftar::all()->count();
        $matakuliah=Matakuliah::all()->count();
        $outbox=Outbox::all()->count();
        //dd($pendaftar);
        return view('content.dash.dashboard',compact('pendaftar','matakuliah','outbox'));
    }
}
