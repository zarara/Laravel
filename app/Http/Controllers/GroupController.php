<?php

namespace App\Http\Controllers;


use App\Group;
use App\Matakuliah;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $group = Matakuliah::query();
        //searching
        if($query = $request->get('query')){
            $group = $group->where('name','like',"%{$query}%")
                ->orWhere('semester','like',"%{$query}%")
                ->orWhere('kode','like',"%{$query}%");
            
        }
        $group = $group->with('jurusan')->paginate(15)->appends($request->input());
        return view('content.group.tampil',compact('group'));
    }


    public function insertData($data){
        foreach ($data as $value){
            $data = new Group();
            $data -> matakul_id = $value ->id;
            $data -> name =  $value -> name;

            $check = DB::table('phone_group')->where([
                ['matakul_id', '=', $value -> id],
            ])->get();

            if ($data->matakul_id){
                $check = DB::table('phone_group')
                    ->where('matakul_id', '=' , $value -> id)
                    ->update(['name' => $value -> name ],['kode' => $value -> kode ]);
            } else{
                $data ->save();
            }
        }
    }
    
    public function addGroup(){
        $matkul= Matakuliah::all();
        $this->insertData($matkul);
//        return redirect('phone_group');
        var_dump($matkul);
    }
    
    public function getGroup(){
        $group = Group::all(['name']);
        return $group;
    }
}
