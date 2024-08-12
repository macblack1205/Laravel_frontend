<head> <title>Register</title></head>
@include('header')

<div class="register-container">
    <div class="register-form">
        <h1 class="form-heading">Sign up</h1>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        <form action="{{ route('registerApi') }}" method="post" class="space-y-4">
            @csrf
            <div class="passfield"> 
                <input type="text" placeholder="Name" name="first" value="{{old('first')}}" autocomplete="off" required class="input-field font-absans">
                <span class="error-text">@error('first'){{$message}} @enderror </span>
                <input type="text" placeholder="Last Name" name="last" value="{{old('last')}}" autocomplete="off" required class="input-field font-absans">
                <span class="error-text">@error('last'){{$message}} @enderror </span>
            </div>
            <input type="email" placeholder="Email" name="email" value="{{old('email')}}" autocomplete="off" required class="input-field">
            <span class="error-text">@error('email'){{$message}} @enderror </span>
            <div class="passfield">
                <input type="password" placeholder="Password" name="password" autocomplete="off" required class="input-field">
                <input type="password" placeholder="Password repeat" name="password_confirmation" autocomplete="off" required class="input-field">
            </div>
            <span class="error-text">@error('password'){{$message}} @enderror </span> 
            <span class="error-text">@error('password_confirmation'){{$message}} @enderror </span>             
            <p class="form-text">Already a member? <a href="{{ route('login') }}" class="form-link">Login here</a></p>
            <button type="submit" class="form-button">Sign up</button>
        </form>
    </div>
</div>
</body>
</html>