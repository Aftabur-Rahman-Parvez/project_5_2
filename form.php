<?php
//index.php

$error = '';
$name = '';
$email = '';
$phone = '';
$company = '';
$category = '';
$address = '';
$message = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["submit"]))
{
    if(empty($_POST["name"]))
    {
        $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
    }
    else
    {
        $name = clean_text($_POST["name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
        }
    }
    if(empty($_POST["email"]))
    {
        $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
    }
    else
    {
        $email = clean_text($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error .= '<p><label class="text-danger">Invalid email format</label></p>';
        }
    }
    if(empty($_POST["phone"]))
    {
        $error .= '<p><label class="text-danger">Phone is required</label></p>';
    }
    else
    {
        $subject = clean_text($_POST["phone"]);
    }
    if(empty($_POST["company"]))
    {
        $error .= '<p><label class="text-danger">Company is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["company"]);
    }
    if(empty($_POST["category"]))
    {
        $error .= '<p><label class="text-danger">Category is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["category"]);
    }
    if(empty($_POST["address"]))
    {
        $error .= '<p><label class="text-danger">Address is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["address"]);
    }
    if($error == '')
    {
        require 'class/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();        //Sets Mailer to send message using SMTP
        $mail->Host = 'mail.feits.co';  //Sets the SMTP hosts
        $mail->Port = '465';        //Sets the default SMTP server port
        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'web@feits.co';     //Sets SMTP username/gmail
        $mail->Password = 'web@feits';     //Sets SMTP password
        $mail->SMTPSecure = 'ssl';       //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = $_POST["email"];     //Sets the From email address for the message
        $mail->FromName = $_POST["name"];    //Sets the From name of the message
        $mail->AddAddress('web@feits.co', 'web@feits.co');//Adds a "To" address
        $mail->AddCC($_POST["email"], $_POST["name"]); //Adds a "Cc" address
        $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);       //Sets message type to HTML
        $mail->Subject = $_POST["category"];    //Sets the Subject of the message
        $mail->Body ='<h4>User Request from feits.co website</h4>'.'<br>'.'Name:'.$_POST["name"].'<br>'.$_POST["email"].'<br>'.'Mobile:'.$_POST["phone"].'<br>'.'Company:'.$_POST["company"].'<br>'.'Required Software:'.$_POST["category"].'<br>'.'Address:'.$_POST["address"];    //An HTML or plain text message body
        if($mail->Send())        //Send an Email. Return true on success or false on error
        {
            $error = '<label class="text-success">Thank you for contacting us</label>';
        }
        else
        {
            $error = '<label class="text-danger">There is an Error</label>';
        }
        $error = '';
        $name = '';
        $email = '';
        $phone = '';
        $company = '';
        $category = '';
        $address = '';
        $message = '';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Far East IT Solutions Limited</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="FEITS provides world class web-based software solutions and mobile application development services to ensure maximum client satisfaction." />
    <meta name="keywords" content="Feits" />
    <link id="favicon" rel="shortcut icon"  href="images/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300i,400,500,500i,600,600i,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="css/imagehover.css">
    <link rel="stylesheet" href="css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/pages.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="80">
    <header id="first-menu">
            <nav class="navbar navbar-expand-lg  fixed-top top-menu">
                <div class="container">
                    <a href="index.html" class="navbar-brand">
                        <img src="images/feits_logo_white.png" alt="" class="img-fluid">
                    </a>
    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""><i class="fa fa-bars"></i></span>
                    </button>
    
                    <div id="navbarNavDropdown" class="collapse navbar-collapse nav-1">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="index.html" class="nav-link hvr-underline-from-center">Home</a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" id="navlink-1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Services
                                </a>
                                <ul class="dropdown-menu submenu-1" aria-labelledby="navlink-1">
                                    <li><a class="dropdown-item" href="masking-sms.html">Masking Bulk SMS</a></li>
                                    <li><a class="dropdown-item" href="non-masking-bulk-sms.html">Non-Masking Bulk SMS</a></li>
                                    <li><a class="dropdown-item" href="domain.html">Domain/Hosting</a></li>
                                    <li><a class="dropdown-item" href="web-design-development.html">Web Design & Development</a></li>
                                    <li><a class="dropdown-item" href="mobile-apps-development.html" >Mobile Apps Development</a></li>	
                                </ul>
                            </li>
    
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" id="navlink-1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Products
                                </a>
                                <ul class="dropdown-menu submenu-1" aria-labelledby="navlink-1">
                                    <li><a class="dropdown-item" href="https://www.feitshrms.net/" target="_blank">Human Resource Management System</a></li>
                                    <li><a class="dropdown-item" href="diagonistic-management-system.html">Diagnostic Center Management System</a></li>
                                    <li><a class="dropdown-item" href="restaurant-management-system.html">Restaurant Management System</a></li>
                                    <li><a class="dropdown-item" href="pharmacy-management-system.html">Pharmacy Management System</a></li>
                                    <li><a class="dropdown-item" href="feits-healthcare.html">FEITS Healthcare System</a></li>
                                    <li><a class="dropdown-item" href="shop-inventory-management-system.html"> Shop Inventory Management System</a></li>
    
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hvr-underline-from-center" href="team.html">Team</a>
                            </li>
                            <li class="nav-item">
                                <a href="career.html" class="nav-link hvr-underline-from-center ">Career</a>
                            </li>
    
                            <li class="nav-item">
                                <a href="about-us.html" class="nav-link hvr-underline-from-center ">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="contact_us.html" class="nav-link hvr-underline-from-center ">Contact Us</a>
                            </li>
                        </ul>
    
    
                    </div>
    
                </div>
            </nav>
    </header>
<section id="home" class="mainbg from-login">
    <div class="home-overlay"></div>
    <div class="home-content form-content">
        <div class="container">
            <div class="row">
                <div class="home-content-inner from-part-inner">
                    <div class="col-md-10 col-lg-9 m-auto col-sm-12 col-12">
                        <h3 class="text-center">Demo Request</h3>
                        <span class="demo-span"></span>
                        <?php echo $error; ?>
                        <form  method="post">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name"> Name *</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" id="uname" value="<?php echo $name; ?>">
                                        <span id="unames" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name">Email *</label>
                                        <input type="text" class="form-control" placeholder="Email" name="email" id="uemail" value="<?php echo $email; ?>">
                                        <span id="uemails" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name">Phone Number * </label>
                                        <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="mobilenum">
                                        <span id="mobilenums" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name">Company Name</label>
                                        <input type="text" class="form-control" placeholder="Company Name" name="company" id="companyname" >
                                        <span id="companynames" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="FormControlSelect" class="demo-label-name"> Choose Your Software * </label>
                                        <select name="category" class="form-control">
                                            <option value="">Choose Your Software.....</option>
                                            <option value="Human Rresource Management System">Human Rresource Management System</option>
                                            <option value="Diagonistic Management System">Diagonistic Management System</option>
                                            <option value="Restaurant Management System">Restaurant Management System</option>
                                            <option value="Pharmacy Management System">Pharmacy Management System</option>
                                            <option value="Pharmacy Management System">FEITS Healthcare</option>
                                            <option value="shop inventory management system">Shop Inventory Management System</option>

                                        </select>
                                        <span id="software" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="" class="demo-label-name"> Address *</label>
                                        <textarea placeholder="Address" class="form-control" column="3" name="address" id="address"></textarea>
                                        <span id="addresss" class="text-danger"></span>
                                    </div>
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-danger" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact -->
<section id="contact">
    <div class="container footerdiv">
        <div class="row">
            <div id="about-us" class=" col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 footerbox">
                <h1>Quick Links</h1>
                <ul class="wow fadeInUp animated" data-wow-duration="1.5s">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="team.html">Team</a></li>
                    <li><a href="about_us.html">About Us</a></li>
                    <li><a href="contact_us.html">Contact</a></li>
                    <li><a href="career.html">Career</a></li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 footerbox wow fadeInUp animated" data-wow-duration="1.5s">
                <h1>About Us</h1>
                <p>Our vision is to be the change that the IT industry of Bangladesh is in need of. We want to develop softwares
                    that will affect the life of the mass population of the country. By fully utilizing the possibilities that we
                    have as an emerging nation, we want to be the leader of the IT industry by changing the trends and bringing the
                    products and services that would create an impact in the life of the people both nationally and internationally.</p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 footerbox wow fadeInUp animated" data-wow-duration="1.5s">
                <h1>Contact Us</h1>
                <p>Office: House #51, Road #18, Sector #11</p>
                <p>Uttara, Dhaka-1230</p>
                <p><span style="text-decoration: underline;">Phone </span>: <a href="tel:+09678-771206">+09678-771206</a> </p>
				<p><span style="text-decoration: underline;">Mobile </span>: <a href="tel:+880-1852665521">+880-1852665521</a> </p>
					
				<p><span style="text-decoration: underline;">E-Mail  </span> : <a href="mailto:info@feits.co" target="_top" class="mail_f">info@feits.co</a></p>
                <p>Office Hour: Sun-Thu(9am - 6pm)</p>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 footerbox2">
                <img src="images/feits_logo_white.png">
                <ul class="wow fadeInUp animated" data-wow-duration="1.5s">
                    <li><a href="https://www.facebook.com/Feits.co/"><i class="fab fa-facebook-f"></i>Facebook</a></li>
                    <li><a href="https://twitter.com/FeitsL  "><i class="fab fa-twitter"></i>Twitter</a></li>
                    <li><a href="https://plus.google.com/114231916638194996205"><i class="fab fa-google-plus-g"></i>Google Plus</a></li>
                    <li><a href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.linkedin.com%2Fin%2Ffar-east-it-solutions-ltd-944123142%2F%3Ffbclid%3DIwAR0tR44GELijTagzyj3iXLowU9L0lpcshBd8461IUWW_DMq6ahXB7Ro7t2I&h=AT1AmvWe3U8rmd-iKb1MBNf59dIknj12Uli5m78EJdIy533Gy6f9UpKxzJJjf70ivGp-paohNLT1gV1pr0oyYO5UOwJ_Yzh0y7G1LKSwiDP6fpk8NuzBlN0WXw"><i
                                    class="fab fa-linkedin"></i>Linkedin</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footerline"></div>
    <div class="footercopy  wow fadeInUp animated" data-wow-duration="1.5s">
        <p>© Copyright 2018 Far East IT Solutions Limited- All Rights Reserved</p>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
<script src="js/wow/wow.min.js"></script>
<script src="js/owl-carousel/owl.carousel.min.js"></script>
<script src="js/snake/snake.min.js"></script>
<script src="js/smoothscrolling/jquery.easing.1.3.js"></script>
<script src="js/scrollbar/scrollBar.js"></script>
<script src="js/custom.js"></script>
</body>
</html>