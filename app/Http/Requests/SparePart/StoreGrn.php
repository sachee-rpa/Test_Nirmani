<?php

namespace App\Http\Requests\SparePart;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrn extends FormRequest
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
                       
                        'supplier_id' => 'required|numeric|min:1',
                        'country_id' => 'required|numeric|min:1',
                        'date' => 'required|date',
                        'invoice_number' => 'required',
                        'total_amount' => 'required|numeric|gt:0',    
                        'total_sell_amount' => 'required|numeric|gt:0',                       
                    ];
                }
            case 'PUT': {
                }
            case 'PATCH': {
                    return [
                        'supplier_id' => 'required|numeric|min:1',
                        'country_id' => 'required|numeric|min:1',
                        'date' => 'required|date',
                        'invoice_number' => 'required',
                        'total_amount' => 'required|numeric|gt:0',    
                        'total_sell_amount' => 'required|numeric|gt:0',                             
                    ];
                }
            default:
                break;
        }

        return [];
    }
}