<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resp.css">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="main-container">
    <div class="inner-container">
        <div class="row" style="margin:0;">
            <div class="col-md-6 left-side">
                <div class="logo">
                    <img src="image/logo.png">
                </div>
                <div class="main-text">
                    <p class="main-heading">Help us know you better</p>
                    <p class="explanation">Sign up and fill a quick questionnaire to help us understand you
    better, so we can provide best possible opportunities to you!</p>
                </div>
            </div>
            <div class="col-md-6 right-side">
                <div class="inner-section">
                    <p class="title">let's begin</p>
                    <div class="input-sections">
                        <input class="user" id="" type="text" name="" placeholder="Username">
                        <input class="user" id="" type="text" name="" placeholder="Email ID">
                        <input class="user" id="" type="text" name="" placeholder="Password">
                        <input class="user" id="" type="text" name="" placeholder="Confirm Password">
                    </div>
                 <div class="radio-section">
                        <div class="first">
                            <p>Marital Status</p>
                            <div class="adjust">
                                <p><input class="red" type="radio" name="gender" value="Married"> 
                                    <label for="Married">Married</label>
                                </p>
                                <p><input type="radio" name="gender" value="Single"> 
                                    <label for="Single">Single</label>
                                </p>
                            </div>
                        </div>
                        <div class="second">
                            <p>Employment Status</p>
                            <div class="adjust">
                                <p><input type="radio" name="gender" value="In a job">
                                    <label for="job">In a job</label>
                                </p>
                                <p><input type="radio" name="gender" value="Self Employed">
                                    <label for="Employed">Self Employed</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="start-button" value="START">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>