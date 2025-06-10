<x-layout>
  <h1>Welcome to ResumeHub</h1>
<div>

<table>
    <tr ><th>Job id</th><th>Job Name</th><th>Job Description</th><th>Vacancy</th></tr>
@foreach ($jobs as $job)
   
    <tr><td>{{ $job->id }}</td><td>{{ $job->name }}</td><td>{{ $job->description }}</td><td>{{ $job->vacancy }}</td>
        <td>
        {{-- <form method="POST" action="{{ route('user.apply.form') }}">
    @csrf
    <input type="hidden" name="job_id" value="{{ $job->id }}">
    <button type="submit" class="btn btn-outline-light rounded-pill px-4 py-2 shadow-sm ms-3 me-2">Apply
        </button>
</form> --}}
<a href="{{ route('user.apply.form', ['job' => $job->id]) }}" class="btn btn-outline-light rounded-pill px-4 py-2 shadow-sm ms-3 me-2">
    Apply
</a>
    </td>
</tr>
@endforeach
<table>
</div>
</x-layout>
