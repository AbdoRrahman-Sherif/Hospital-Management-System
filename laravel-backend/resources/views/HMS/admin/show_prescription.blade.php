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

    <title>Prescription Details</title>

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
            <h2>Prescription Details</h2>
            <br>

            @if ($prescription)
                <div class="card">
                    <div class="card-header">
                        <h5>Prescription for Patient ID: {{ $prescription->patient_id }}</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Appointment ID: {{ $prescription->appointment_id }}</h5>
                        <p class="card-text"><strong>Prescriptions:</strong> {{ $prescription->prescriptions }}</p>
                        <p class="card-text"><strong>Allergy:</strong> {{ $prescription->allergy ?? 'N/A' }}</p>
                        <p class="card-text"><strong>Disease:</strong> {{ $prescription->disease }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this prescription?');">Delete</button>
</form>
                        <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Back to Prescriptions</a>
                    </div>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Prescription not found.
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap and JS scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
