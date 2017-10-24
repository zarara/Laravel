<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

use App\Http\Requests;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftar = $this->getregistrant();
        $matkul = $this->getmatakuliah();
        $jurusan = $this->getjurusan();
        return view('content.phonebook.pendaftar',compact('pendaftar','matkul','jurusan'));


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
        $jurusan = Jurusan::findOrFail($id);
        return view('pendaftar.create', compact('jurusan'));
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
    
    private function getregistrant()
    {
        $pendaftar = Pendaftar:: all(['npm', 'name', 'email', 'kontak', 'tft']);
        return $pendaftar;
    }
    private function getmatakuliah()
    {
        $matkul = Matakuliah::all(['id','name']);
        return $matkul;
    }
    private function getjurusan()
    {
        $jurusan = Jurusan::all(['id','name']);
        return $jurusan;
    }

}
