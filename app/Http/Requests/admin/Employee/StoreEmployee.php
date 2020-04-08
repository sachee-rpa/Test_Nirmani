<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployee extends FormRequest
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
                        'name' => 'required|unique:employees',
                        'initial' => 'required',
                        'nic_number' => 'required|unique:employees',
                        'employee_category_id' => 'required',
                        'designation' => 'required',
                        'join_date' => 'required',
                        'day_rate' =>  'required',
                        'ot_rate' =>  'required',
                        'remark' => 'nullable|max:255',
                        "upload" => "nullable|mimes:doc,docx,pdf,txt|max:2048"
                    ];
                }
            case 'PUT': {
                }
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:employees,name,' . $this->employee->id,
                        'initial' => 'required',
                        'nic_number' => 'required|unique:employees,nic_number,' . $this->employee->nic_number,
                        'employee_category_id' => 'required',
                        'designation' => 'required',
                        'join_date' => 'required',
                        'day_rate' =>  'required',
                        'ot_rate' =>  'required',
                        'remark' => 'nullable|max:255',
                        "upload" => "nullable|mimes:doc,docx,pdf,txt|max:2048"
                    ];
                }
            default:
                break;
        }

        return [];
    }
}