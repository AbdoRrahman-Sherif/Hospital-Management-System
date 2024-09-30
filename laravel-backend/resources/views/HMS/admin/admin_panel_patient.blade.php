<!-- in fact: patient panel-->
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-user-plus" aria-hidden="true"></i> Global Hospital
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <style>
            .bg-primary {
                background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            }

            .list-group-item.active {
                z-index: 2;
                color: #fff;
                background-color: #342ac1;
                border-color: #007bff;
            }

            .text-primary {
                color: #342ac1 !important;
            }

            .btn-primary {
                background-color: #3c50c1;
                border-color: #3c50c1;
            }
        </style>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient_logout') }}"><i class="fa fa-sign-out"
                            aria-hidden="true"></i>Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
        </div>
    </nav>
</head>
<style type="text/css">
    button:hover {
        cursor: pointer;
    }

    #inputbtn:hover {
        cursor: pointer;
    }
</style>


<body style="padding-top:50px;">

    <div class="container-fluid" style="margin-top:50px;">
        <h3 style = "margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome
            {{-- @dd($patientData); --}}
            {{ $patientData['fName'] }}
        </h3>
        <div class="row">
            <div class="col-md-4" style="max-width:25%; margin-top: 3%">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list"
                        href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
                    <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list"
                        href="#list-home" role="tab" aria-controls="home">Book Appointment</a>
                    <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab"
                        data-toggle="list" aria-controls="home">Appointment History</a>
                    <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list"
                        role="tab" data-toggle="list" aria-controls="home">Prescriptions</a>

                </div><br>
            </div>
            <div class="col-md-8" style="margin-top: 3%;">
                <div class="tab-content" id="nav-tabContent" style="width: 950px;">


                    <div class="tab-pane fade  show active" id="list-dash" role="tabpanel"
                        aria-labelledby="list-dash-list">
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-sm-4" style="left: 5%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;"> Book My Appointment</h4>
                                            <script>
                                                function clickDiv(id) {
                                                    document.querySelector(id).click();
                                                }
                                            </script>
                                            <p class="links cl-effect-1">
                                                <a href="#list-home" onclick="clickDiv('#list-home-list')">
                                                    Book Appointment
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="left: 10%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">My Appointments</h2>

                                                <p class="cl-effect-1">
                                                    <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                                                        View Appointment History
                                                    </a>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4" style="left: 20%;margin-top:5%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Prescriptions</h2>

                                            <p class="cl-effect-1">
                                                <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                                                    View Prescription List
                                                </a>
                                            </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <!-- Each section here-->
                    <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4>Create an appointment</h4>
                                    </center><br>
                                    <form class="form-group" method="post" id="appointmentForm"
                                        action="{{ route('patient_appointment') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="spec">Specialization:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="spec" class="form-control" id="spec">
                                                    <option value="" disabled selected>Select Specialization
                                                    </option>
                                                    @foreach ($SpecializationsData as $spec)
                                                        <option value="{{ $spec }}">{{ $spec }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <br><br>

                                            <script>
                                                document.getElementById('spec').onchange = function foo() {
                                                    let spec = this.value;

                                                    console.log(spec)
                                                    let docs = [...document.getElementById('doctor').options];

                                                    docs.forEach((el, ind, arr) => {
                                                        arr[ind].setAttribute("style", "");
                                                        if (el.getAttribute("data-spec") != spec) {
                                                            arr[ind].setAttribute("style", "display: none");
                                                        }
                                                    });
                                                };
                                            </script>

                                            <div class="col-md-4"><label for="doctor">Doctors:</label></div>
                                            <div class="col-md-8">
                                                <select name="doctor" class="form-control" id="doctor"
                                                    required="required">
                                                    <option value="" disabled selected>Select Doctor</option>
                                                    @foreach ($DoctorsData as $doctor)
                                                        <option data-value="{{ $doctor['fees'] }}"
                                                            data-spec="{{ $doctor['specialization'] }}"
                                                            value="{{ $doctor['id'] }}">{{ $doctor['name'] }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div><br /><br />


                                            <script>
                                                document.getElementById('doctor').onchange = function updateFees(e) {


                                                    var selection = document.querySelector(`[value='${this.value}']`).getAttribute('data-value');
                                                    document.getElementById('docFees').value = selection;
                                                };
                                            </script>





                                            <!-- <div class="col-md-4"><label for="doctor">Doctors:</label></div>
                                <div class="col-md-8">
                                    <select name="doctor" class="form-control" id="doctor1" required="required">
                                      <option value="" disabled selected>Select Doctor</option>

                                    </select>
                                </div>
                                <br><br> -->

                                            <!-- <script>
                                                document.getElementById("spec").onchange = function updateSpecs(event) {
                                                    var selected = document.querySelector(`[data-value=${this.value}]`).getAttribute("value");
                                                    console.log(selected);

                                                    var options = document.getElementById("doctor1").querySelectorAll("option");

                                                    for (i = 0; i < options.length; i++) {
                                                        var currentOption = options[i];
                                                        var category = options[i].getAttribute("data-spec");

                                                        if (category == selected) {
                                                            currentOption.style.display = "block";
                                                        } else {
                                                            currentOption.style.display = "none";
                                                        }
                                                    }
                                                }
                                            </script> -->


                                            <!-- <script>
                                                let data =

                                                    document.getElementById('spec').onchange = function updateSpecs(e) {
                                                        let values = data.filter(obj => obj.spec == this.value).map(o => o.username);
                                                        document.getElementById('doctor1').value = document.querySelector(`[value=${values}]`).getAttribute(
                                                            'data-value');
                                                    };
                                            </script> -->



                                            <div class="col-md-4"><label for="consultancyfees">
                                                    Consultancy Fees
                                                </label></div>
                                            <div class="col-md-8">
                                                <!-- <div id="docFees">Select a doctor</div> -->
                                                <input class="form-control" type="text" name="docFees"
                                                    id="docFees" readonly="readonly" />
                                            </div><br><br>

                                            <div class="col-md-4"><label>Appointment Date</label></div>
                                            <div class="col-md-8"><input type="date"
                                                    class="form-control datepicker" id="appdate" name="appdate">
                                            </div>
                                            <br><br>


                                            <script>
                                                document.getElementById('appointmentForm').addEventListener('submit', function(event) {
                                                    // Get the value of the date input
                                                    console.log('helllloooo');

                                                    const appointmentDate = document.getElementById('appdate').value;
                                                    const errorMessage = document.getElementById('error-message');
                                                    const today = new Date();
                                                    const selectedDate = new Date(appointmentDate);

                                                    // Clear any previous error messages
                                                    errorMessage.textContent = '';

                                                    // Check if the date is empty
                                                    if (!appointmentDate) {
                                                        errorMessage.textContent = 'Please select an appointment date.';
                                                        event.preventDefault(); // Prevent form submission
                                                        return;
                                                    }

                                                    // Check if the selected date is in the past
                                                    if (selectedDate < today) {
                                                        errorMessage.textContent = 'The appointment date cannot be in the past.';
                                                        event.preventDefault(); // Prevent form submission
                                                        return;
                                                    }

                                                    // Optionally, you can add further validation if needed
                                                });
                                            </script>




                                            <div class="col-md-4"><label>Appointment Time</label></div>
                                            <div class="col-md-8">
                                                <!-- <input type="time" class="form-control" name="apptime"> -->
                                                <select name="apptime" class="form-control" id="apptime"
                                                    required="required">
                                                    <option value="" disabled selected>Select Time</option>
                                                    <option value="08:00:00">8:00 AM</option>
                                                    <option value="10:00:00">10:00 AM</option>
                                                    <option value="12:00:00">12:00 PM</option>
                                                    <option value="14:00:00">2:00 PM</option>
                                                    <option value="16:00:00">4:00 PM</option>
                                                </select>

                                            </div><br><br>

                                            <div class="col-md-4">
                                                <input type="submit" name="app-submit" value="Create new entry"
                                                    class="btn btn-primary" id="inputbtn">
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>
                                        <div id="error-message" style="color: red;"></div>

                                    </form>
                                </div>
                            </div>
                        </div><br>
                    </div>

                    <div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">

                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th scope="col">Doctor Name</th>
                                    <th scope="col">Consultancy Fees</th>
                                    <th scope="col">Appointment Date</th>
                                    <th scope="col">Appointment Time</th>
                                    <th scope="col">Current Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>
                                            {{ $appointment->doctor_name }}
                                        </td>
                                        <td>
                                            {{ $appointment->fees }}
                                        </td>
                                        <td>
                                            {{ $appointment->date }}
                                        </td>
                                        <td>
                                            {{ $appointment->time }}
                                        </td>
                                        <td>
                                            {{ $appointment->currentStatus }}
                                        </td>
                                        <td>
                                            @if ($appointment->currentStatus == 'Active')
                                                <form method="POST" action="{{ route('cancel_appointment') }}"
                                                    onsubmit="return confirmCancel()">
                                                    @csrf
                                                    <input type="hidden" name="appointment"
                                                        value="{{ $appointment->id }}">
                                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                                </form>

                                                <script>
                                                    function confirmCancel() {
                                                        return confirm("Are you sure you want to cancel this appointment?");
                                                    }
                                                </script>
                                            @else
                                                Cancelled
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>



                    <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Doctor Name</th>
                                    <th scope="col">Appointment ID</th>
                                    <th scope="col">Appointment Date</th>
                                    <th scope="col">Appointment Time</th>
                                    <th scope="col">Diseases</th>
                                    <th scope="col">Allergies</th>
                                    <th scope="col">Prescriptions</th>
                                    <th scope="col">Bill Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>
                                            {{ $appointment->doctor_name }}
                                        </td>
                                        <td>
                                            {{ $appointment->id }}
                                        </td>
                                        <td>
                                            {{ $appointment->date }}
                                        </td>
                                        <td>
                                            {{ $appointment->time }}
                                        </td>
                                        <td>
                                            {{ $appointment->disease }}
                                        </td>
                                        <td>
                                            {{ $appointment->allergy }}
                                        </td>
                                        <td>
                                            {{ $appointment->prescriptions }}
                                        </td>
                                        <td>
                                            <form method="get">
                                                <a href="">
                                                    <input type ="hidden" name="ID" value="" />
                                                    <input type = "submit" onclick="alert('Bill Paid Successfully');"
                                                        name ="generate_bill" class = "btn btn-success"
                                                        value="Pay Bill" />
                                                </a>
                                        </td>

                                        </form>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>




                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>



</body>

</html>
