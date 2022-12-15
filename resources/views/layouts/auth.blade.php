<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css">

</head>

<body class="bg-gradient-primary">

    @yield('content')

    <div class="flash-data" data-text="{{ session()->get('text')  }}" data-title="{{ session()->get('title')  }}" data-icon="{{ session()->get('icon') }}"></div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
    <script src="{{ asset('assets/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript">
        document.write("</bo" + "dy>" + "</ht" + "ml>");
        const textflashData = $('.flash-data').data('text');
        const titleflashData = $('.flash-data').data('title');
        const iconflashData = $('.flash-data').data('icon');

        if (textflashData && titleflashData && iconflashData) {
            Swal.fire({
                title: titleflashData
                , text: textflashData
                , icon: iconflashData
            });
        }

    </script>
    <!-- </body></html> -->
</Body>

</html>
