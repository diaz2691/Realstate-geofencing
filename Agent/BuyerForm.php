<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
      header("Location: userLogin.php?error=wrong username or password");
    } 

    $houseId = $_GET['houseId'];
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Sign-Up Form</title>
  <link href="styles.css" rel="stylesheet"/>
  <meta name="description" content="">
  <meta name="author" content="">

  <!--<meta name="viewport" content="width=device-width; initial-scale=1.0">-->

  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  
  <script>     
      
      function displayError(id, message){
        $(id + "Error").html(message);
        $(id).css("background-color","red");
        $(id).focus();
        $(id + "Error").css("color", "red");
      }
      
      function checkPhone(){
          if(!/^\(\d{3}\)\s*\d{3}\-\d{4}$/.test($("#phone").val()))
              {
              displayError("#phone", "Phone must sbe be (XXX)XXX-XXXX format!");
              return false;      
              }
          else
              {
                  $("#phoneError").html("");
                  $("#phone").css("background-color","#66FF66");
              }
      }
      
  </script>
  
</head>

<body>
    <header>
    </header>

    <form method="post" action="addToDatabase.php">
    <table>
        <tr>
            <td colspan="2"><img align="bottom" alt="Interesting Image" border="0" class="simage float_center" height="151" src="https://d1yoaun8syyxxt.cloudfront.net/dh307-4c1ce6ae-ef18-4d63-ae22-952804c98fc4-v2" style="margin-left: 0px; margin-right: 0px;" title="Interesting Image" width="385" />
            </td>
        </tr>
        <tr>
          <td>First Name *</td>  <td><input type="text" name="firstName" /> <br /></td>
        </tr>
        <tr>
          <td>Last Name *</td>   <td><input type="text" name="lastName" /> <br /></td>
        </tr>
        <tr>
          <td>Email *</td>       <td><input type="email" name="email" /> <br /></td>
        </tr>
        <tr>
          <td>Phone</td>       <td><input type = "text" name="phone" id="phone"/> <span id="phoneError"></span></td> <br />
        </tr>
        <tr>
          <td>Bedrooms Range</td>       
                <td>
                    <select name="bedroomsMin">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                    -
                    <select name="bedroomsMax">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                </td>  <br />
        </tr>
        <tr>
          <td>Bathrooms Range</td>       <td><input type = "text" name="bathrooms" /> </td> <br />
        </tr>
        <tr>
          <td>Price Range</td>       <td><input type = "text" name="price" /> </td> <br />
        </tr>
        <input type="hidden" name="houseId" value="<?=$houseId?>"> 

        <tr>
            <td>
                <input type="submit" value="Submit" />
            </td>
        </tr>
    </table>
    </form>
  
  <script>
      $("#phone").change(checkPhone);
      
  </script>

</body>
</html>