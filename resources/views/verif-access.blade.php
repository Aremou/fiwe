<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorisation d'accès </title>
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico ') }}">

    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css ">
    <link href="{{ asset('dashboard/css/icons.css') }}" rel="stylesheet" type="text/css ">
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet" type="text/css ">

    {{-- <link href="{{ asset('dashboard/css/jquery-ui.css') }}" rel="stylesheet" type="text/css "> --}}

    <style>
        .centered {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

    </style>
</head>

<body class="pb-0">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    {{-- {{ configuration() }} --}}
    @if(auth()->user()->role == NULL)

    <div class="centered m-auto">
        <h3 class="mt-4 text-uppercase">Bienvenu sur notre application</h3>
        <p>Votre demande d'inscription a été enregistrée avec succès. Patienter le temps que l'administrateur valide votre inscription</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary" type="submit">Connectez-vous</button>
        </form>

    </div>
    @else
    @php
    header('Refresh: 1;URL=/');
    @endphp
    @endif


    <script src="{{ asset('dashboard/js/jquery.min.js ') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js ') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.slimscroll.js ') }}"></script>
    {{-- <script src="{{ asset('dashboard/js/jquery.scrollTo.min.js ') }}"></script> --}}

    <!-- App js -->
    <script src="{{ asset('dashboard/js/app-drixo.js ') }}"></script>

    <!-- countdown js -->
    <script src="{{ asset('dashboard/plugins/countdown/jquery.countdown.min.js ') }}"></script>
    {{-- <script src="{{ asset('dashboard/pages/countdown.int.js ') }}"></script> --}}

</body>

</html>
