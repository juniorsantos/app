<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use Domains\User\Enums\Profile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'profile' => ['required', Rule::in(values: Profile::all())],
            'email' => ['required', 'string', 'email','unique:users,email'],
            'document' => ['required', 'string'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string', 'same:password'],
        ];
    }
}
