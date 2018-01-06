<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .container{
                margin-top: 100px;
                margin-right: 650px;
                height: 200px;
                width: 150px;
                padding-top: 5px;
                padding-left: 35px;
            }
        </style>
    </head>
    <title>Main Page</title>
    <body>
        <div class="container">
            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="window.location='{{ url("student") }}'">Student</button>
            </div>    
            <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("staff")}}'">Staff</button>
            </div>
            <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("organization")}}'">Organization</button>
            </div>
        </div>    
    </body>
</html>
