<?php

namespace App\Http\Controllers;


use App\Jurusan;
use App\Matakuliah;
use App\Pendaftar;
use App\Period;
use App\Periode;
use Request;
use App\Http\Requests;
class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $pendaftar = Pendaftar::query();

        // Searching
        if($query = $request->get('query')){
            $pendaftar = $pendaftar->where('npm','like',"%{$query}%")->orWhere('name','like',"%{$query}%")->orWhereHas('matakuliah',function ($q)use($query){
                $q->where('name','like',"%{$query}%");
            });
        } 
        else {
        //Selection
            if($jurusan = $request->get('jurusan')){
                $pendaftar = $pendaftar->whereHas('jurusan',function ($q)use($jurusan){
                    $q->where('id',$jurusan);
                });
            }
            if($period = $request->get('period')){
                $pendaftar= $pendaftar->whereHas('matakuliah',function ($q)use($period){
                    $q->where('matakuliah_asisten.period_id',$period);
                });
            }
            if($tft = $request->get('tft')){
                $pendaftar = $pendaftar->where('tft',$tft);
            }
        }
        //Tampilan with paginate
        $pendaftar = $pendaftar->with('matakuliah.jurusan','jurusan')->has('matakuliah')->paginate(15)->appends($request->input());

        //untuk menampilkan matakuliah dan period pd model
        $periods=$pendaftar->map(function ($p){
            return $p->matakuliah->map(function ($m){
                return $m->pivot->period_id;
            });
        })->flatten()->flip ()->keys();
        $periods=Period::whereIn('id',$periods)->get();
        foreach ($pendaftar as &$p) {
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
        
        //menampilkan data pada combolist
        $jurusan = $this->getJurusan();
        $period = $this->getPeriod();
        return view('content.data.tampil', compact('pendaftar','jurusan','period'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = $this->getJurusan();
        return view('content.pendaftar.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pendaftar::create(Request::all(['npm','jurusan_id','name','email','gender','kontak','address','date_of_birth','place_of_birth','tft','rekening','sks','ipk','org_exp']));
        return view('content.data.pendaftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendaftar= Pendaftar::find($id);
        return view('content.pendaftar.read',compact('pendaftar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pendaftar = Pendaftar::find($id);
        return view('content.pendaftar.edit',compact('pendaftar'));
//        var_dump($pendaftar);
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
//        dd($pendaftar);
        $pendaftar = Pendaftar::find($id);
        $pendaftar->update(Request::all());
        return redirect('pendaftar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pendaftar = Pendaftar::find($id);
        $pendaftar->delete();
        return redirect('pendaftar');
    }
    
    
    public function getJurusan()
    {
        $jurusan = Jurusan::select ('id','name')->get();
        return $jurusan;
    }
    public function getMatkul()
    {
        $matkul = Matakuliah::select ('id','kode','name')->get();
        return $matkul;
    }
    public function getPeriod()
    {
        $period = Period::select('id', 'year', 'semester')->get();
        return $period;
    }
    
    public function addAsisten()
    {
        dd($this->getPendaftarById(Request::get('pendaftar_id')));

        $pendaftar = $this->getPendaftarById(Request::get('pendaftar_id'));
            $matakuliah = $this->getMakulById(Request::get('makul_id'));
            $period = $this->getPeriode(Request::get('period_id'));

            $data = new Asisten();
            $data -> id = $pendaftar ->id;
            $data -> npm =  $pendaftar -> npm;
            $data -> jurusan_id = $pendaftar -> jurusan_id;
            $data -> matakuliah_id = $matakuliah ->id;
            $data -> name = $pendaftar -> name;
            $data -> email = $pendaftar -> email;
            $data -> gender = $pendaftar -> gender;
            $data -> kontak = $pendaftar -> kontak;
            $data -> address = $pendaftar -> address;
            $data -> date_of_birth = $pendaftar -> date_of_birth;
            $data -> place_of_birth = $pendaftar -> place_of_birth;
            $data -> tft = $pendaftar -> tft;
            $data -> rekening = $pendaftar -> rekening;
            $data -> period_id =$period->period_id;

            $data->save();
    }
}
