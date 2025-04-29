<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIdentityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profile_id' => ['required', 'integer', 'unique:identities,profile_id'],
            'identity_id' => ['required', 'string', 'size:16'],
            'identity_photo' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'profile_id.required' => 'Profile ID is required',
            'profile_id.integer' => 'Profile ID must be an integer',
            'profile_id.unique' => 'This profile already has an identity',
            'identity_id.required' => 'Identity ID is required',
            'identity_id.size' => 'Identity ID must be exactly 16 characters',
            'identity_photo.required' => 'Identity photo is required',
            'address.required' => 'Address is required',
            'address.max' => 'Address cannot be longer than 255 characters',
        ];
    }
}
