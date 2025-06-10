<x-layout>
    <div style="display: flex; gap: 10px; margin: 20px 0;">
    <a href="{{ route('jobs.create') }}" class="btn btn-success">+ Create New Job</a>
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Manage Jobs (Edit/Delete)</a>
</div>
    <h1>Welcome to ResumeHub Admin Dashboard</h1>

    

    <h3>Received Applications</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Application ID</th>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Job Title</th>
                <th>Description</th>
                <th>Vacancy</th>
                <th>Resume</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->job->name ?? 'N/A' }}</td>
                    <td>{{ $application->job->description ?? 'N/A' }}</td>
                    <td>{{ $application->job->vacancy ?? 'N/A' }}</td>
                    <td>
                        @if ($application->resume_path)
                            <a href="{{ route('view.resume', $application->id) }}" target="_blank" class="btn btn-sm btn-info">View Resume</a>
                        @else
                            <span class="text-muted">No Resume</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
