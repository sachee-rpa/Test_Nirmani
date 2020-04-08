<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
                        'name' => 'required|unique:customers',
                        'address' => 'required',                        
                        'email' => 'nullable|email',
                        'vat' =>  'nullable|numeric',
                        'svat' =>  'nullable|numeric',
                        'remark' => 'nullable|max:255',
                    ];
                }
            case 'PUT': {
                
            }
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:customers,name,' . $this->customers->id,                        
                        'address' => 'required',
                        'email' => 'nullable|email',
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