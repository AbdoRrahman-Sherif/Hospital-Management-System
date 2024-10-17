<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <title>Create Prescription</title>

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
    </style>
</head>

<body style="padding-top:50px;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Global Hospital </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-sign-out"
                            aria-hidden="true"></i>Logout</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('searchContact') }}">
                @csrf
                <input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" aria-label="Search" name="contact">
                <input type="submit" class="btn btn-outline-light" id="inputbtn" name="search_submit" value="Search">
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid" style="margin-top:50px;">
        <div class="container">
            <h2>Create Prescription</h2>
            <br>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('prescriptions.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="patient_id">Patient ID</label>
                    <input type="text" name="patient_id" class="form-control" value="{{ $patient_id ?? old('patient_id') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="appointment_id">Appointment ID</label>
                    <input type="text" name="appointment_id" class="form-control" value="{{ $appointment_id ?? old('appointment_id') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="prescriptions">Prescriptions</label>
                    <input type="text" name="prescriptions" class="form-control" value="{{ old('prescriptions') }}" required>
                </div>

                <div class="form-group">
                    <label for="allergy">Allergy</label>
                    <input type="text" name="allergy" class="form-control" value="{{ old('allergy') }}">
                </div>

                <div class="form-group">
                    <label for="disease">Disease</label>
                    <input type="text" name="disease" class="form-control" value="{{ old('disease') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Prescription</button>
                <a href="{{ $prescription_id ? route('prescriptions.edit', ['prescription' => $prescription_id]) : '#' }}" 
   class="btn btn-secondary {{ $prescription_id ? '' : 'disabled' }}">
   Edit Prescription
</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap and JS scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
