<head> <title>Login</title></head>
@include('header') 

<main class="flex flex-col items-center justify-center min-h-screen p-4">
    <div class="login-form">
        <h1 class="form-heading">Login</h1>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        <form action="{{ route('login') }}" method="post" class="space-y-4">
            @csrf
            <div>
                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off" required class="input-field">
                <span class="error-text">@error('email'){{$message}} @enderror </span>
            </div>
            <div>
                <input type="password" placeholder="Password" name="password" autocomplete="off" required class="input-field">
                <span class="error-text">@error('password'){{$message}} @enderror </span> 
            </div>
            <p class="form-text">New here? <a href="{{ route('register') }}" class="form-link">Sign up now</a></p>
            <button type="submit" class="form-button">Login</button>
        </form>
    </div>
</main>
</body>
</html>
