<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Http\Requests\RegisterRequest;


class AuthController extends Controller
{
    // Returns the registration view
    public function register()
    {
        return view('register');
    }
 
     // Handles registration form submission
     public function registerPost(RegisterRequest $request)
     {
         // Check if email already exists for duplicate user
         if (User::where('email', $request->email)->exists()) {
             return back()->withErrors(['email' => 'Email already exists'])->withInput();
         }
        // Create a new User instance
        $user = new User();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:11',
                Password::defaults()
                    ->numbers () // Ensure contain numbers
                    ->mixedCase() //Ensure 1 uppdercase or lowercase letter
                    ->symbols() // Ensure symbols are included
                    ->uncompromised(), // Check if the password is compromised
            ],
            'contact' => [
                'required',
                'string',
                'size:11',
            ],

            'profile_picture' => [
                'required',
                'image', // Ensure the uploaded file is an image
                'mimes:jpeg,png', // Allow only JPEG and PNG formats
            ],

            'age' => [
                'required',
                'integer',
                'gte:18', // Ensure the age is 18 or older
            ],
        ], [
            //Displays a specific error message
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least :min characters long',
            'password.numbers' => 'The password must contain numbers',
            'password.mixedCase' => 'The password must contain one uppercase and one lowercase letter',
            'password.symbols' => 'The password must include at least one special character.',
            'contact.required' => 'The contact number field is required.',
            'contact.size' => 'The contact number must be exactly :size characters long.',
            'profile_picture.required' => 'The profile picture field is required.',
            'profile_picture.image' => 'The profile picture must be an image file.',
            'profile_picture.mimes' => 'The profile picture must be a JPEG or PNG file.',
            'age.required' => 'The age field is required.',
            'age.integer' => 'The age must be an integer.',
            'age.gte' => 'The age must be 18 years or older.',
            
        ]);
        
        // SANITATION Assign submitted data to user properties
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->age = $request->age;
        $user->contact = $request->contact; // Assign the contact number

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $fileName = time() . '_' . $profilePicture->getClientOriginalName();
            $filePath = $profilePicture->storeAs('profile_pictures', $fileName); // Store file in storage/app/profile_pictures directory
            $user->profile_picture = $filePath; // Store the file path in the database
}

 
        // Save the user to the database
        $user->save();
 
        // Redirect back with success message
        return back()->with('success', 'Register successfully');
    }

    // Returns the login view
    public function login()
    {
        return view('login');
    }
 
    // Handles login form submission, Sanitization and Validation to Login
    public function loginPost(Request $request)
    {
        // Credentials array from submitted form data
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            // Redirect to home on successful login
            return redirect('/home')->with('success', 'Login Success');
        }
 
        // Redirect back with error message if authentication fails
        return back()->with('error', 'Error Email or Password');
    }
 
    // Logs out the authenticated user
    public function logout()
    {
        // Logout the user
        Auth::logout();
 
        // Redirect to login page after logout
        return redirect()->route('login');
    }
}