<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Check if the user has the role / permission to access this page
        abort_if(Gate::denies('create-accounts'), 403);

        // Get all roles depending on user role
        if (auth()->user()->role_id == Role::IS_SUPER_ADMIN) {
            $roles = Role::all();
        }

        // Make sure the admin can only make teacher and students, the super admin can create admins
        if (auth()->user()->role_id == Role::IS_ADMIN) {
            $roles = Role::select('id', 'name')->where('id', '!=', Role::IS_SUPER_ADMIN)->where('id', '!=', Role::IS_ADMIN)->get();
        }

        // Get all the groups
        $groups = Group::all();

        // Return the view and send the data to it
        return view('admin.account.index', compact('roles', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAccountRequest $request): RedirectResponse
    {
        // This is a secure way to get the validated values from the request and a way to store them
        $userValidation = $request->safe()->only('first_name', 'last_name', 'email', 'password', 'role_id');
        $userValidation['password'] = Hash::make($userValidation['password']);

        $user = User::create($userValidation);

        if ($userValidation['role_id'] == Role::IS_TEACHER) {
            $teacherValidation = $request->safe()->only('phonenumber');
            $user->teacher()->create([
                'phone_number' => $teacherValidation['phonenumber'],
            ]);
        }

        if ($userValidation['role_id'] == Role::IS_STUDENT) {
            $studentValidation = $request->safe()->only('group_id', 'birthdate');
            $user->student()->create([
                'group_id' => $studentValidation['group_id'],
                'date_of_birth' => $studentValidation['birthdate']
            ]);
        }

        // Return message so the user know it succeeded
        return redirect()->route('admin.create_account.index')->with('success', 'Account aangemaakt!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
