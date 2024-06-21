@include('frontend.header')
<div class="signup-container">
    @session('success')
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endsession
@session('error')
    <div class="alert alert-error" id="error-alert">
        {{ session('error') }}
    </div>
@endsession
    <div class="login1">
        
        <div>
            <img src="{{asset('images/login.jpg')}}" alt="">
        </div>
        <div>
            <form class="form" action="{{route('login-home')}}" method="post">
                @csrf
                <h2>Login</h2>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <div class="form-group">
                    <p>Don't have an account? <a href="{{route('register')}}">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@include('frontend.footer')
