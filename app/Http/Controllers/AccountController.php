<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $groups = Group::all();
        return view('admin.account.index', compact(array('roles', 'groups')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {

        // Gebruiker aanmaken
        
        User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);
        
        $lastUserId = DB::getPdo()->lastInsertId();


        //Checken met if of value in select box of docent of student

        if($request->role == 2) {
           
            Teacher::create([
                'user_id' => $lastUserId,
                'phone_number' => $request->phonenumber,
            ]);
        }
        else if($request->role == 3) {
            Student::create([
                'user_id' => $lastUserId,
                'group_id' => $request->group,
                'date_of_birth' => date('Y-m-d', strtotime($request->birthdate)),
                
            ]);
        }

        //Als waar maak dan docent of student aan en dan return je terug
        return dd("Lekker heur het zit erin!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
