<?php
    require("../databaseConnection.php");  
    require("../keys/refreshKeyAdobe.php");
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: ../index.html?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM commInfo 
                 WHERE commId = '".$_GET['commId']."'";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();

    }
 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Commission Sheet</title>
    <script src="../keys/pass.js" type="text/javascript"></script>
    <script>
        
            function confirmDelete(record) {
               // alert("hi"); // for testing
               var deleteRecord = confirm("Are you sure you want to delete " + record + "?");
               if(!deleteRecord){
                   return false
               } else {
                   return true;
               }
            }
        
        </script>
    
    <meta charset = "utf-8"/>

 <style type="text/css">
               /* .tableHeader {
                    text-align:center;
                }*/

              .tableButtons {
                text-align:center;
              }
              .option {
              font-family: "Roboto", sans-serif;
              outline: 0;
              background: "green";
              border: 0;
              box-sizing: border-box;
              font-size: 18px;
              text-align:center;
              background-color:#c68c53
            }
            .tftable {font-size:18px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
            .tftable th {font-size:18px;background-color:#c68c53;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
            .tftable tr {background-color:#d2a679;}
            .tftable td {font-size:18px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
            .tftable tr:hover {background-color:#c68c53;}
    </style>
</head>
    

    <body>
                        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 
        <br/><br/><h2 id="header2">Commission Sheets &#x2713</h2> 

        <form action="addCommSheet.php">  
            <input type="submit" value="Add New Commission Sheet" name="addForm"/>
        </form>  

        <table class="tftable" border="1">
       
      <tr><th>First Name</th><th>Last Name</th><th>Address</th><th>Payment Date</th><th>Settlement Date</th><th>View</th><th>Edit</th><th>Send</th><th>Delete</th></tr>    
            
            <?php
            $dbConn = getConnection();
            $sql = "SELECT * FROM commInfo ";
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['firstName'] . "</td>";
                echo "<td>" . $result['lastName'] . "</td>";
                echo "<td>" . htmlspecialchars($result['address'])." ".$result['city'].", ".$result['state']." ".$result['zip']."</td>";
                echo "<td>" . htmlspecialchars(date("d-m-Y", strtotime($result['date']))) . "</td>";
                echo "<td>" . htmlspecialchars(date("d-m-Y", strtotime($result['settlementDate']))) . "</td>";

             ?>   
             <td>
                <form action="commisionSheet.php">
                   <input type="hidden" name="commId" value="<?=$result['commId']?>" />    
                   <input class="option" type="submit" value="View" name="viewComissionSheet"/>
                </form>   
              </td> 

             <td>
                <form action="editCommInfo.php">
                   <input type="hidden" name="buyerID" value="<?=$result['commId']?>" />    
                   <input class="option" type="submit" value="Edit" name="editForm"/>
                </form>   
              </td> 

              <td>
                 
                   <input class="option" type="submit" value="Send" name="Send" onclick="generate(<?=$result['commId']?>)"/>
               
              </td>

              <td>
                <form onsubmit="return confirmDelete('<?=$result['firstName']?>')">
                   <input type="hidden" name="buyerID" value="<?=$result['buyerID']?>" />    
                   <input class="option" type="submit" value="Delete" name="deleteForm"/>
                </form>    
              </td>
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>
    </body>
    <?php include('../footer.php'); ?>

    <script>
      // function sendComm()
      // {
      //   var xhr = new XMLHttpRequest();
      //   xhr.onreadystatechange = function () 
      //   {
      //      if (this.readyState == 4 && this.status == 200) 
      //      {
      //       var response = JSON.parse(xhr.responseText);
      //       xhr.abort();
      //       getPdf(response.access_token);

      //      }
         
      //   }

      //   xhr.open("POST", "http://api.na2.echosign.com/oauth/refresh?refresh_token=<?php echo $rToken?>&client_id=<?php echo $cId?>&client_secret=<?php echo $cSe?>&grant_type=refresh_token", true);
      //   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      //   xhr.send();

      // }
      
      // function getPdf(token)
      // {
        
      //   var form = document.createElement('form');
      //   form.setAttribute('method', 'post');
      //   form.setAttribute('action','commisionSheet.php');

      //   var tInput = document.createElement('input');
      //   tInput.setAttribute("name", "token");
      //   tInput.setAttribute("value",token);
      //   form.appendChild(tInput);

      //   var send = document.createElement('input');
      //   send.setAttribute("name", "commID");
      //   send.setAttribute("value", commId);
      //   gen.appendChild(send);

      //  document.body.appendChild(form);

      //   form.submit();
      //   //alert("hi");
         
        
      // }
    function generate(commId)
    {
        // var gen = document.createElement('form');
        // gen.setAttribute('method', 'post');
        // gen.setAttribute('action','commisionSheet.php');

        // var send = document.createElement('input');
        // send.setAttribute("name", "id");
        // send.setAttribute("value", commId);
        // gen.appendChild(send);

        // document.body.appendChild(gen);

        // gen.submit();

        var xhr = new XMLHttpRequest();
        var data= "id=" + commId;
        xhr.onreadystatechange = function () 
        {
           if (this.readyState == 4) 
           {
            var response = JSON.stringify(xhr.responseText);
            xhr.abort();
            // console.log(response.substring(5,response.length - 12));
            //var pdf = response.substring(5,response.length - 12);
            //sendDoc(pdf);
            alert("sent");
           }
         
        }

        xhr.open("POST", "commisionSheet.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }
    
    // function generate(commId)
    // {
    //     var xhr = new XMLHttpRequest();
    //     var data= "id=" + commId;
    //     xhr.onreadystatechange = function () 
    //     {
    //        if (this.readyState == 4) 
    //        {
    //         var response = JSON.stringify(xhr.responseText);
    //         xhr.abort();
    //         // console.log(response.substring(5,response.length - 12));
    //         //var pdf = response.substring(5,response.length - 12);
    //         //sendDoc(pdf);
    //         console.log("sent");
    //         console.log(response);
    //        }
         
    //     }

    //     xhr.open("POST", "commisionSheet.php", true);
    //     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //     xhr.send(data);
        
    // }

    // function sendDoc(pdf)
    // {
    //   var xhr = new XMLHttpRequest();

    //   var data = JSON.stringify({
    //       "emailSubject": "DocuSign REST API Quickstart Sample",
    //       "emailBlurb": "Shows how to create and send an envelope from a document.",
    //       "recipients": {
    //         "signers": [{
    //           "email": "jodiaz@csumb.edu",
    //           "name": "Jose Diaz",
    //           "recipientId": "1",
    //           "routingOrder": "1"
    //         }]
    //       },
    //       "documents": [{
    //         "documentId": "1",
    //         "name": "test.pdf",
    //         "documentBase64": pdf
    //       }],
    //       "status": "sent"
    //     });

    //   xhr.onreadystatechange = function () 
    //   {
    //      if (this.readyState == 4) 
    //      {
    //         var response = JSON.stringify(xhr.responseText);
    //         alert(response);
    //      }
       
    //   }
    //   xhr.open("POST", "https://demo.docusign.net/restapi/v2/accounts/2837693/envelopes", true);
    //   xhr.setRequestHeader("x-docusign-authentication", "{ Username:" + username + ",Password:" + password + ",IntegratorKey:" + intKey + " }");
    //   xhr.setRequestHeader("Content-Type", "application/json");
    //   xhr.setRequestHeader("accept", "application/json");
    //   xhr.setRequestHeader("cache-control", "no-cache");
    //   xhr.withCredentials = true;
    //   xhr.send();

    // }

    </script>



</html>