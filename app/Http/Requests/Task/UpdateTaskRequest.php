<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'name' => 'bail|required|string',
            'desc' => 'bail|nullable|string',
        ];
    }

    final public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of the task',
                'example' => 'Go to job interview'
            ],

            'desc' => [
                'description' => 'The description of the task',
            ],
        ];
    }
}
