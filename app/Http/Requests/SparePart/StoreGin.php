<?php

namespace App\Http\Requests\SparePart;

use Illuminate\Foundation\Http\FormRequest;

class StoreGin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [                       
                        'spare_invoice_id' => 'required|numeric|min:1',                       
                        'date' => 'required|date',  
                      ];
                }
            case 'PUT': {
                }
            case 'PATCH': {
                    return [
                        'spare_invoice_id' => 'required|numeric|min:1',                       
                    ];
                }
            default:
                break;
        }
    }
}