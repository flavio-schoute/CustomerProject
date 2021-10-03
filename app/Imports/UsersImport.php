<?php

namespace App\Imports;

use App\Models\User;
use BaconQrCode\Common\Mode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new User([
            'first_name'     => $row['first_name'],
            'last_name'     => $row['last_name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
            'role_id' => 3,
        ]);



    }

    public function rules(): array
    {
        return [
          '*.email' => ['email', 'unique:user,email'],
        ];
    }

    public function onFailure(Failure ...$failures)
    {

    }


}
