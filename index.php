<?php
    session_start();
    if(isset($_SESSION['id'])){
        return header("Location: profile.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PearTV</title>

    <link rel="stylesheet" href="./includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="./includes/css/main.css">
    <script src="./includes/js/jquery.js" ></script>
    <script src="./includes/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            background-image: url("./includes/img/pear.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>


    <div class="container" style="justify-content: center; align-items: center; display: flex; height: 100vh;">

        <div class="login">

            <form style="color: black;">
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text ">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input required type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" name="rejestruj" id="rejestruj-check">
                  <label class="form-check-label" for="exampleCheck1">register</label>
                </div>

                <div class="toggle-invisible" id="register">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="First name">
                      </div>
      
                      <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname">
                      </div>

                      <div class="form-group">
                        <label for="birth">Date of Birth</label>
                        <input type="date" class="form-control" name="birth" id="birth">
                      </div>


                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

        </div>


    </div>


    <script>
        $("#rejestruj-check").click(()=>{
            $("#register").toggleClass("toggle-invisible");
            if(!$("#name").prop('required')){
                $("#name").prop("required", true);
                $("#surname").prop("required", true);
                $("#bith").prop("required", true);
            }else{
                $("#name").removeProp("required");
                $("#surname").removeProp("required");
                $("#bith").removeProp("required");
            }
        });


        $("form").submit(e => {
            e.preventDefault();
            const data = {
                email: e.target.email.value,
                password: e.target.password.value,
                rejestruj: e.target.rejestruj.checked? "tak": "nie",
                name: e.target.name.value || null,
                surname: e.target.surname.value || null,
                birth: e.target.birth.value || null
            }

            var request = $.ajax({
                type: "POST",
                url: "http://localhost/peartv/server/login.php",
                data: data,
                dataType: "html",
                success : function(responseText)
                  {
                    alert("Zalogowano, za 5 sekund nastąpi przeniesienie na profil.")
                    setTimeout(()=>{ window.location = "http://localhost/peartv/profile.php"; }, 5000);
                  },
                error : function(jqXHR, status, error){
                    if (jqXHR.status === 0) {
                        alert('Not connected.\nPlease verify your network connection.');
                    } else if (jqXHR.status == 404) {
                        alert ('The requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert ('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert ('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert ('Time out error.');
                    } else if (exception === 'abort') {
                        alert ('Ajax request aborted.');
                    } else {
                        alert ('Uncaught Error.\n' + jqXHR.responseText);
                    }
                 }
            });

        });

    </script>


    
</body>
</html>