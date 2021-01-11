<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="all">
    <title>Viewing Orders</title>
    <link rel="icon" href="https://voyager.devdojo.com/assets/images/helm.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />


    <style>
        @media (max-width: 600px) {
            .card-columns {
                column-count: 1;
            }

            .my-image {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        }

        @media (min-width: 600px) {
            .card-columns {
                column-count: 2;
                column-gap: 2rem;
            }

            .my-image {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        }

        /* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
        @media (min-width: 768px) {
            .card-columns {
                column-count: 2;
                column-gap: 2rem;
            }

            .my-image {
                width: 100%;
                height: 500px;
                object-fit: cover;
            }
        }

        /* Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {
            .card-columns {
                column-count: 3;
                column-gap: 3rem;
            }

            .my-image {
                width: 100%;
                height: 500px;
                object-fit: cover;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .card-columns {
                column-count: 4;
                column-gap: 2rem;
            }

            .my-image {
                width: 100%;
                height: 500px;
                object-fit: cover;
            }
        }




        .btn-pusha {
            color: #fff;
            background-color: #660066;
            border-color: #660066;
        }

        .btn-pusha:hover {
            color: #fff;
            background-color: #800080;
            border-color: #800080;
        }

        .btn-check:focus+.btn-pusha,
        .btn-pusha:focus {
            color: #fff;
            background-color: #660066;
            border-color: #660066;
            box-shadow: 0 0 0 0.25rem rgba(51, 0, 51, 0.5);
        }

        .btn-check:checked+.btn-pusha,
        .btn-check:active+.btn-pusha,
        .btn-pusha:active,
        .btn-pusha.active,
        .show>.btn-pusha.dropdown-toggle {
            color: #fff;
            background-color: #660066;
            border-color: #660066;
        }

        .btn-check:checked+.btn-pusha:focus,
        .btn-check:active+.btn-pusha:focus,
        .btn-pusha:active:focus,
        .btn-pusha.active:focus,
        .show>.btn-pusha.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.25rem rgba(51, 0, 51, 0.5);
        }

        .btn-pusha:disabled,
        .btn-pusha.disabled {
            color: #fff;
            background-color: grey;
            border-color: grey;
        }
    </style>
</head>

<body style="font-family: Poppins, Serif; background: white;">

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="{!! asset('js/jquery-2.1.0.min.js') !!}"></script>

</body>

</html>