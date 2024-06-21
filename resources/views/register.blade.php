@include('frontend.header')
<div class="signup-container">
    @session('success')
        <div class="alert alert-success" id="success-alert">
            {{session('success')}}
        </div>
    @endsession
    @session('error')
    <div class="alert alert-error" id="error-alert">
        {{session('error')}}
    </div>
    @endsession
    <div class="signup1">
        <div>
            <img src="{{ asset('images/login.jpg') }}" alt="">
        </div>
        <div>


            <form class="form" action="{{route('register')}}" method="post">
                @csrf
                <h2>Register</h2>
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="text" name="emp_id" id="emp_id" placeholder="Employee ID">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <button type="submit">Register</button>
                </div>
                <div class="form-group">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@include('frontend.footer')

