<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use InvModels\SharedModels\Facility;
use InvModels\SharedModels\State;

class FacilityController extends Controller
{

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(\Illuminate\Http\Request $request)
    {
        try {
            // Handle AJAX requests
            if ($request->ajax()) {
                $page = $request->get('page', 1);
                $pageSize = 10;
                
                // Build query with filters
                $query = "SELECT * FROM tblFacility WHERE 1=1";
                $params = [];
                
                // Name filter
                if ($request->filled('name')) {
                    $query .= " AND Name LIKE ?";
                    $params[] = '%' . $request->name . '%';
                }
                
                // City filter
                if ($request->filled('city')) {
                    $query .= " AND City LIKE ?";
                    $params[] = '%' . $request->city . '%';
                }
                
                // State filter
                if ($request->filled('state')) {
                    $query .= " AND State LIKE ?";
                    $params[] = '%' . $request->state . '%';
                }
                
                // PCC filter
                if ($request->filled('pcc')) {
                    $query .= " AND IsPCC = ?";
                    $params[] = $request->pcc;
                }
                
                // Get total count for pagination
                $countQuery = "SELECT COUNT(*) as total FROM tblFacility WHERE 1=1";
                $countParams = [];
                
                if ($request->filled('name')) {
                    $countQuery .= " AND Name LIKE ?";
                    $countParams[] = '%' . $request->name . '%';
                }
                if ($request->filled('city')) {
                    $countQuery .= " AND City LIKE ?";
                    $countParams[] = '%' . $request->city . '%';
                }
                if ($request->filled('state')) {
                    $countQuery .= " AND State LIKE ?";
                    $countParams[] = '%' . $request->state . '%';
                }
                if ($request->filled('pcc')) {
                    $countQuery .= " AND IsPCC = ?";
                    $countParams[] = $request->pcc;
                }
                
                $totalCount = DB::select($countQuery, $countParams)[0]->total;
                
                // Add pagination
                $offset = ($page - 1) * $pageSize;
                $query .= " ORDER BY Name ASC LIMIT ? OFFSET ?";
                $params[] = $pageSize;
                $params[] = $offset;
                
                // Execute query
                $facilities = DB::select($query, $params);
                
                // Create paginator
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                    $facilities,
                    $totalCount,
                    $pageSize,
                    $page,
                    ['path' => url('/facility/list')]
                );
                
                return response()->json([
                    'facilities' => $facilities,
                    'pagination' => $paginator->links()->render(),
                    'total' => $totalCount,
                    'current_page' => $page,
                    'last_page' => $paginator->lastPage(),
                    'per_page' => $pageSize
                ]);
            }
            
            // Handle regular requests (fallback)
            $page = request('page', 1);
            $pageSize = 20;
            $facilities = \Illuminate\Support\Facades\DB::select("call GetFacilityList(0, 0)");
            $offset = ($page * $pageSize) - $pageSize;
            $data = array_slice($facilities, $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($facilities), $pageSize, $page, ['path' => url('/facility/list')]);
            
            return view('facility.index', compact('paginator'));
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to load facilities'], 500);
            }
            throw $e;
        }
    }

    public function edit($id)
    {
        $facility = Facility::where('Id', $id)->with('contacts')->first();
        
        if (!$facility) {
            return redirect()->route('facility.index')->with('error', 'Facility not found.');
        }
        
        $state = State::all();
        //dd($state);
        $roles = \App\Roles::orderBy('Description')->get();
        return view("facility.edit", ["facility" => $facility, 'State' => $state, 'roles' => $roles]);
    }

    public function Contacts($code)
    {
        $page = request('page', 1);
        $pageSize = 20;
        $list = DB::select("SELECT * FROM tbl_FacilityContacts WHERE FacilityID = " . $code);
        $offset = ($page * $pageSize) - $pageSize;
        $data = array_slice($list, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($list), $pageSize, $page, ['path' => url('/facility/contacts/' . $code)]);

        return view("facility.Contacts", compact(['paginator', 'code']));
    }

    public function EditContact($id, \Illuminate\Http\Request $request)
    {
        $facility = DB::select("call GetFacilityList(" . $request->FacilityID . ")");
        $contact = DB::select("select * From tbl_FacilityContacts WHERE ContactID = " . $id);
        return view("facility.EditContact", compact(['contact', 'facility', 'id']));
    }

    public function SaveContact(\Illuminate\Http\Request $request)
    {
        //dd($request);
        $userid = \Illuminate\Support\Facades\Auth::user()->id;
        $mytime = \Carbon\Carbon::now();
        if ($request->ContactID == 0) {
            DB::table("tbl_FacilityContacts")->insert([
                'FirstName' => $request->Firstname,
                'LastName' => $request->Lastname,
                'FacilityID' => $request->FacilityID,
                'JobTitle' => $request->jobtitle,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Fax' => $request->Fax,
                'AddedBy' => $userid,
                'AddedOn' => $mytime->toDateTimeString(),
                'Active' => empty($request->chkActive) ? 0 : 1,
                'IsWoundTrackerApp' => empty($request->chkWoundTrackerApp) ? 0 : 1
            ]);
        } else {
            DB::table("tbl_FacilityContacts")->where('ContactID', $request->ContactID)->update([
                'FirstName' => $request->Firstname,
                'LastName' => $request->Lastname,
                'JobTitle' => $request->jobtitle,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'Fax' => $request->Fax,
                'UpdatedBy' => $userid,
                'UpdatedOn' => $mytime->toDateTimeString(),
                'Active' => empty($request->chkActive) ? 0 : 1,
                'IsWoundTrackerApp' => empty($request->chkWoundTrackerApp) ? 0 : 1
            ]);
        }
        return redirect('/facility/contacts/' . $request->FacilityID)->with('flash_message', 'Contact Saved');
    }
    
    public function SaveFacilityContact(\Illuminate\Http\Request $request)
    {
        try {
            // Validate required fields
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8',
                'role' => 'required|integer|exists:tblRoles,Id'
            ]);
            
            // Check if email already exists
            $existingUser = \App\User::where('email', $request->email)->first();
            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'A user with this email address already exists. Please use a different email address.'
                ], 422);
            }
            
            // Create user in the User model
            $user = \App\User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'roleid' => $request->role,
                'active' => $request->has('isactive') ? 1 : 0,
                'istemppassword' => 1
            ]);
            
            // Get the user from InvModels\SharedModels\User for email sending
            $sharedUser = \InvModels\SharedModels\User::find($user->id);
            
            // Add user to FacilityUser model
            \InvModels\SharedModels\FacilityUser::create([
                'UserId' => $user->id,
                'FacilityId' => $request->facility_id
            ]);
            
            // Try to send welcome email with instructions
            $emailSent = false;
            $emailMessage = '';
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\SendMailable($sharedUser, $request->password, 'welcome', 'portal.innovativemedsolution.com'));
                $emailSent = true;
                $emailMessage = ' and email sent with instructions';
            } catch (\Exception $emailError) {
                $emailMessage = ' but email could not be sent: ' . $emailError->getMessage();
                // Log the email error but don't fail the entire operation
                \Log::error('Failed to send welcome email to user ' . $user->id . ': ' . $emailError->getMessage());
            }
            
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Contact created successfully' . $emailMessage . '.',
                'user' => $user,
                'email_sent' => $emailSent
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create contact: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function DeleteFacilityContact($userId)
    {
        try {
            // First, delete from FacilityUser model
            \InvModels\SharedModels\FacilityUser::where('UserId', $userId)->delete();
            
            // Then, delete from User model
            \App\User::where('id', $userId)->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Contact deleted successfully.'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact: ' . $e->getMessage()
            ], 500);
        }
    }

    public function GetClinicians(Request $request)
    {
        try {
            $facilityId = $request->get('facility_id');
            
            // Get all users with roleid = 1 (clinicians)
            $clinicians = \App\User::where('roleid', 1)
                ->where('active', 1)
                ->select('id', 'firstname', 'lastname', 'email')
                ->orderBy('firstname')
                ->get();

            // Get already attached clinicians for this facility
            $attachedClinicianIds = [];
            if ($facilityId) {
                $attachedClinicianIds = \App\Models\ClinicianFacility::where('FacilityId', $facilityId)
                    ->where('Deleted', false)
                    ->pluck('PhysicianId')
                    ->toArray();
            }

            // Add isAttached flag to each clinician
            $clinicians = $clinicians->map(function ($clinician) use ($attachedClinicianIds) {
                $clinician->isAttached = in_array($clinician->id, $attachedClinicianIds);
                return $clinician;
            });

            return response()->json([
                'success' => true,
                'clinicians' => $clinicians
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load clinicians: ' . $e->getMessage()
            ], 500);
        }
    }

    public function AttachClinicians(Request $request)
    {
        try {
            $request->validate([
                'facility_id' => 'required|integer',
                'to_attach' => 'nullable|array',
                'to_attach.*' => 'integer',
                'to_detach' => 'nullable|array',
                'to_detach.*' => 'integer'
            ]);

            $facilityId = $request->facility_id;
            $toAttach = $request->to_attach ?? [];
            $toDetach = $request->to_detach ?? [];

            $attachedCount = 0;
            $detachedCount = 0;

            // Attach new clinicians
            foreach ($toAttach as $clinicianId) {
                // Check if relationship already exists
                $existing = \App\Models\ClinicianFacility::where('FacilityId', $facilityId)
                    ->where('PhysicianId', $clinicianId)
                    ->where('Deleted', false)
                    ->first();

                if (!$existing) {
                    \App\Models\ClinicianFacility::create([
                        'FacilityId' => $facilityId,
                        'PhysicianId' => $clinicianId,
                        'DateAdded' => now(),
                        'Deleted' => false,
                        'AddedBy' => auth()->id(),
                        'ClinicianType' => 'Primary'
                    ]);
                    $attachedCount++;
                }
            }

            // Detach clinicians (soft delete)
            foreach ($toDetach as $clinicianId) {
                $existing = \App\Models\ClinicianFacility::where('FacilityId', $facilityId)
                    ->where('PhysicianId', $clinicianId)
                    ->where('Deleted', false)
                    ->first();

                if ($existing) {
                    $existing->update([
                        'Deleted' => true,
                        'DeletedOn' => now(),
                        'DeletedBy' => auth()->id()
                    ]);
                    $detachedCount++;
                }
            }

            $message = '';
            if ($attachedCount > 0 && $detachedCount > 0) {
                $message = "Successfully attached {$attachedCount} and detached {$detachedCount} clinician(s).";
            } elseif ($attachedCount > 0) {
                $message = "Successfully attached {$attachedCount} clinician(s) to the facility.";
            } elseif ($detachedCount > 0) {
                $message = "Successfully detached {$detachedCount} clinician(s) from the facility.";
            } else {
                $message = "No changes were made.";
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process clinician changes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function SaveClinician(Request $request)
    {
        try {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|integer|in:1',
                'facility_id' => 'required|integer',
                'npi' => 'nullable|string|max:20',
                'phone' => 'nullable|string|max:20',
                'fax' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'address2' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:2',
                'zipcode' => 'nullable|string|max:10'
            ]);

            // Create user in the User model
            $user = \App\User::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'roleid' => $request->role,
                'active' => $request->has('isactive') ? 1 : 0,
                'istemppassword' => 1,
                'npi' => $request->npi,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'address' => $request->address,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode
            ]);

            // Get the user from InvModels\SharedModels\User for email sending
            $sharedUser = \InvModels\SharedModels\User::find($user->id);

            // Add user to ClinicianFacility model
            \App\Models\ClinicianFacility::create([
                'FacilityId' => $request->facility_id,
                'PhysicianId' => $user->id,
                'DateAdded' => now(),
                'Deleted' => false,
                'AddedBy' => auth()->id(),
                'ClinicianType' => 'Primary'
            ]);

            // Try to send welcome email with instructions
            $emailSent = false;
            $emailMessage = '';
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\SendMailable($sharedUser, $request->password, 'welcome', 'portal.innovativemedsolution.com'));
                $emailSent = true;
                $emailMessage = ' and email sent with instructions';
            } catch (\Exception $emailError) {
                $emailMessage = ' but email could not be sent: ' . $emailError->getMessage();
                // Log the email error but don't fail the entire operation
                \Log::error('Failed to send welcome email to user ' . $user->id . ': ' . $emailError->getMessage());
            }

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Clinician created successfully' . $emailMessage . '.',
                'user' => $user,
                'email_sent' => $emailSent
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create clinician: ' . $e->getMessage()
            ], 500);
        }
    }
}
