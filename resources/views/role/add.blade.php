@include('frontend.header')
<link rel="stylesheet" href="css/custom1.css">
<div class="role_container" style="margin-bottom: 560px;">
    <nav class="nav" style=" width:1360px; margin-top:220px;background-color:rgb(240, 198, 144);padding:5px;">
        <div class="btn-group">
            <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-bs-haspopup="true" aria-bs-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>
    <div class="add_container">
        <div class="pagetitle">
            <h1>Add New Role</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
    @include('frontend.footer')
