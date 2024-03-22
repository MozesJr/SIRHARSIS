<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>E-CODEC | 404 Not Found</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Informasi Report HARSIS (SIMHARSIS)" />
    <meta name="keywords" content="SIMHARSIS">
    <meta name="author" content="MozesJR" />
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/feather.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/fontawesome.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/material.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/style.css"
        id="main-style-link" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/style-preset.css" />
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
    data-pc-theme="light">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="maintenance-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card error-card">
                        <div class="card-body">
                            <div class="error-image-block">
                                <img class="img-fluid"
                                    src="https://ableproadmin.com/bootstrap/default/assets/images/pages/img-error-404.svg"
                                    alt="img">
                            </div>
                            <div class="text-center">
                                <h1 class="mt-5"><b>Page Not Found</b></h1>
                                <p class="mt-2 mb-4 text-muted">The page you are looking was moved, removed,<br>
                                    renamed, or
                                    might never exist!</p>
                                <a href="/" class="btn btn-primary mb-3">Go to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/dashboard-default.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/popper.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/simplebar.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/bootstrap.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/fonts/custom-font.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pcoded.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/feather.min.js"></script>
</body>

</html>
