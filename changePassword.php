
<!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><html>

<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <style type="text/css">
        h1{
            text-align: center;
            font-family: "Roboto", sans-serif;
        }
    </style>
    <title></title>
</head>
<body>
    <div class="login-page">
        <h1> Change Password </h1>
        <div class="form">
            <form action="login.php" method="post" class="login-form">
                <input type="text" name="username" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>
                <input type="submit" value="login" name="loginForm" id="button"/>      
            </form>
    
    <h3 style="color:red">
    <?php
  
      if (isset($_GET['error'])) {
          
          echo $_GET['error'];
          
      }

    ?>
    </h3>



</body>
</html>