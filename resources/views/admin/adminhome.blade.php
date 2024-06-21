<!DOCTYPE html>
<html>

<head>
    <title>Leave Management System-Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/custom2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .table {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        .tbody {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="dash_container">
        <nav class="nav1">
            <div class="notification">
                <button id="liveToastBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
                        <strong id="st">{{ $unseen }}</strong>
                    </svg></button>
                <div class="toast-container position-fixed top-1 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="{{ asset('images/bell.jpg') }}" class="rounded me-2" alt="..."
                                style="width: 20px;height:20px;">
                            <strong class="me-auto">Notifications</strong>
                            <small id="small"></small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body" style="background-color: white;">
                            @foreach ($name as $x)
                                <p style="height: 10px;"><span>{{ $x->name }} applied for leave. </span><span
                                        style="float:right;" id="timeCreated">{{ $x->created_at }}</span></p>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
        <div class="container">
            <div class="card mt-5">
                <h3 class="card-header p-3"
                    style="background-color: orange;font-family:Georgia, 'Times New Roman', Times, serif;">Leave
                    Management Portal</h3>
                <div class="card-body">
                    <div id='calendar'
                        style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- details modal --}}
    <div class="modal fade" id="successModal1" tabindex="-1" role="dialog" aria-labelledby="eventTitleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: orange;height:40px;">
                    <h5 class="modal-title" id="eventTitleModalLabel">Employee Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-left:280px;border:transparent;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="panel panel-primary">
                    <table class="table table-striped tbl-width">
                        <tbody class="tbody">
                            <tr>
                                <td>Employee Name</td>
                                <td class="emp_name"></td>
                            </tr>
                            <tr>
                                <td>Employee ID</td>
                                <td>{{ Auth::user()->emp_id }}</td>
                            </tr>
                            <tr>
                                <td>Leave Placed On</td>
                                <td class="cr_date"></td>
                            </tr>
                            <tr>
                                <td>Leave From</td>
                                <td class="lv_date"></td>
                            </tr>
                            <tr>
                                <td>Leave Upto</td>
                                <td class="lv_date_to"></td>
                            </tr>
                            <tr>
                                <td>Leave Type</td>
                                <td class="lv_type"></td>
                            </tr>
                            <tr>
                                <td>Leave Status</td>
                                <td class="sts"></td>
                            </tr>
                            <tr>
                                <td>Leave Description</td>
                                <td class="desc"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-success accept_btn"
                        data-bs-dismiss="modal">Accept</button>
                    <button type="button" id="" class="btn btn-danger reject_btn"
                        data-bs-dismiss="modal">Reject</button>
                    <button type="button" id="" class="btn btn-info revert_btn">Revert</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')

    if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show()
        })
    }
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name = $("#name").val();
        var events = @json($events);
        $('#calendar').fullCalendar({
            header: {
                // left:'prev, next today',
                left: '',
                center: 'title',
                // right:'month, agendaWeek, agendaDay'
            },
            events: events,
            selectable: true,
            selectHelper: true,

            eventClick: function(event) {
                let cr_date = new Date().toISOString().slice(0, 10);
                $('#successModal1').modal('show');
                let id = event.id;
                $('.cr_date').text(event.apply_date.slice(0, 10));
                $('.lv_date').text(event.start_date.slice(0, 10));
                let date = moment(event.end_date.slice(0, 10));
                let previousDate = date.subtract(1, 'day').format('YYYY-MM-DD');
                $('.lv_date_to').text(previousDate);
                $('.sts').text(event.status);
                $('.reject_btn').attr('id', 'reject_btn' + id);
                $('.accept_btn').attr('id', 'accept_btn' + id);
                $('.revert_btn').attr('id', 'revert_btn' + id);
                if (event.status !== 'Applied') {
                    $('#revert_btn' + id).show();
                    $('#accept_btn' + id).hide();
                    $('#reject_btn' + id).hide();
                } else {
                    $('#revert_btn' + id).hide();
                    $('#accept_btn' + id).show();
                    $('#reject_btn' + id).show();
                }
                $('#revert_btn' + id).click(function() {
                    $.ajax({
                        url: '/calender/admin/revert',
                        type: "POST",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            displayMessage(
                                "Reverted Successfully");
                        },
                        error: function(error) {
                            var errors = error.responseJSON;
                            console.log(errors);
                        }
                    })
                    $('#revert_btn' + id).hide();
                    $('#accept_btn' + id).show();
                    $('#reject_btn' + id).show();
                })
                $('.lv_type').text(event.leave_type);
                $('.desc').text(event.description);
                $('.emp_name').text(event.name);

                $('#reject_btn' + id).click(function() {
                    if (confirm('Are you sure to Unapprove?')) {
                        $.ajax({
                            url: '/calender/admin/reject',
                            type: "POST",
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                displayMessage(
                                    "Unapproved Successfully");
                            },
                            error: function(error) {
                                var errors = error.responseJSON;
                                console.log(errors);
                            }
                        })
                    }
                })
                $('#accept_btn' + id).click(function() {
                    if (confirm('Are you sure to approve?')) {
                        $.ajax({
                            url: '/calender/admin/approve',
                            type: "POST",
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                displayMessage(
                                    "Approved Successfully");
                            },
                            error: function(error) {
                                var errors = error.responseJSON;
                                console.log(errors);
                            }
                        })
                    }
                })
            },
            // selectAllow: function(event){
            //     return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1,'second').utcOffset(false),'day');
            // },
        });
        $('#successModal1').on('hidden.bs.modal', function() {
            $('.reject_btn').unbind();
            $('.accept_btn').unbind();
            $('.revert_btn').unbind();
        });
        $("#liveToastBtn").click(function() {
            $.ajax({
                url: '/admin/notification',
                type: "POST",
                dataType: 'json',
                success: function(response) {
                    $('#st').text(response);
                    const currentDateTime = new Date();
                    const year = currentDateTime.getFullYear();
                    const month = String(currentDateTime.getMonth() + 1).padStart(2, '0');
                    const day = String(currentDateTime.getDate()).padStart(2, '0');
                    const hour = String(currentDateTime.getHours()).padStart(2, '0');
                    const minute = String(currentDateTime.getMinutes()).padStart(2, '0');
                    const second = String(currentDateTime.getSeconds()).padStart(2, '0');
                    const formattedDateTime =
                        `${year}-${month}-${day} ${hour}:${minute}:${second}`;
                    let time1 = new Date(formattedDateTime);
                    let dt=$('#timeCreated').text();
                    let time2 = new Date(dt);
                    let difference = time1 - time2;
                    let minutes = Math.floor((difference / (1000 * 60)) % 60);
                    let hours = Math.floor((difference / (1000 * 60 * 60)) % 24);
                    if(hours!=0){
                        $('#small').text(hours+" hours ago");
                    }else{
                        $('#small').text(minutes+" minutes ago");
                    }
                },
                error: function(error) {
                    let errors = error.responseJSON;
                    console.log(errors);
                }
            })
        })
        $('.fc-day-header').css('background-color','#05F9DB');
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
</script>
