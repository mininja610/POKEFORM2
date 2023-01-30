<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //public function authorize()
    //{
       // return false;
    //}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'party.title' => 'required',
            'party.content' => 'required',
            'p1' => 'required|different:p2,p3,p4,p5,p6',
            'p2' => 'required|different:p1,p3,p4,p5,p6',
            'p3' => 'required|different:p2,p1,p4,p5,p6',
            'p4' => 'required|different:p2,p3,p1,p5,p6',
            'p5' => 'required|different:p2,p3,p4,p1,p6',
            'p6' => 'required|different:p2,p3,p4,p5,p1',
        ];
    }
}
