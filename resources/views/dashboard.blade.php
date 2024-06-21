@include('frontend.header')
<div class="dash_container">
    <nav class="nav">
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
    <div class="dash_main">
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
        <div class="dash_main2">
            <div class="dash_main1">
                <span><button id="prev-month" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path
                                d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                        </svg></button>
                    <button id="next-month" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg></button></span>
                        <span><p id="calender"><span>{{date('F Y') }} </span></span> </p></span>
            </div>
            <div class="dash_main3">
                <table class="table">
                    <tr style="background-color: rgb(8, 179, 179);">
                    <th value="monday">Monday</th>
                    <th value="tuesday">Tuesday</th>
                    <th value="wednesday">Wednesday</th>
                    <th value="thursday">Thursday</th>
                    <th value="friday">Friday</th>
                    <th value="saturday">Saturday</th>
                    <th value="sunday">Sunday</th>
                </tr>
                <tbody>
                    @php
                        $day=1;
                        $date=date('d-m-y');
                        $month=date('m');

                    @endphp
                    @for($i=0;$i<5;$i++)
                    <tr>
                        <td>{{$month}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="background-color: rgb(158, 155, 155);">1 </td>
                    </tr>
                    @endfor
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')
