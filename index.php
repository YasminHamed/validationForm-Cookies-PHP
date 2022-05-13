<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
            <div class="container-fluid">
                <ul class="navbar-nav d-flex flex-row">
                    <!-- Icons -->
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#" rel="nofollow"
                            target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#" rel="nofollow" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#" rel="nofollow" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="#" rel="nofollow" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar -->
        <?php

            $name = $email = $website  = $pass = "" ;
            $nameErr = $emailErr = $websiteErr = $passErr = "" ;
            
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $website = $_REQUEST['website'];
            $pass = $_REQUEST['pass'];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                } else {
                    $name = test_input($_POST["name"]);
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                        $nameErr = "Only letters and white spaces are allowed";
                    }
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                } else {
                    $email = test_input($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                    }
                }

                if (empty($_POST["pass"])) {
                    $passErr = "Password is required";
                } else {
                    $pass = test_input($_POST["pass"]);
                    if (!preg_match("/^S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$pass )) {
                        $passErr = "Invalid password  (must contain at least 8 characters/one lowercase letter/one uppercase letter / a number)";
                    }
                }

                if (empty($_POST["website"])) {
                    $websiteErr = "Website is required";
                } else {
                    $website = test_input($_POST["website"]);
                    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                        $websiteErr = "Invalid URL";
                    }
                }

            }
            function test_input($data){
                $data = trim($data); //ignore the spaces
                $data = stripslashes($data); //ignore slashes
                $data = htmlspecialchars($data);
                return $data;
            };


            if(isset($_POST['name'])) {
                $username = htmlentities($_POST['name']);
                setcookie('name', $username, time() +3600);
                if(isset($_COOKIE['name'])) {
                    $done = "User:" . $_COOKIE['name'] . " " . "is set successfully! <br>";
                } else {
                    $done = "User is NOT set !";
                }
            }

        ?>
        <!-- Background image -->
        <div id="intro" class="bg-image shadow-2-strong">
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
                <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-8">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="bg-white  rounded-5 shadow-5-strong p-5">
                        <!-- Name input -->
                        <span class="error">*<?php echo $nameErr;  ?></span>
                        <div class="form-outline mb-4">
                            <input name="name" type="text" id="form1Example2" class="form-control" />
                            <label class="form-label" for="form1Example2">Name</label>
                        </div>   
                        <!-- Email input -->
                        <span class="error">*<?php echo $emailErr;  ?></span>
                        <div class="form-outline mb-4">
                            <input name="email" type="email" id="form1Example1" class="form-control" />
                            <label class="form-label" for="form1Example1">Email address</label>
                        </div>
                        <!-- Password input -->
                        <span class="error">*<?php echo $passErr;  ?></span>
                        <div class="form-outline mb-4">
                            <input name="pass" type="password" id="form1Example2" class="form-control" />
                            <label class="form-label" for="form1Example2">Password</label>
                        </div>
                        <!-- Website input -->
                        <span class="error">*<?php echo $websiteErr;  ?></span>
                        <div class="form-outline mb-4">
                            <input name="website" type="website" id="form1Example2" class="form-control" />
                            <label class="form-label" for="form1Example2">Website</label>
                        </div>
                        Gender:
                        <div class="btn-group">
                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked />
                            <label class="btn btn-primary" for="option1">Male</label>

                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" />
                            <label class="btn btn-primary" for="option2">Female</label>
                        </div>
                        <br>
                        <br>
                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3">
                                    Remember me
                                </label>
                                </div>
                            </div>
                        </div>
                        <!-- Submit button -->
                        <span class="done"><?php echo $done;  ?></span>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </form>
                    <?php
                                $name = $_REQUEST['name'];
                                $email = $_REQUEST['email'];
                                $website = $_REQUEST['website'];
                                $pass = $_REQUEST['pass'];
                    ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </header>


    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"
    ></script>
</body>
</html>