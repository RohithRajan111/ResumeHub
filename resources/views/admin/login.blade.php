<x-layout>
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        Email<input type="text" class="test"name='email'>
        Password<input type="password" class="password"name='password'>
        <button type="submit" class="btn btn-outline-light rounded-pill px-4 py-2 shadow-sm ms-3 me-2">Submit

        </button>
</form>
</x-layout>