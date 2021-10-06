<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        // Get all the roles and groups
        $roles = Role::all();
        $groups = Group::all();

        // Return the view and send the data to it
        return view('admin.account.index', compact(array('roles', 'groups')));
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
     * @return Application|Factory|View
     */
    public function store(StoreAccountRequest $request)
    {
        /**
         * This is a secure way to get the validated values from the request. And a way to store them.
         */
        $userValidation = $request->safe()->only('firstname', 'lastname', 'email', 'password', 'role_id');
        // or
        // $validated = $request->validated();

        $user = User::create($userValidation);

        // Check if the user is creating a teacher or student
        if($request->role == 2) {
            Teacher::create([
                'user_id' => $user->id,
                'phone_number' => $request->phonenumber,
            ]);
        } else if($request->role == 3) {
            Student::create([
                'user_id' => $user->id,
                'group_id' => $request->group,
                'date_of_birth' => date('Y-m-d', strtotime($request->birthdate)),
            ]);
        }

        // TODO
        // Return message so the user know it succeeded
        return view('admin.account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
