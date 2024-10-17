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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <style>
        .btn-outline-light:hover {
            color: #25bef7;
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }

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

        .tab-content {
            padding: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body style="padding-top:50px;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="javascript:void(0);" onclick="window.location.reload();">
    <i class="fa fa-user-plus" aria-hidden="true"></i> Global Hospital
</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

    <!-- Main Content -->
    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-4" style="max-width: 18%; margin-top: 3%;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab" aria-controls="home" data-toggle="tab">Dashboard</a>
                    <a class="list-group-item list-group-item-action" href="#list-app" role="tab" data-toggle="tab">Appointments</a>
                    <a class="list-group-item list-group-item-action" href="#list-pres" role="tab" data-toggle="tab">Prescription List</a>
                </div><br>
            </aside>

            <!-- Tab Content -->
            <main class="col-md-8" style="margin-top: 3%;">
                <div class="tab-content" id="nav-tabContent" style="width: 950px;">
                    <!-- Dashboard Tab -->
                    <div class="tab-pane fade show active" id="list-dash" role="tabpanel">
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-sm-6 text-center">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;"> View Appointments</h4>
                                            <p class="links cl-effect-1">
                                                <a href="#list-app " data-toggle="tab" >Appointment List</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 text-center">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;"> Prescriptions</h4>
                                            <p class="links cl-effect-1">
                                                <a href="#list-pres" data-toggle="tab">Prescription List</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Appointments Tab -->
<div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-home-list">

<table class="table table-hover">
<thead>
            <tr>
                <th>Patient ID</th>
                <th>Appointment ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Doctor Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @if ($appointments && $appointments->isNotEmpty())
            @foreach ($appointments as $appointment)
                @if ($appointment->doctor_id == Auth::guard('doctor')->id())
                    <tr>
                        <td>{{ $appointment->patient ? $appointment->patient->id : 'N/A' }}</td>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->patient ? $appointment->patient->fName : 'N/A' }}</td>
                        <td>{{ $appointment->patient ? $appointment->patient->lName : 'N/A' }}</td>
                        <td>{{ $appointment->patient ? $appointment->patient->gender : 'N/A' }}</td>
                        <td>{{ $appointment->patient ? $appointment->patient->email : 'N/A' }}</td>
                        <td>{{ $appointment->patient ? $appointment->patient->contact : 'N/A' }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->currentStatus }}</td>
                        <td>{{ $appointment->doctor ? $appointment->doctor->name : 'N/A' }}</td>
                        <td>
                            @if ($appointment->currentStatus === 'cancelledByDoctor' || $appointment->currentStatus === 'cancelledByPatient')
                                <span class="badge badge-secondary">Cancelled</span>
                            @else
                                <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure you want to cancel this appointment?')">Cancel</button>
                                </form>
                                <a href="{{ route('prescriptions.create', ['appointment_id' => $appointment->id, 'patient_id' => $appointment->patient->id]) }}" title="Prescribe">
                                    <button class="btn btn-success">Prescribe</button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td colspan="12" class="text-center">No appointments found.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<!-- Prescription List Tab -->
<div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Patient ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Appointment ID</th>
                <th scope="col">Appointment Date</th>
                <th scope="col">Appointment Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if ($prescriptions && $prescriptions->isNotEmpty())
            @foreach ($prescriptions as $prescription)
                @if ($prescription->appointment && $prescription->appointment->doctor_id == Auth::guard('doctor')->id())
                    <tr>
                        <td>{{ $prescription->patient ? $prescription->patient->id : 'N/A' }}</td>
                        <td>{{ $prescription->patient ? $prescription->patient->fName : 'N/A' }}</td>
                        <td>{{ $prescription->patient ? $prescription->patient->lName : 'N/A' }}</td>
                        <td>{{ $prescription->appointment ? $prescription->appointment->id : 'N/A' }}</td>
                        <td>{{ $prescription->appointment ? $prescription->appointment->date : 'N/A' }}</td>
                        <td>{{ $prescription->appointment ? $prescription->appointment->time : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('prescriptions.view', $prescription->id) }}">
                                <button class="btn btn-primary" title="View Prescription">View</button>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">No prescriptions found.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

    <!-- JavaScript and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>


