<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Department;


class UserController extends Controller
{

        public function index()
        
        {
        $users = User::with(['department'])->paginate(15);
        return view('users.user_list',compact('users'));
        // OR: return response()->json($roles);
        }
            /**
             * Show the form for creating a new user.
             *
             * @return \Illuminate\View\View
             */
            public function create()
            {
            // Fetch all roles from Spatie
            $roles = Role::all();
            $departments = Department::all();

            // Return the view with roles
            return view('users.create', compact('roles','departments'));
            }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required', // Ensure you have a password confirmation field
            'role' => 'required|exists:roles,name',
            'date_of_birth' => 'nullable|date',
            'work_joined' => 'nullable|date',
            'department_id' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle the photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
            'date_of_birth' => $request->date_of_birth,
            'work_joined' => $request->work_joined,
            'department_id' => $request->department,
            'designation' => $request->designation,
            'photo' => $photoPath, // Store photo path
        ]);
    

        // Assign the role
        $user->assignRole($request->role);

        // Redirect to the users index with success message
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }
// Fetch the role by ID
public function edit($id)
{
$user = User::with('department')->findOrFail($id);



$roles = Role::all();
$departments = Department::all();


// If you need to pass roles to the view, you can do this
// $roles = $user->getRoleNames(); // This get  s the names of the roles the user has

return view('users.view', compact('user', 'roles','departments'));
}
public function update(Request $request, $id)
{

// Validate the incoming request data
$request->validate([
'name' => 'required|string|max:255',
'phone' => 'required|string|max:20',
'email' => 'required|email|max:255',
'username' => 'required|string|max:255|unique:users,username,' . $id,
'password' => 'nullable|string', // Ensure the password is confirmed
'role' => 'required|exists:roles,name',
'date_of_birth' => 'nullable|date',
'work_joined' => 'nullable|date',
// 'department_id' => 'required|exists:departments,name',
'designation' => 'nullable|string|max:255',
'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

// Fetch the user by ID
$user = User::findOrFail($id);


// Update user attributes
$user->name = $request->input('name');
$user->phone = $request->input('phone');
$user->email = $request->input('email');
$user->username = $request->input('username');

// Only update the password if it is present in the request
if ($request->filled('password')) {
$user->password = bcrypt($request->input('password')); // Hash the password
}

$user->role = $request->input('role');
$user->date_of_birth = $request->input('date_of_birth');
$user->work_joined = $request->input('work_joined');
$user->department_id = $request->input('department');
// $user->photo = $request->input('designation');

// Handle file upload for the user's photo
if ($request->hasFile('photo')) {
    $photoPath = $request->file('photo')->store('photos', 'public');
    $user->photo = $photoPath;

}

// Save the user
$user->save();

// Redirect or respond back
return redirect()->route('users.edit', $id)->with('success', 'User updated successfully.');
}


public function destroy($id)
{
    // Find the role by id
    $role = User::findOrFail($id);

    // Delete the role
    $role->delete();

    // Redirect to the roles list with a success message
    return redirect()->route('users.index')
                     ->with('success', 'User deleted successfully');
}





}
