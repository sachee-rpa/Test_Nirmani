<?php

namespace App\Http\Requests\Admin\Material;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterial extends FormRequest
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
                        'name' => 'required|unique:materials',
                        'brand_id' => 'required',
                        'unit_id' => 'required',                     
                        'market_rate' => 'nullable|numeric',
                        'remark' => 'nullable|max:255',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:materials,name,' . $this->materials->id,
                        'brand_id' => 'required',
                        'unit_id' => 'required',                     
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