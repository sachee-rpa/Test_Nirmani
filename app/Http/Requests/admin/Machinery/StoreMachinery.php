<?php

namespace App\Http\Requests\Admin\Machinery;

use Illuminate\Foundation\Http\FormRequest;

class StoreMachinery extends FormRequest
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
                        'name' => 'required|unique:machineries',
                        'brand_id' => 'required',
                        'brand_model_id' => 'required',
                        'machine_id' => 'required',                       
                        'market_rate' => 'nullable|numeric',
                        'remark' => 'nullable|max:255',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:machineries,name,' . $this->machineries->id,
                        'brand_id' => 'required',
                        'brand_model_id' => 'required',
                        'machine_id' => 'required',                        
                        'market_rate' => 'nullable|numeric',
                        'remark' => 'nullable|max:255',
                    ];
                }
            default:
                break;
        }
        return [];
    }
}