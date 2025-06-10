<x-layout>
    <h1>Edit Job</h1>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Job Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $job->name) }}" required>

        <label for="description">Job Description:</label>
        <textarea id="description" name="description" required>{{ old('description', $job->description) }}</textarea>

        <label for="vacancy">Vacancy:</label>
        <input type="number" id="vacancy" name="vacancy" value="{{ old('vacancy', $job->vacancy) }}" required min="1">

        <button type="submit" class="btn btn-success mt-3">Update Job</button>
    </form>
</x-layout>
