<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersioningRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'version_number' => 'required|string|max:50',
            'changelog' => 'nullable|string',
            'status' => 'required|in:development,completed,pending,archived,production',
            'release_date' => 'nullable|date',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id', 
        ];
    }
}
