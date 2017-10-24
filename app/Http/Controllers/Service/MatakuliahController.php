<?php

namespace App\Http\Controllers\Service;

use App\Matakuliah;
use App\Http\Controllers\Controller;

class MatakuliahController extends Controller
{
   public function index(){
       return Matakuliah::all();
   } 
}
