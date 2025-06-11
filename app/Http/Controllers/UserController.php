<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserMailJob;
use App\Mail\ActionResultMail;
use App\Mail\AdminNotificationMail;
use App\Models\Application;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function showlogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $validated=$request->validate([
            "email"=>"required",
            "password"=>"required"
        ]);

        // $user = User::where('email', $validated['email'])
        //     ->where('password', $validated['password'])
        //     ->first();


        if(Auth::attempt($validated))
        {
            $request->session()->regenerate();

            return redirect()->route('user.dashboard');
        }
        else
        {
            throw ValidationException::withMessages([
                'credentials'=>'sorry, incorrect credentials'
            ]);
        }

        // if ($user) {
        //     return redirect()->route('user.dashboard');
        // } else {
    
        //     return redirect()->route('show.login')->with('error', 'Invalid credentials');
        // }


    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }

    public function showregisterform()
    {
        return view('register');
    }
    public function registration(Request $request)
    {
        $validatedData =$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user=User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        //Auth::login($user);

        return redirect()->route('show.login')->with('success', 'Registration successful!');
    }

    public function showjobs()
    {
        $jobs=Job::all();
        //dd($jobs);
        return view('user.dashboard',['jobs'=>$jobs]);
    }
    // public function selectjob(Request $request)
    // {
    //     $job_id = $request->input('job_id');
    //     //return view('user.application', compact('job_id'));
    //     return redirect()->route('application.form');
    // }


    // public function showapplication()
    // {
    //     return view('user.application');
    // }
    // public function showApplicationForm(Request $request)
    // {
    //     $request->validate([
    //         'job_id' => 'required|exists:jobs,id',
    //     ]);

    //     $job = Job::findOrFail($request->job_id);

    //     return view('user.application', compact('job'));
    // }
    public function showApplyForm(Job $job) {
            return view('user.application', compact('job'));
        }






public function apply(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'job_id' => 'required|exists:jobs,id',
            'document' => 'required|file|mimes:doc,txt|max:2048',
        ]);

        // Store the file
        $file = $request->file('document');
        $filename = time() . "_resume_" . preg_replace('/\s+/', '_', $validated['name']) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $relativePath = 'uploads/' . $filename;

        // Save application
        Application::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'job_id' => $validated['job_id'],
            'resume_path' => $relativePath,
        ]);

        // Remove uploaded file object if still in array
        unset($validated['document']);

        // Dispatch Job (Pass only safe data)
        SendUserMailJob::dispatch($validated, $relativePath);

        return redirect()->route('user.dashboard')->with('success', 'Form submitted and file uploaded successfully!');
    }

}