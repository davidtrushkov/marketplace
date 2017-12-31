<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .EMAIL-HEADER {
            background: linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);
            background-image: -ms-linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);
            background-image: -moz-linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);
            background-image: -o-linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);
            background-image: -webkit-linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);
            background-image: linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);
            padding: 50px;
        }
        .EMAIL-HEADER h2 {
            text-align: center;
            color: #FFFFFF;
            font-weight: bold;
        }

    </style>
</head>
<body>

<div class="container-fluid" style="padding-left: 0; padding-right: 0;">
    <div class="EMAIL-HEADER">
        <h2>Marketplace</h2>
    </div>

    <div class="container">
        @yield('content')

        <p>Thanks, <br />{{ config('app.name') }}</p>
    </div>
</div>

</body>
</html>