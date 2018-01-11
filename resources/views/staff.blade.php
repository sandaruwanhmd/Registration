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

            input[type=text], input[type=password] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            /* Set a style for all buttons */
            button {
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
            }

            /* Extra styles for the cancel button */
            .cancelbtn {
                padding: 14px 20px;
                background-color: #f44336;
            }

            /* Float cancel and signup buttons and add an equal width */
            .cancelbtn,.signupbtn {float:left;width:50%}

            /* Add padding to container elements */
            .container {
                padding: 16px;
            }

            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                padding-top: 60px;
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
            }

            /* The Close Button (x) */
            .close {
                position: absolute;
                right: 35px;
                top: 15px;
                color: #000;
                font-size: 40px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: red;
                cursor: pointer;
            }

            /* Clear floats */
            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }

            /* Change styles for cancel button and signup button on extra small screens */
            @media screen and (max-width: 300px) {
                .cancelbtn, .signupbtn {
                width: 100%;
                }
            }
        </style>
    </head>
    <title>Main Page</title>
    <body>
        <div class="container">
            <h2>Staff Login</h2>
            <form>
                <div class="form-group">
                    <label for="userid">User ID:</label>
                    <input type="text" class="form-control" id="userid">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('signupmodel').style.display='block'">Sign Up</button>
                </div>
            </form>
        </div>
        <div id="signupmodel" class="modal">
            <span onclick="document.getElementById('signupmodel').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content animate" method="POST" action="staff/register">
                {{ csrf_field() }}
                <div class="container">

                <label><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" required>    

                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label><b>NIC</b></label>
                <input type="text" placeholder="Enter NIC" name="nic" required>

                <label><b>University Name</b></label>
                <input type="text" placeholder="Enter University Name" name="university_name" required>

                <label><b>University Country</b></label>
                <input type="text" placeholder="Enter Country" name="university_country" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <label><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                <input type="checkbox" checked="checked"> Remember me
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('signupmodel').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn">Sign Up</button>
                </div>
                </div>
            </form>
        </div>
        <script>
            // Get the modal
            var modal = document.getElementById('signupmodel');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>    
    </body>
</html>
