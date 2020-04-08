<?php

namespace App\Http\Requests\SparePart;

use App\Enums\SparePart\CustomerType;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoice extends FormRequest
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
                       
                        'customer_id' => 'required|numeric|min:1',
                        'customer_type' => 'required|numeric|min:1',
                        'invoice_type' => 'required|numeric|min:1',
                        'date' => 'required|date',
                        'total_amount' => 'required|numeric|gt:0',    
                        'mr_number' => 'required_if:customer_type,==,'.CustomerType::WORKSHOP , 
                        'job_number' => 'required_if:customer_type,==,'.CustomerType::WORKSHOP ,          
                    ];
                }
            case 'PUT': {
                }
            case 'PATCH': {
                    return [
                        'customer_id' => 'required|numeric|min:1',
                        'customer_type' => 'required|numeric|min:1',
                        'invoice_type' => 'required|numeric|min:1',
                        'date' => 'required|date',
                        'total_amount' => 'required|numeric|gt:0',    
                        'mr_number' => 'required_if:paid_by,==,'.CustomerType::WORKSHOP , 
                        'job_number' => 'required_if:paid_by,==,'.CustomerType::WORKSHOP ,                        
                    ];
                }
            default:
                break;
        }

        return [];
    }
}