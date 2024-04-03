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
    public function userCreate(Request $request)
    {
        try {
            $data = $request->all();

            // Validate the request data
            $request->validate([
                'username' => 'required|unique:users|max:255|regex:/^[a-zA-Z0-9_]+$/',
                'password' => 'required|min:6',
                'phone' => 'required|numeric|unique:users|digits_between:10,15',
                'email' => 'required|email|unique:users|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'email_verified' => 'boolean',
                'active' => 'boolean',
                'role' => 'nullable|in:User,EstateOffice',
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

            // Set the default values for 'email_verified' and 'active'
            $request->merge(['email_verified' => $request->input('email_verified', false)]);
            $request->merge(['active' => $request->input('active', false)]);

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

            // Return a success response and redirect to newindex
            return redirect('/newindex')->with('success', 'User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            // Handle validation errors
            return redirect('/login-page')->withInput()->withErrors($validationException->errors())->with('toggleRegisterSection', true);
        } catch (\Illuminate\Database\QueryException $queryException) {
            // Handle database query errors
            Log::error('Database error creating user: ' . $queryException->getMessage());
    
            $errorMessage = 'Error creating user. Please check your input and try again.';
            return redirect('/login-page')->withInput()->withErrors(['error' => $errorMessage])->with('toggleRegisterSection', true);
        } catch (\Exception $e) {
            // Catch any other exceptions
            Log::error('Error creating user: ' . $e->getMessage());
    
            $errorMessage = 'An unexpected error occurred. Please try again later.';
            return redirect('/login-page')->withInput()->withErrors(['error' => $errorMessage])->with('toggleRegisterSection', true);
        }
    }

    public function login(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect('/login-page')
                    ->withErrors(['error' => 'Invalid email address or password.'])
                    ->withInput()
                    ->with('active_form', 'login-section'); // Set the active form to 'login-section'
            }
    
            $credentials = $request->only('email', 'password');
    
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                // Authentication successful
                $request->session()->regenerate();
    
                // Log the successful authentication
                Log::info('Authentication successful for email: ' . $request->input('email'));
    
                // Redirect to /newindex without using intended
                return redirect('/newindex');
            }
    
            // Authentication failed
            Log::info('Authentication failed for email: ' . $request->input('email'));
    
            return redirect('/login-page')
                ->withErrors(['error' => 'Invalid email address or password.'])
                ->withInput()
                ->with('active_form', 'login-section'); // Set the active form to 'login-section'
        } catch (\Exception $e) {
            // Handle exceptions
            Log::error('Error during login: ' . $e->getMessage());
            return redirect('/login-page')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->with('active_form', 'login-section'); // Set the active form to 'login-section'
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        } catch (\Exception $e) {
            // Handle exceptions
            Log::error('Error during logout: ' . $e->getMessage());
            return redirect('/')->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
