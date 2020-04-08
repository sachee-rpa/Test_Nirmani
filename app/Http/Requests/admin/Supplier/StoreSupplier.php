<?php

namespace App\Http\Requests\Admin\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreSupplier extends FormRequest
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
    public function rules(Request $request)
    {
        
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {                
                    return [
                        'country_id' => 'required',
                        'name' => 'required|unique:suppliers',
                        'address' => 'required',
                        'credit_limit' => 'required',
                        'credit_period' => 'required',
                        'fixed_line' => 'required',
                        'email' => 'required',
                        'vat' =>  'nullable|numeric',
                        'svat' =>  'nullable|numeric',
                        'remark' => 'nullable|max:255',
                    ];
                }
            case 'PUT': {
                
            }
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:suppliers,name,' . $this->supplier->id,                        
                        'address' => 'required',
                        'credit_limit' => 'required',
                        'credit_period' => 'required',
                        'fixed_line' => 'required',
                        'email' => 'required',
                        'vat' =>  'nullable|numeric',
                        'svat' =>  'nullable|numeric',
                        'remark' => 'nullable|max:255',
                   
                    ];
                }
            default:
                break;
        }

        return [];
    }
}
