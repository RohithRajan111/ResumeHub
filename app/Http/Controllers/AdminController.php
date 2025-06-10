<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    //
    public function showadminlogin()
    {
        return view('admin.login');
    }


    public function index()
{
    $jobs = Job::all(); // Fetch all jobs from the database
    return view('admin.index', compact('jobs')); // Pass jobs to the view
}


    public function adminlogin(Request $request)
    {
            $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
            ]);

        if (Auth::guard('admin')->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('show.admindashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid admin credentials.',
        ]);

    }

    public function showapplication()
    {
        $applications =Application::with('job')->get();

        return view('admin.dashboard', ['applications' => $applications]);
    }

    public function destroy($id)
        {
            $job = Job::findOrFail($id);
            $job->delete();

            return redirect()->route('show.admindashboard')->with('success', 'Job deleted successfully.');
        }

        // public function edit($id)
        // {
        //     $job = Job::findOrFail($id);
        //     return view('admin.editjob', compact('job'));
        // }
        // public function update(Request $request, $id)
        // {
        //     $validated = $request->validate([
        //         'name' => 'required|string|max:255',
        //         'description' => 'required|string',
        //         'vacancy' => 'required|integer|min:1',
        //     ]);

        //     $job = Job::findOrFail($id);
        //     $job->update($validated);

        //     return redirect()->route('show.admindashboard')->with('success', 'Job updated successfully!');
        // }

        public function viewResume($id)
        {
            $application = Application::findOrFail($id);

            if (!Auth::guard('admin')->check()) {
                abort(403);
            }

            return response()->file(public_path($application->resume_path));
        }




        public function adminlogout(Request $request)
        {
            Auth::logout();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login');
        }



        public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'vacancy' => 'required|integer|min:1',
        ]);

        Job::create($request->only(['name', 'description', 'vacancy']));

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        return view('admin.editjob', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'vacancy' => 'required|integer|min:1',
        ]);

        $job->update($request->only(['name', 'description', 'vacancy']));

        return redirect()->route('show.admindashboard')->with('success', 'Job updated successfully.');
    }

}
