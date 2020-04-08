<?php

namespace App\Http\Requests\Admin\SparePart;

use Illuminate\Foundation\Http\FormRequest;

class StoreSparePart extends FormRequest
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
                        'name' => 'required|unique:spare_parts',
                        'brand_id' => 'required',
                        'brand_model_id' => 'required',
                        'machine_id' => 'required',
                        'part_number' => 'required|unique:spare_parts',
                        'market_rate' => 'nullable|numeric',
                        'remark' => 'nullable|max:255',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:spare_parts,name,' . $this->spare_part->id,
                        'brand_id' => 'required',
                        'brand_model_id' => 'required',
                        'machine_id' => 'required',
                        'part_number' => 'required|unique:spare_parts,part_number,' . $this->spare_part->id,
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