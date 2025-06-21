<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string', 'max:255'],
        'ic' => ['nullable', 'string', 'max:20'],
        'level' => ['nullable', 'string', 'in:Primary,Secondary'],
        'standard' => ['nullable', 'string'],
        'form' => ['nullable', 'string'],
        'profile_photo' => ['nullable', 'image', 'max:2048'],
    ];
}

}
