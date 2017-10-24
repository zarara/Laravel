<?php

namespace App\Http\Controllers\Service;

use App\Http\Requests\OutboxRequest;
use App\Outbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutboxController extends Controller
{
    public function index(Request $request)
    {
        $outbox = Outbox::with('pendaftar');

        if ($query = $request->get('query')) {
            $outbox = $outbox->where(function ($builder) use ($query) {
                $builder->where('message', 'like', "%{$query}%");
            });
        }

        if ($limit = $request->get('limit')) {
            return $outbox->paginate($limit)->appends($request->all());
        }

        return $outbox->get();
    }

    public function show(OutboxRequest $request)
    {
        return Outbox::show($request->all())->get();
    }

    public function destroy(Outbox $outbox)
    {
        return json_encode($outbox->delete());
    }
}
