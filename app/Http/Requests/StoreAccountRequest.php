<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        abort_if(Gate::denies('create-accounts'), 403);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'max:255',
                'string'
            ],
            'last_name' => [
                'required',
                'max:255',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => $this->passwordRules(),
            'phonenumber' => [
                'exclude_unless:role_id,' . Role::IS_TEACHER,
                'required',
                'regex:/06([0-9]{8})/'
            ],
            'role_id' => [
                'required',
                'numeric'
            ],
            'group_id' => [
                'exclude_unless:role_id,' . Role::IS_STUDENT,
                'numeric'
            ],
            'birthdate' => [
                'exclude_unless:role_id,' . Role::IS_STUDENT,
                'date',
                'date_format:Y-m-d'
            ]
        ];
    }
}
