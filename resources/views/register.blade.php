<x-layout>
    <h1>Register</h1>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        Name : <input type="text" class="text"name="name">
        Email : <input type="text" name="email"><br>
        Password : <input type="password" name="password"><br>
        Confirm Password : <input type="password" name="password_confirmation"><br>
        <br>
        <button type="submit" class="btn btn-outline-light rounded-pill px-4 py-2 shadow-sm ms-3 me-2">Register
        </button>
    </x-layout>