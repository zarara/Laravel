<?php

namespace App\Http\Controllers;

use App\Matakuliah;
use App\Outbox;
use App\Pendaftar;
use App\Period;
use App\Template;
use Illuminate\Http\Request;

class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $outbox = Outbox::latest()->paginate(10);
        return view('content.outbox.tampil',compact('outbox'));
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

    public function indexPersonal(\Illuminate\Http\Request $request)
    {
        $pendaftar = Pendaftar::query();
        //searching
        if($query = $request->get('query')){
            $pendaftar = $pendaftar->where('npm','like',"%{$query}%")->orWhere('name','like',"%{$query}%");
        }
        $pendaftar = $pendaftar->paginate(7)->appends($request->input());

        $template = $this->getTemplate();
        return view('content.message.personal',compact('pendaftar','template'));
    }

    public function indexGroup(\Illuminate\Http\Request $request)
    {
        $group = Matakuliah::query();
        //searching
        if($query = $request->get('query')){
            $group = $group->where('name','like',"%{$query}%")->orWhere('kode','like',"%{$query}%");
        }
        $group = $group->paginate(7)->appends($request->input());

        $template = $this->getTemplate();
        $period = $this->getPeriode();
        return view('content.message.group',compact('group','template','period'));
    }


    public function getPeriode(){
        $period = Period::select('year','semester')->get();
        return $period;
    }

    public function getTemplate(){
        $template = Template::select('title','message')->get();
        return $template;
    }

}
