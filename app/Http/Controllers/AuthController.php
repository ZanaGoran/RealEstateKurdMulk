<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // User creation method
    public function userCreate(Request $request)
    {
        try {
            $data = $request->all();

            // Validate the request data
            $request->validate([
                'username' => 'required|unique:users|max:255|regex:/^[a-zA-Z0-9_]+$/',
                'password' => 'required|min:6|confirmed',
                'phone' => 'required|numeric|unique:users|digits_between:10,15',
                'email' => 'required|email|unique:users|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'role' => 'nullable|in:User,Agent,adminreal_estate_office',
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
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
            $data['email_verified'] = true;
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
            $user = User::create($data);

            // Log in the user after registration
            Auth::login($user);

            // Redirect to /newindex with success message
            return redirect('/newindex')->with('success', 'User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return redirect('/login-page')->withInput()->withErrors($validationException->errors())->with('toggleRegisterSection', true);
        } catch (\Illuminate\Database\QueryException $queryException) {
            Log::error('Database error creating user: ' . $queryException->getMessage());
            $errorMessage = 'Error creating user. Please check your input and try again.';
            return redirect('/login-page')->withInput()->withErrors(['error' => $errorMessage])->with('toggleRegisterSection', true);
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            $errorMessage = 'An unexpected error occurred. Please try again later.';
            return redirect('/login-page')->withInput()->withErrors(['error' => $errorMessage])->with('toggleRegisterSection', true);
        }
    }

    // User login method
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

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validate user data (except password initially)
        $request->validate([
            'username' => 'required|max:255|regex:/^[a-zA-Z0-9_ ]+$/|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone,' . $user->id,
        ]);
    
        // Validate password only if it's filled in the request
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);
            $user->password = Hash::make($request->input('password'));
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid('user_image_') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('user_images'), $filename);
            $user->image = 'user_images/' . $filename;
        }
    
        // Update other fields (excluding password)
        $user->update($request->except('password'));
    
        return redirect()->route('profile.edit', $user->id)->with('success', 'User updated successfully!');
    }
    


}

