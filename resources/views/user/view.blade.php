<title>Profile</title>
@include('header')

<div class="register-container">
    <div class="register-form">
        <h1 class="form-heading">User Profile</h1>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif

        @php $u = $user['data']; @endphp

        <div id="user-info" >
            <div class="flex flex-col space-y-4">
                <div class="input-field">{{ $u['first'] }} {{ $u['last'] }}</div>
                <div class="input-field">{{ $u['email'] }}</div>
            </div>
            <button id="edit-button" class="form-button mt-4">Edit Profile</button>
        </div>

        <form id="edit-form" action="{{ route('editApi', $u['id']) }}" method="POST" class="mt-4 space-y-4 p-4" style="display: none;">
            @csrf
            @method('POST')
            <div class="passfield">
                <input type="text" name="first" value="{{ $u['first'] }}" placeholder="Enter your first name" required class="input-field">
                <span class="error-text">@error('first'){{$message}} @enderror </span>
                <input type="text" name="last" value="{{ $u['last'] }}" placeholder="Enter your last name" required class="input-field">
                <span class="error-text">@error('last'){{$message}} @enderror </span>
            </div>
            <input type="email" name="email" value="{{ $u['email'] }}" placeholder="Enter your email" required class="input-field">
            <span class="error-text">@error('email'){{$message}} @enderror </span>
            <div class="passfield">
                <input type="password" name="password" placeholder="Enter your password" class="input-field">
                <input type="password" name="password_confirmation" placeholder="Confirm your password" class="input-field">
            </div>
            <span class="error-text">@error('password'){{$message}} @enderror </span> 
            <span class="error-text">@error('password_confirmation'){{$message}} @enderror </span>
            <div class="flex space-x-4">
                <button type="submit" class="form-button">Update</button>
                <button type="button" id="back-button" class="form-button bg-gray-500 hover:bg-gray-700">Back</button>
            </div>
        </form>
        

        {{-- <p class="form-text mt-4">Wanna take a break? <a id="delete-button" href="{{ route('deleteApi', $u['id']) }}" method="DELETE" class="form-link">Delete Profile</a></p> --}}
        <form id="delete-form" action="{{ route('deleteApi', $u['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <p class="form-text mt-4"><a  id="delete-button" class="form-link">Delete Profile</a></p>
            {{-- <button type="submit" class="form-text mt-4">Delete Profile</button> --}}
        </form>
        <p class="form-text mt-4"><a  href="{{ route('dashboard') }}" class="form-link">Go back to Dashboard</a></p>
    </div>
</div>

<script>
    document.getElementById('edit-button').addEventListener('click', function () {
        document.getElementById('user-info').style.display = 'none';
        document.getElementById('edit-form').style.display = 'block';
    });

    document.getElementById('back-button').addEventListener('click', function () {
        document.getElementById('edit-form').style.display = 'none';
        document.getElementById('user-info').style.display = 'block';
    });

    document.getElementById('delete-button').addEventListener('click', function () {
        if (confirm('Are you sure you want to delete your profile? This action cannot be undone.')) {
            document.getElementById('delete-form').submit();
        }
    });
</script>

    </body>
</html>
