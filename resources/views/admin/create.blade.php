<x-layout>
    <h2>Create Job</h2>
    <form method="POST" action="{{ route('jobs.store') }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Vacancy:</label>
        <input type="number" name="vacancy" required><br>

        <button type="submit" class="btn btn-sm btn-info">Create Job</button>
    </form>
</x-layout>
