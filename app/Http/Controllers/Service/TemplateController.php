<?php

namespace App\Http\Controllers\Service;

use App\Http\Requests\CreateTemplateRequest;
use App\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $template=Template::query();
        
        if($query = $request->get('query'))
        {
            $template = $template->where(function ($builder)use($query){
                $builder->where('title','like',"%{$query}%");
            });
        }

        if($limit = $request->get('limit')){
            return $template->paginate($limit)->appends($request->all());
        }
        
        return $template->get();
    }

    public function store(CreateTemplateRequest $request)
    {
        return Template::create($request->all());
    }

    public function update(CreateTemplateRequest $request, Template $template)
    {
        $template->update($request->all());
        return $template->fresh();
    }

    public function destroy(Template $template)
    {
        return json_encode($template->delete());
    }
}
