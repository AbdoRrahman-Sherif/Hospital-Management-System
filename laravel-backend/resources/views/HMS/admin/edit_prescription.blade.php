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

    <title>Edit Prescription</title>

    <style>
        .btn-outline-light:hover {
            color: #25bef7;
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }

        .bg-primary {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
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
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid" style="margin-top:50px;">
        <div class="container">
            <h2>Edit Prescription</h2>
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

            <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="patient_id">Patient ID</label>
                    <input type="text" name="patient_id" class="form-control" value="{{ old('patient_id', $prescription->patient_id) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="appointment_id">Appointment ID</label>
                    <input type="text" name="appointment_id" class="form-control" value="{{ old('appointment_id', $prescription->appointment_id) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="prescriptions">Prescriptions</label>
                    <input type="text" name="prescriptions" class="form-control" value="{{ old('prescriptions', $prescription->prescriptions) }}" required>
                </div>

                <div class="form-group">
                    <label for="allergy">Allergy</label>
                    <input type="text" name="allergy" class="form-control" value="{{ old('allergy', $prescription->allergy) }}">
                </div>

                <div class="form-group">
                    <label for="disease">Disease</label>
                    <input type="text" name="disease" class="form-control" value="{{ old('disease', $prescription->disease) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Prescription</button>
                <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap and JS scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
