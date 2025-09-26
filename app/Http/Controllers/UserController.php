<?php

namespace App\Http\Controllers;

use InvModels\SharedModels\Roles;
use InvModels\SharedModels\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model, Request $request)
    {
        $roles = Roles::all();
        if (!empty($request->role))
            $model = $model::where("roleid", $request->role);
        return view('users.index', ['users' => $model::with('roles')->paginate(10), 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Roles::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        //dd($request);
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->get('password')),
            'roleid' => $request->roleid,
            'active' => 1,
            'istemppassword' => 1
        ]);
        //$model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        Mail::to($user->email)->send(new SendMailable($user, $request->get('password'), 'welcome'));
        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, \Illuminate\Http\Request $request)
    {
        //dd($request);

        DB::select("UPDATE users SET FFSPercentage = " . ($request->percentage == null || $request->percentage == "" ? 0 : $request->percentage) .
                ", ClinicianType = '" . ($request->cboClinicianType == null || $request->cboClinicianType == "" ? "'" : $request->cboClinicianType . "'") .
                " WHERE id = " . $user->id);
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except(
                    [$request->get('password') ? '' : 'password']
                )
        );

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

    public function ClinicianDetails($id)
    {
        $user = User::where("id", $id)->get();
        $view = View::make("users.clinician", compact('user'))->render();
        return response()->json(["html" => $view]);
    }

    public function ContactDetails($id)
    {
        $user = User::where("id", $id)->get();
        $view = View::make("users.contact", compact('user'))->render();
        return response()->json(["html" => $view]);
    }
}