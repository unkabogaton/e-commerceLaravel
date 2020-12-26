<?php
$total = 0;

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $total = ProductController::cartItem();
    $totalPrice = ProductController::totalPrice();
    $user = auth()->user()->name;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>MerryYenda</title>
    <style>
        @media (max-width: 600px) {
            .card-columns {
                column-count: 1;
            }
        }

        @media (min-width: 600px) {
            .card-columns {
                column-count: 2;
                column-gap: 2rem;
            }
        }

        /* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
        @media (min-width: 768px) {
            .card-columns {
                column-count: 2;
                column-gap: 2rem;
            }
        }

        /* Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {
            .card-columns {
                column-count: 3;
                column-gap: 3rem;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .card-columns {
                column-count: 3;
                column-gap: 3rem;
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

<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<body style="font-family: Poppins, Serif;">
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#4d004d;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">MerryYenda</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mb-2 mb-md-0 ml-auto mr-2">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline"> <a class="nav-link" href="/cart" aria-current="page">Cart</a> <span class="badge badge-light ml-md-n1 ml-1" style="margin-top:-12px;">{{$total}}</span></form>

                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/all-orders" aria-current="page">Orders</a>
                    </li>
                    <li class="nav-item">

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$user}}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item btn btn-link" type="submit"> SignOut </button>
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login" aria-current="page">Signin</a>
                    </li>
                    @endif
                </ul>
                <form class="form-inline my-2 my-md-0">
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>



    <div class="album py-5" style="background-color: white;">
        <div class="container">


            @yield ('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="{!! asset('js/jquery-2.1.0.min.js') !!}"></script>
    <!-- Plugins -->
    <script type="text/javascript" src="{!! asset('js/scrollreveal.min.js') !!}"></script>
    <!-- Global Init -->
    <script type="text/javascript" src="{!! asset('js/custom.js') !!}"></script>

</body>

</html>