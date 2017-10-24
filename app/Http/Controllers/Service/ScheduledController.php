<?php

namespace App\Http\Controllers\Service;

use App\Http\Requests\ScheduleRequest;
use App\Matakuliah;
use App\Scheduled;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduledController extends Controller
{
    public function index(Request $request)
    {

        $scheduled = Scheduled::query('');

        if($limit = $request->get('limit')){
            return $scheduled->paginate($limit)->appends($request->all());
        }

        return $scheduled->get();
    }

    public function store(ScheduleRequest $request)
    {
        return Scheduled::create($request->all());
    }
    
    public function destroy(Scheduled $scheduled)
    {
        return json_encode($scheduled->delete());
    }
}
