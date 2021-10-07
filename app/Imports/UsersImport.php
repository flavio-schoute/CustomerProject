<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * Imports the data in the database
     *
     * @param Collection $collection
     * @return Model|User
     */
    public function collection(Collection $collection): Collection
    {
        // Create new collection
        $userCollection = new Collection();

        /*
         * Loop through the collection, we use transaction because if the
         * `$user->student()->create` fails we don't insert the user or visa-versa
         */
        foreach ($collection as $row) {
            try {
                DB::transaction(function () use ($row, $userCollection) {
                    $user = User::create([
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'email' => $row['email'],
                        'password' => Hash::make($row['password']),
                        'role_id' => 3,
                    ]);

                    $user->student()->create([
                        'group_id' => Group::pluck('id')->random(),
                        'date_of_birth' => now()->toDateString(),
                    ]);

                    $userCollection->add($user);
                });
            } catch (\Exception $exception) {
                // Ignore
            }
        }
        return $userCollection;
    }

    public function rules(): array
    {
        return [
            '*.email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            '*.password' => [
                'required',
                'string'
            ]
        ];
    }
}
