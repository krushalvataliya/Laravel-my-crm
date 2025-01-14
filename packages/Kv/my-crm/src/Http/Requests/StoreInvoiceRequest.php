<?php

namespace Kv\MyCrm\Http\Requests;

use Dcblogdev\Xero\Facades\Xero;
use Illuminate\Foundation\Http\FormRequest;
use Kv\MyCrm\Traits\HasGlobalSettings;

class StoreInvoiceRequest extends FormRequest
{
    use HasGlobalSettings;

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
        $rules = [
            'person_name' => 'required_without:organisation_name|max:255',
            'organisation_name' => 'required_without:person_name|max:255',
            'issue_date' => 'required|date_format:"'.$this->dateFormat().'"',
            'due_date' => 'required|date_format:"'.$this->dateFormat().'"',
            'currency' => 'required',
        ];

        /*if (! Xero::isConnected()) {
            $rules['number'] = 'required|integer|unique:Kv\MyCrm\Models\Invoice,number';
        }*/

        return $rules;
    }
}
