<!DOCTYPE html>
<html>

<head>
    <title>Leave Management System</title>
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
    <div class="modal fade" id="eventTitleModal" tabindex="-1" role="dialog" aria-labelledby="eventTitleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: orange;">
                    <h5 class="modal-title" id="eventTitleModalLabel">Employee Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-left:280px;border:transparent;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        @csrf
                        <input type="text" id="tab_id" class="form-control" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" id="name" class="form-control" value="{{ Auth::user()->name }}"
                            disabled><br>
                        <input type="text" id="emp_id" class="form-control" value="{{ Auth::user()->emp_id }}"
                            disabled><br>
                        <input type="text" id="date_from" class="form-control" value="" disabled><br>
                        <input type="text" id="date_to" class="form-control" value="" disabled><br>
                        <div style="display:flex;justify-content:space-evenly;">
                            <span class="form-check" >
                                <input class="form-check-input" value="Halfday" type="radio" name="day" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Halfday
                                </label>
                              </span>
                            <span class="form-check">
                                <input class="form-check-input" value="Fullday" type="radio" name="day" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Fullday
                                </label>
                              </span>
                        </div>

                        <input type="text" id="description" class="form-control" id="floatingTextarea"
                            style="height: 80px;width:90%;margin:20px" name="description" placeholder="Description">
                        <span id="titleerror" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="sbt" class="btn btn-primary" id="saveEventTitle">Apply
                        Leave</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- details modal --}}
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="eventTitleModalLabel"
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
                                <td>{{ Auth::user()->name }}</td>
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
                    <button type="button" id="" class="btn btn-danger del_btn"
                        data-bs-dismiss="modal">Cancel Leave</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
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
            select: function(start, end, allDays) {
                let current_date = new Date().toISOString().slice(0, 10);
                let start_date = moment(start).format('YYYY-MM-DD');
                let end_date = moment(end).format('YYYY-MM-DD');
                let prev_date = moment(end).subtract(1, 'day').format('YYYY-MM-DD');
                if (current_date <= start_date) {
                    $('#eventTitleModal').modal('show');
                $('#date_from').val(start_date);
                $('#date_from').val(start_date);
                $('#date_to').val(prev_date);
                $('#sbt').click(function() {
                    let leave_type=$("input[type='radio'][name=day]:checked", '#form').val();
                    start_date = moment(start).format('YYYY-MM-DD');
                    let description = $('#description').val();
                    let user_id = $('#tab_id').val();
                    $.ajax({
                        url: '/calender/store',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            description: description,
                            start_date: start_date,
                            end_date: end_date,
                            apply_date: current_date,
                            user_id: user_id,
                            leave_type:leave_type,
                        },
                        success: function(response) {
                            $('#eventTitleModal').modal('hide');
                            displayMessage("Leave applied Successfully");
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': name,
                                'start': response.start_date,
                                'end': response.end_date,
                            })
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleerror').html(error.responseJSON.errors
                                    .description);
                            }
                        }
                    });
                })
                }
            },
            eventClick: function(event) {
                let cr_date = new Date().toISOString().slice(0, 10);
                $('#successModal').modal('show');
                let id = event.id;
                $('.cr_date').text(event.apply_date.slice(0, 10));
                $('.lv_date').text(event.start_date.slice(0, 10));
                let date = moment(event.end_date.slice(0, 10));
                let previousDate = date.subtract(1, 'day').format('YYYY-MM-DD');
                $('.lv_date_to').text(previousDate);
                $('.sts').text(event.status);
                $('.lv_type').text(event.leave_type);
                $('.desc').text(event.description);
                $('.del_btn').attr('id', 'del_btn' + id);
                if (cr_date <= event.start_date.slice(0, 10)) {
                    $('#del_btn' + id).show();
                    $('#del_btn' + id).click(function() {
                        if (confirm('Are you sure to remove the leave?')) {
                            $.ajax({
                                url: '/calender/delete',
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    $('#calendar').fullCalendar('removeEvents',
                                        response);
                                    displayMessage("Event Deleted Successfully");
                                },
                                error: function(error) {
                                    var errors = error.responseJSON;
                                    console.log(errors);
                                }
                            })
                        }
                    })
                } else {
                    $('#del_btn' + id).hide();
                }
            },
            // selectAllow: function(event){
            //     return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1,'second').utcOffset(false),'day');
            // },
        });
        $('#eventTitleModal').on('hidden.bs.modal', function() {
            $('#sbt').unbind();
        });
        $('#successModal').on('hidden.bs.modal', function() {
            $('.del_btn').unbind();
        });
        $('.fc-day-header').css('background-color','#05F9DB');
    });
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
</script>
