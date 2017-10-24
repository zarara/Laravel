<?php

namespace App\Http\Controllers\Service;

use App\Pendaftar;
use App\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pendaftar = Pendaftar::query();

        if($query = $request->get('query'))
        {
            $pendaftar = $pendaftar->where(function ($builder)use($query){
               $builder->where('name','like',"%{$query}%")
                   ->orWhere('npm','like',"%{$query}%")
                   ->orWhere('kontak','like',"%{$query}%");
            });
        }

        
        if($limit = $request->get('limit')){
            return $pendaftar->paginate($limit)->appends($request->all());
        }
        
        return $pendaftar->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
