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
    <div class="role_container1" style="margin-top:30px;padding:30px;">
        <section class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                        <h3 class="card-title" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif";>Role List</h3></div>
                        <div class="col-md-12" style="text-align: right;">
                        <a href="{{route('role.add')}}" class="btn btn-primary">Add</a></div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Start Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('frontend.footer')
