<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="adminNav.css">
        <script src="adminNav.js"></script>
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
                    <a class="navbar-brand" href="AdminProfile.php">Administrator</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="AdminProfile.php" class="">Home</a></li>
                        <li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Commission Form<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="viewCommissionSheet.php">View Commission Sheets</a>
                                </li>
                                <li>
                                    <a href="addCommSheet.php">Add New</a>
                                </li>
                            </ul>
                        </li>

                        <li class="active"><a href="viewLoanSheet.php" class="">Loan Sheet</a></li>

                        <li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Agents <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="viewAgents.php">View Agents</a></li>
                                <li><a href="addAgent.php">Add New</a></li>
                            </ul>
                        </li>
                        <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Houses<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="viewHouses.php">View Houses</a></li>
                            </ul>
                        </li>
                        <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="viewCustomers.php">View Clients</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signed in as<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../changePassword.php">Change Password</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

    </body>
</html>

</div>  