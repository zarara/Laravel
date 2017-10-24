<?php

namespace App\Http\Controllers\Service;

use App\Http\Requests\InboxRequest;
use App\Inbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $inbox = Inbox::query();

        if ($query = $request->get('query')) {
            $inbox = $inbox->where(function ($builder) use ($query) {
                $builder->where('message', 'like', "%{$query}%");
            });
        }

        if ($limit = $request->get('limit')) {
            return $inbox->paginate($limit)->appends($request->all());
        }

        return $inbox->get();
    }

    public function show(InboxRequest $request)
    {
        return Inbox::show($request->all())->get();
    }

    public function destroy(Inbox $inbox)
    {
        return json_encode($inbox->delete());
    }
}
