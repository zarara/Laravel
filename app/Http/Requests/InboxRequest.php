<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InboxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_recive' => 'required',
            'message' => 'required',
            'date_recive' => 'required',
            'time_recive' => 'required',
        ];
    }
}
