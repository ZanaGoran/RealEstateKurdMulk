<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // User creation method
    public function userCreate(Request $request)
    {
        try {
            // Log the input data for debugging
            Log::info('Input data for user creation:', $request->all());

            // Trim phone input to remove whitespace
            $request->merge(['phone' => trim($request->input('phone'))]);

            // Validate the request data
            $request->validate([
                'name' => 'required|unique:users,name|max:255|regex:/^[a-zA-Z0-9_ ]+$/',
                'password' => 'required|min:6|confirmed',
                'phone' => 'required|digits_between:10,15|unique:users,phone',
                'email' => 'required|email|unique:users,email|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'role' => 'nullable|in:user,agent,real_estate_office',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:20',
                'bio' => 'nullable|string',
                'website' => 'nullable|url|max:255',
                'facebook' => 'nullable|url|max:255',
                'twitter' => 'nullable|url|max:255',
                'instagram' => 'nullable|url|max:255',
            ]);

            // Set default values
            $data['is_verified'] = false; // Make sure the user is not verified at creation
            $data['active'] = true;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = uniqid('user_image_') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('user_images'), $filename);
                $data['image'] = 'user_images/' . $filename;
            }

            // Hash the password
            $data['password'] = Hash::make($request->input('password'));

            // Create the user
            $user = User::create(array_merge($data, [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]));

            // Log in the user after registration
            Auth::login($user);

            // Redirect to /newindex with success message
            return redirect('/newindex')->with('success', 'User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            // Log validation errors
            Log::error('Validation error creating user: ' . json_encode($validationException->errors()));
            return redirect('/login-page')->withInput()->withErrors($validationException->errors())->with('toggleRegisterSection', true);
        } catch (\Illuminate\Database\QueryException $queryException) {
            // Log database query errors
            Log::error('Database error creating user: ' . $queryException->getMessage());
            $errorMessage = 'Error creating user. Please check your input and try again.';
            return redirect('/login-page')->withInput()->withErrors(['error' => $errorMessage])->with('toggleRegisterSection', true);
        } catch (\Exception $e) {
            // Log any other unexpected exceptions
            Log::error('Unexpected error creating user: ' . $e->getMessage());
            $errorMessage = 'An unexpected error occurred. Please try again later.';
            return redirect('/login-page')->withInput()->withErrors(['error' => $errorMessage])->with('toggleRegisterSection', true);
        }
    }

    // Edit user method
    public function updateUser(Request $request, $user_id)
{
    // Fetch the user using user_id
    $user = User::where('user_id', $user_id)->firstOrFail();

    // Validate input data (excluding password initially)
    $request->validate([
        'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ ]+$/|unique:users,name,' . $user->user_id . ',user_id',
        'email' => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
        'phone' => 'required|numeric|digits_between:10,15|unique:users,phone,' . $user->user_id . ',user_id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    ]);

    // Update password only if provided
    if ($request->filled('password')) {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
        $user->password = Hash::make($request->input('password'));
    }

    // Handle image upload and remove old image if applicable
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        // Save new image
        $image = $request->file('image');
        $filename = uniqid('user_image_') . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('user_images'), $filename);
        $user->image = 'user_images/' . $filename;
    }

    // Update other user details
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');

    // Save updated user data
    $user->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'User profile updated successfully!');
}


    

     // Show the profile page
     public function showProfile()
     {
         $user = Auth::user();
         return view('agent.profile', compact('user'));
     }
 
     // Show the admin property list
     public function adminPropertyList()
     {
         return view('agent.admin-property-list');
     }
 
     // Show the admin dashboard
     public function adminDashboard()
     {
         return view('agent.admin-dashboard');
     }
 


     public function login(Request $request)
     {
         try {
             $validator = Validator::make($request->all(), [
                 'email' => 'required|email',
                 'password' => 'required',
             ]);
 
             if ($validator->fails()) {
                 return redirect('/login-page')
                     ->withErrors(['error' => 'Invalid email address or password.'])
                     ->withInput()
                     ->with('active_form', 'login-section');
             }
 
             $credentials = $request->only('email', 'password');
 
             if (Auth::attempt($credentials)) {
                 $request->session()->regenerate();
                 Log::info('Authentication successful for email: ' . $request->input('email'));
                 return redirect('/newindex');
             }
 
             Log::info('Authentication failed for email: ' . $request->input('email'));
             return redirect('/login-page')
                 ->withErrors(['error' => 'Invalid email address or password.'])
                 ->withInput()
                 ->with('active_form', 'login-section');
         } catch (\Exception $e) {
             Log::error('Error during login: ' . $e->getMessage());
             return redirect('/login-page')
                 ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                 ->with('active_form', 'login-section');
         }
     }
 

     // Logout method
     public function logout(Request $request)
     {
         try {
             Auth::logout();
             $request->session()->invalidate();
             $request->session()->regenerateToken();
             return redirect('/');
         } catch (\Exception $e) {
             Log::error('Error during logout: ' . $e->getMessage());
             return redirect('/')->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
         }
     }
 
     // Show the reviews page
     public function showReviews()
     {
         return view('agent.reviews');
     }
 
     // Edit user method
     public function editUser($id)
     {
         $user = User::findOrFail($id);
         return view('agent.edit-agent-admin', compact('user'));
     }
 
}
