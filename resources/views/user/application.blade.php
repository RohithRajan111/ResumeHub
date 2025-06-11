<x-layout>
    <h2>Apply for: {{ $job->title }}</h2>

    <form method="POST" action="{{ route('user.apply') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="job_id" value="{{ $job->id }}">

        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Phone:</label>
        <input type="text" name="phone" required>

        <label>Resume (DOC/TXT):</label>
        <input type="file" name="document" required>

        <button type="submit" class="btn btn-success mt-3">Apply</button>
    </form>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>