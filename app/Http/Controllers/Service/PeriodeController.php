<?php

namespace App\Http\Controllers\Service;

use App\Period;
use App\Http\Controllers\Controller;

class PeriodeController extends Controller
{
    public function index(){
        return Period::all();
    }
}
