<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    $sql = "SELECT userId, firstName, lastName, email, phone, license, agentBio, profilePicture FROM AgentInfo JOIN UsersInfo
            WHERE userId = :userId";
           
    $namedParameters = array();
    $namedParameters[':userId'] = $_SESSION['userId'];
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute($namedParameters);
    $results = $stmt->fetchAll();

    foreach($results as $result){
        $agentBio = $result['agentBio'];
        $profilePicture = $result['profilePicture'];
        $firstName = $result['firstName'];
        $lastName = $result['lastName'];
        $email = $result['email'];
        $phone = $result['phone'];
        $license = $result['license'];
    } 
 ?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Agent Profile</title>
    
    
    
    
        <link rel="stylesheet" href="profileStyles.css">
        <style type="text/css">
          figure {
            padding-top: 100px;

          }
        </style>
    
    
  </head>

  <body>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>
    
        <figure class="snip0057 red">
          <figcaption>
            <h2><?php echo $firstName ?> <span><?php echo $lastName ?> </span></h2>
            <p><?php echo $agentBio ?></p>
            <hr>
            <center><h3> Contact Information </h3></center>
            <a href="#"><i class="ion-ios-email"></i></a>
            <div class="icons"><a href="#"><i class="ion-ios-home"></i></a><a href="#"><i class="ion-ios-email"></i></a><a href="#"><i class="ion-ios-telephone"></i></a></div>
          </figcaption>
          <div class="image"><img src="http://mvptitle.com/blog/wp-content/uploads/2014/01/home_seller.jpg" alt="sample4"/></div>
          <div class="position">Agent</div>
        </figure>
        <!--
        <figure class="snip0057 blue">
          <figcaption>
            <h2>Tiffany <span>Case</span></h2>
            <p>That's the whole problem with science. You've got a bunch of empiricists trying to describe things of unimaginable wonder.</p>
            <div class="icons"><a href="#"><i class="ion-ios-home"></i></a><a href="#"><i class="ion-ios-email"></i></a><a href="#"><i class="ion-ios-telephone"></i></a></div>
          </figcaption>
          <div class="image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sq-sample3.jpg" alt="sample3"/></div>
          <div class="position">Software Engineer</div>
        </figure>
        -->
    
    
    
    
    
  </body>
</html>
