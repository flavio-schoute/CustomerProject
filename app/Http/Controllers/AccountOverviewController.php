<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountOverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        //HAALT USERS UIT DE DATABASE
        $users = User::with('role')->where('role_id', '!=', Role::IS_SUPER_ADMIN)->orderBy('id', 'desc')->paginate(25);


        return view('admin.overview.index', compact('users'));
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        // Get the user by the ID, if not found it will throw 404 back
        $user = User::findOrFail($id);

        // Determine on rol which relation it should load and pass it to the view
        if ($user->role_id == Role::IS_TEACHER) {
            $user->loadMissing('teacher');
        }

        if ($user->role_id == Role::IS_STUDENT) {
            $user->loadMissing('student');
        }

        $groups = Group::select('id', 'name')->get();

        return view('admin.overview.edit', compact('user', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAccountRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateAccountRequest $request, int $id): RedirectResponse
    {
        // Get the user by the ID, if not found it will throw 404 back
        $user = User::findOrFail($id);

        // Safe way to get the validate data and update the user
        $userValidation = $request->safe()->only('first_name', 'last_name', 'email');

        $user->update($userValidation);

        // Update the teacher or docent based on the role_id passed to hidden input field in the view
        if ($user->role_id == Role::IS_TEACHER) {
            $teacherValidation = $request->safe()->only('phonenumber');
            $user->teacher()->update([
                'phone_number' => $teacherValidation['phonenumber'],
            ]);
        }

        if ($user->role_id == Role::IS_STUDENT) {
            $studentValidation = $request->safe()->only('group_id', 'birthdate');
            $user->student()->update([
                'group_id' => $studentValidation['group_id'],
                'date_of_birth' => $studentValidation['birthdate']
            ]);
        }

        return redirect()->route('admin.overview.index')->with('success', 'Account bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        //Finds the id from that user that you wants to delete
        $user = User::whereId($id)->delete();

        //Redirects the user with message the user is deleted
        return redirect()->back()->with('success','The user is deleted');
    }
}
