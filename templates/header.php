<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Privateness exchange &lt;BTC -&gt; NESS&gt;</title>

    <!-- Custom CSS for appealing UI -->
    <style>
        /* Laptops */
        @media only screen and (min-width: 1025px) and (max-width: 1280px) {

            input {
                padding: 17px;
            }

            .btn-primary {

                cursor: pointer;

            }

            .btn-primary:hover {
                background-color: #1F4E79;
            }

            input:hover {
                border: 3px solid slateblue;
                border-radius: 6px;
            }

        }

        /* Desktops */
        @media only screen and (min-width: 1281px) {
            input {
                padding: 22px;
            }

            .btn-primary,
            .btn-success,
            .btn-danger,
            .copy-button {

                cursor: pointer;

            }

            .btn-primary:hover {
                background-color: #1F4E79;
            }

            input:hover {
                border: 3px solid slateblue;
                border-radius: 6px;
            }

        }

        input {
            padding: 10px;
        }

        body {
            /* background-color: #367CA5; */
            background: URL(/img/nesss-blue.jpg);
            color: white;
            font-family: Arial, sans-serif;
            background-repeat: none;
            background-size: auto 200%;
        }

        .container {
            padding: 20px;
            margin: 20px auto;
            max-width: 90%;
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
            color: grey;
            position: absolute;
            margin-top: 6%;
            margin-left: 6%;
        }



        .btn-primary {
            background-color: #367CA5;
            border: none;
            margin-top: 7%;
            margin-left: 6%;
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .btn-primary:active {
            background-color: #1B4F73;
        }

        blockquote {
            color: #367CA5
        }

        h1,
        h3,
        h4 {
            color: #367CA5;
            text-align: center;
        }

        h4 {
            text-align: left;
        }

        .form-control {
            border: 2px solid #367CA5;
            border-radius: 5px;
            color: #367CA5;
            outline-color: skyblue;
            margin-top: 7%;
            margin-left: 6%;
            width: 90%;
            max-width: 500px;
        }

        input {
            padding: 6px;
        }


        .form-text {
            color: #1B4F73;
            font-size: 10px;
            margin-left: 7%;
        }

        textarea {

            outline-color: skyblue;
        }

        .alert {
            color: red;
            font-size: medium;
            font-weight: bold;
        }

        .result {
            color: green;
        }

        .error {
            color: red !important;
        }

        a.nav-link,a.navbar-brand {
            color: #367CA5;
        }

        a.nav-link:hover,a.navbar-brand:hover {
            color: blue;
        }

        a.nav-link.active {
            color: #367CA5 !important;
            font-weight: bold;
        }

        .navbar {
            background-color: white !important;
        }

        .copy-button {
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;

        }
        
        .copy-button:active {
             background-color: lightgreen;
        }

        .tip {
            background-color: #263646;
            padding: 0 14px;
            line-height: 27px;
            position: absolute;
            border-radius: 4px;
            z-index: 100;
            color: #fff;
            font-size: 12px;
            animation-name: tip;
            animation-duration: .6s;
            animation-fill-mode: both;
        }

        .tip:before {
            content: "";
            background-color: #263646;
            height: 10px;
            width: 10px;
            display: block;
            position: absolute;
            transform: rotate(45deg);
            top: -4px;
            right: 17px;
        }

        #copied_tip {
            animation-name: come_and_leave;
            animation-duration: 1s;
            animation-fill-mode: both;
            bottom: -35px;
            right: 2px;
            float: right;
        }

        #copy_button {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
            background-color: white;
        }


        .progress {
            height: 40px;
        }

        .progress-bar {
            font-size: 32px;
        }

        p, cite, li {
            color: black;
        }
        cite {
            font-weight: bold;
            letter-spacing: 2px;
        }
    </style>

    <link href="/css/darkmode.css" rel="stylesheet" />
</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Privateness exchange BTC -&gt; NESS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link <?php if(isset($__create)): ?>active<? endif; ?>" href="/create-token.php">Invest</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if(isset($__donations)): ?>active<? endif; ?>"  href="/donations.php">Investments</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if(isset($__token)): ?>active<? endif; ?>"  href="/token.php">Find</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php if(isset($__about)): ?>active<? endif; ?>"  href="/about.php">About</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <!-- Dark mode toggle icons -->

    <img class="toggle-icon" src="/img/dark-mode.png" alt="/img/dark-mode.png">