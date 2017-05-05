
<?php
    //require("../databaseConnection.php");  
    //include 'AgentProfile.php';
    
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    $userId = $_SESSION['userId'];
 ?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="agentNav.css">
    </head>
    <body> 

<div class="navbar-wrapper">
    <div class="container-fluid">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="AgentHome.php">Agent</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="AgentHome.php" class="">Home</a></li>
                        <li class=" dropdown">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="viewMyClients.php">View my clients</a></li>
                                <li><a href="viewAllClients.php">View all clients</a></li>
                            </ul>
                        </li>
                        <li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Houses <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="AgentHome.php">View Houses</a></li>
                                <li><a href="addHouse.php">Add New</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signed in as  <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                <form action="AgentProfile.php" method="post">
                                  <button type="submit" name="userId" value="<?php echo $userId; ?>" class="btn-link">My Profile</button>
                                </form>
                                </li>
                                <li><a href="editAgentProfile.php">Edit Profile</a></li>
                                <li><a href="../changePassword.php">Change Password</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="../logout.php">Logout</a></li>
                        <img src="https://d1yoaun8syyxxt.cloudfront.net/dh307-4c1ce6ae-ef18-4d63-ae22-952804c98fc4-v2" alt="HTML5 Icon" style="width:80px;height:60px;">
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

    </body>
</html>

</div>  