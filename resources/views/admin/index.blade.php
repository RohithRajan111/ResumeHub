<x-layout>
    <h2>All Job Listings</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Vacancy</th>
            <th>Actions</th>
        </tr>

        @foreach ($jobs as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->name }}</td>
                <td>{{ $job->description }}</td>
                <td>{{ $job->vacancy }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-layout>
