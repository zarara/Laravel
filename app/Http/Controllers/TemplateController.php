<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class TemplateController extends Controller
{
   
    public function index()
    {
        return view('content.message.template'); 
    }

}
