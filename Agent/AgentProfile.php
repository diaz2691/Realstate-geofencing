<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    $sql = "SELECT firstName, lastName, email, phone, license, agentBio, profilePicture 
            FROM AgentInfo 
            JOIN UsersInfo
            ON AgentInfo.userId = UsersInfo.userId
            WHERE AgentInfo.userId = :userId";
           
    $namedParameters = array();
    $namedParameters[':userId'] = $_POST['userId'];
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
    <!--<link rel="stylesheet" type="text/css" href="profileStyles.css">-->

    <meta charset="UTF-8">
    <title>Agent Profile</title>
        <style type="text/css">
          figure {
            margin: auto;
            padding-top: 100px;

          }
        </style>
    
    
  </head>

  <body>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>
    
        <figure class="snip0057"><center>
          <figcaption>
            <h2><?php echo $firstName ?> <span><?php echo $lastName ?> </span></h2>
            <p>"<?php echo $agentBio ?>"</p>
            <hr>
            <h3> Contact Information </h3>
            <h4> Phone Number - <?php echo $phone ?> </h4>
            <h4> Email - <?php echo $email ?> </h4>
            <h4> License Number - <?php echo $license ?> </h4>
            <a href="#"><i class="ion-ios-email"></i></a>
            <div class="icons"><a href="#"><i class="ion-ios-home"></i></a><a href="#"><i class="ion-ios-email"></i></a><a href="#"><i class="ion-ios-telephone"></i></a></div>
          </figcaption>
          <div class="image"><img src="http://mvptitle.com/blog/wp-content/uploads/2014/01/home_seller.jpg" alt="sample4"/></div>
          <div class="position">Agent</div>
        </figure></center>
  </body>
  <?php include('footer.php'); ?>
</html>
