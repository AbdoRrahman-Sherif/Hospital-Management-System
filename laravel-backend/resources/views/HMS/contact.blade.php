<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('css/vendor/fontawesome/css/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contact.css') }}">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script >
    function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};
  </script>

<style >
    body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}
  .contact-form {
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
    border-top-right-radius: 10% 50%;
    border-bottom-right-radius: 10% 50%;
}
</style>
</head>
<body>

@extends('HMS.nav')


    <div class="container contact-form" style="font-family: 'IBM Plex Sans', sans-serif;">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            <form method="post" action="contact.php">
                <h3>Drop Us a Message</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" onkeydown="return alphaOnly(event);" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="tel" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" minlength="10" maxlength="10" required />
                        </div>
                        <div class="form-group" >
                            <input type="submit" name="btnSubmit" class="btnContact"   value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" >
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>

</body>
</html>



