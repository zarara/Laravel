<?php

namespace App\Http\Controllers\Service;

use App\Pendaftar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageGroupController extends Controller
{
    public function index(Request $request)
    {
        $group = Pendaftar::query();

        if($query = $request->get('query'))
        {
            $group = $group->where(function ($builder)use($query){
                $builder->where('name','like',"%{$query}%")
                    ->orWhere('npm','like',"%{$query}%")
                    ->orWhere('kontak','like',"%{$query}%");
            });
        }

        if($limit = $request->get('limit')){
            return $group->paginate($limit)->appends($request->all());
        }
        
        return $group->get();

    }
}
