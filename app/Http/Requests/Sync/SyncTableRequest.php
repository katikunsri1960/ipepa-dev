<?php

namespace App\Http\Requests\Sync;

use Illuminate\Foundation\Http\FormRequest;

class SyncTableRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'table_name' => 'required|string|max:255',
            'api_path' => 'required|string|max:255',
            'last_sync' => 'nullable',
            'batch_id' => 'nullable',
        ];
    }
}
