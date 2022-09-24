<?php

namespace App\Http\Requests\Admin\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:42'],
            'description' => ['required', 'string', 'min:1'],
            'assigned_by_id' => ['required', 'integer', 'exists:admins,id'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id']
        ];
    }
}