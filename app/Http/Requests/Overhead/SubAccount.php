<?php

namespace App\Http\Requests\Overhead;

use Illuminate\Foundation\Http\FormRequest;

class SubAccount extends FormRequest
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
                        'account_id' => 'required',
                        'name' => 'required|unique:sub_accounts',
                    ];
                }
            case 'PUT': {
                }
            case 'PATCH': {
                    return [
                        'account_id' => 'required',
                        'name' => 'required|unique:suppliers,name,' . $this->sub_accounts->id,
                    ];
                }
            default:
                break;
        }

        return [];
    }
}
