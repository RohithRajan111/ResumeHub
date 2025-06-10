<x-layout>
    <form action="{{ route('user.login') }}" method="POST">
        @csrf
        <h1>Login</h1>
        Username : <input type="text" name="email"><br>
        Password : <input type="password" name="password"><br>
        <a href="/register">Don't have an account? Register here</a><br>
        
        <button type="submit" class="btn btn-outline-light rounded-pill px-4 py-2 shadow-sm ms-3 me-2">Login
        </button>
    </form>
</x-layout>