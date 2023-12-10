<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Other form fields -->
    <button type="submit">Login</button>
</form>
