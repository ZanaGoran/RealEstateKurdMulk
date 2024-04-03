<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login-style.css') }}">
</head>
<body class="black-navbar">
<div class="nav-container">
      @include('navbar')
</div>
 <div class="container">
    <div id="login-section" style="display: {{ old('active_form', 'login-section') === 'login-section' ? 'flex' : 'none' }};">
        <!-- Login Form -->
       <!-- Login Form -->
       <form action="{{ url('/login') }}" method="post">
    @csrf

    <div class="input-field">
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required />
    </div>
    <div class="input-field">
        <input type="password" name="password" placeholder="Password" required />
    </div>
    <!-- Display error messages -->
    @if(old('active_form') === 'login-section')
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @else
            @foreach(session('errors')->all() as $error)
                <div class="error-message">
                    {{ $error }}
                </div>
            @endforeach
        @endif
    @endif
    <button type="submit">Login</button>
 </form>


        <p>Don't have an account? <a href="#" onclick="toggleForm('register-section')">Register here</a></p>
    </div>

    <div id="register-section" style="display: {{ old('active_form', 'login-section') === 'register-section' ? 'flex' : 'none' }};">
        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="post">

            @csrf
            <div class="input-field">
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required />
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" required />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="password" name="password" value="{{ old('password') }}"  placeholder="Password" required />
            </div>
            <div class="input-field">
                <input type="text" name="phone" value="{{ old('phone') }}"  placeholder="Phone" required />
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Display error message from session -->
            @if(old('active_form') === 'register-section')
                @if(session('error') && !session('errors'))
                    <div class="error-message">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Display validation errors from session -->
                @if(session('errors') && !session('error'))
                    <div class="error-message">
                        @foreach(session('errors')->get('email') as $error)
                            {{ $error }}<br>
                        @endforeach
                        @foreach(session('errors')->get('password') as $error)
                            {{ $error }}<br>
                        @endforeach
                        @foreach(session('errors')->get('username') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
            @endif
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="#" onclick="toggleForm('login-section')">Login here</a></p>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('toggleRegisterSection'))
            toggleForm('register-section');
        @else
            toggleForm('login-section'); // Set login-section as default
        @endif
    });

    function toggleForm(formId) {
        document.getElementById('login-section').style.display = (formId === 'login-section') ? 'flex' : 'none';
        document.getElementById('register-section').style.display = (formId === 'register-section') ? 'flex' : 'none';
    }
</script>


</body>
</html>