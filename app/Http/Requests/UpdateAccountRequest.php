<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('create-accounts'), 403);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
            ],
            'phonenumber' => [
                'exclude_unless:role_id,' . Role::IS_TEACHER,
                'required',
                'regex:/06([0-9]{8})/'
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
