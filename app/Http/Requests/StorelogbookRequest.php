<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelogbookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'logbook_id' => 'required',
            'work_order_no' => 'required',
            'task_detail' => 'nullable',
            'category' => 'nullable',
            'ATA' => 'nullable',
            'TEE_SO' => 'nullable',
            'INS_SO' => 'nullable',
            'archived' => 'boolean',
        ];
    }
}
