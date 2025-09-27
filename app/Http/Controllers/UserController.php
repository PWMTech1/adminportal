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
        
        // Handle AJAX requests for async data loading
        if ($request->ajax()) {
            try {
                $query = $model::with('roles');
                
                // Apply name filter if provided
                if (!empty($request->name)) {
                    $query = $query->where(function($q) use ($request) {
                        $q->where('firstname', 'LIKE', '%' . $request->name . '%')
                          ->orWhere('lastname', 'LIKE', '%' . $request->name . '%');
                    });
                }
                
                // Apply email filter if provided
                if (!empty($request->email)) {
                    $query = $query->where('email', 'LIKE', '%' . $request->email . '%');
                }
                
                // Apply role filter if provided
                if (!empty($request->role)) {
                    $query = $query->where("roleid", $request->role);
                }
                
                // Apply status filter if provided
                if (!empty($request->status)) {
                    if ($request->status === 'active') {
                        $query = $query->where('active', 1);
                    } elseif ($request->status === 'inactive') {
                        $query = $query->where('active', 0);
                    }
                }
                
                // Apply date range filter if provided
                if (!empty($request->date_range)) {
                    $now = now();
                    switch ($request->date_range) {
                        case 'today':
                            $query = $query->whereDate('created_at', $now->toDateString());
                            break;
                        case 'week':
                            $query = $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                            break;
                        case 'month':
                            $query = $query->whereMonth('created_at', $now->month)
                                          ->whereYear('created_at', $now->year);
                            break;
                        case 'year':
                            $query = $query->whereYear('created_at', $now->year);
                            break;
                    }
                }
                
                // Get paginated users
                $users = $query->paginate(10);
                
                // Return JSON response
                return response()->json([
                    'users' => $users->items(),
                    'pagination' => $users->links()->render(),
                    'total' => $users->total(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'per_page' => $users->perPage()
                ]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to load users data',
                    'message' => $e->getMessage()
                ], 500);
            }
        }
        
        // Regular view request
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
        Mail::to($user->email)->send(new SendMailable($user, $request->get('password'), 'welcome', 'admin.innovativemedsolution.com'));
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