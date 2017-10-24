<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Period;
use App\Matakuliah;
use App\Pendaftar;
use App\Phonebook;
use Request;
use App\Http\Requests;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $phone = Pendaftar::query();
        //searching
        if($query = $request->get('query')){
            $phone = $phone->where('npm','like',"%{$query}%")->orWhere('name','like',"%{$query}%")->orWhereHas('matakuliah',function ($q)use($query){
                $q->where('name','like',"%{$query}%");
            });
        }
        $phone = $phone->with('matakuliah.jurusan','jurusan')->has('matakuliah')->paginate(15)->appends($request->input());

        //untuk menampilkan matakuliah dan period pd model
        $periods=$phone->map(function ($p){
            return $p->matakuliah->map(function ($m){
                return $m->pivot->period_id;
            });
        })->flatten()->flip ()->keys();
        $periods=Period::whereIn('id',$periods)->get();
        foreach ($phone as &$p) {
            $matakuliah = $p->matakuliah;

            $matakuliah = $matakuliah->map(function ($makul) use($periods) {
                $period_id = $makul->pivot->period_id;

                $period = $periods->first(function ($period) use ($period_id) {
                    return $period->id == $period_id;
                });
                $makul->pivot->period= $period;
                return $makul;
            });
            unset($p->matakuliah);
            $p->matakuliah = $matakuliah;
        }
        
        $jurusan = $this->getJurusan();
        $matkul = $this->getMatkul();
        return view('content.phonebook.tampil',compact('phone','jurusan','matkul'));
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
        $this->validate($request, [
            'kontak' => 'required',
            'email' => 'required',
        ]);

        $update = Pendaftar::find($id)->update($request->all('kontak','email'));
        return redirect('phone',compact('$update'));
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
//    public function getData($id)
//    {
//        $pendaftar = new Phonebook();
//        $pendaftar->phone_id =
//
//    }
    public function insertData($data,$type){
        foreach ($data as $value){
            $data = new Phonebook();
            $data -> phone_id = $value ->id;
            $data -> name =  $value -> name;
            $data -> kontak = $value -> kontak;
            $data -> email = $value -> email;
            $data -> phone_group = $type;
            $cek = DB::table('phonebook')->where([
                ['phone_id', '=', $value -> id],
                ['phone_group','=', $type]
            ])->get();

            if ($data->phone_id){
                $cek = DB::table('phonebook')
                    ->where('phone_id', '=' , $value -> id)
                    ->where('phone_group','=' , $type)
                    ->update(['email' => $value -> email ],['kontak' => $value -> kontak ],['phone_group' => $value -> $type]);
            } else{
                $data ->save();
            }
        }
    }

    public function phonebookPendaftar($data){
        $pendaftar = Pendaftar::all();
        $this->insertData($pendaftar, 1);
        return redirect('phone');
//        dd($pendaftar);
    }

    private function getPhonebook(){
        $phone = Phonebook::all(['name','kontak','email']);
        return $phone;
    }

    public function getJurusan()
    {
        $jurusan = Jurusan::select ('id','name')->get();
        return $jurusan;
    }
    public function getMatkul()
    {
        $matkul = Matakuliah::select ('id','name')->get();
        return $matkul;
    }
    
    public function getPhonePendaftar()
    {
        $jurusan = $this->getJurusan();
        $matkul = $this->getMatkul();
        $pendaftar = Phonebook::all(['name','kontak','email','phone_group'])->where('phone_group','=','1');
        return view('content.phonebook.pendaftar',compact('pendaftar','jurusan','matkul'));
    }
    public function getPhoneAsisten()
    {
        $jurusan = $this->getJurusan();
        $matkul = $this->getMatkul();
        $asisten = Phonebook::all(['name','kontak','email','phone_group'])->where('phone_group','=','2');
        return view('content.phonebook.asisten',compact('asisten','jurusan','matkul'));
    }
    public function getPhoneDosen()
    {
        $jurusan = $this->getJurusan();
        $matkul = $this->getMatkul();
        $dosen = Phonebook::all(['name','kontak','email','phone_group'])->where('phone_group','=','3');
        return view('content.phonebook.dosen',compact('dosen','jurusan','matkul'));
    }

}
