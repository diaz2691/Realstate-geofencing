<?php
    function generateTeacherNav(){
        echo "<div id='navigationBar'>";
            
        echo "<nav>";
	        echo "<ul>";
		        echo "<li><a href='teacherMainPage.php'>Home</a></li>";
                echo "<li>";
                    echo "<a href='profileTemplate.php'>Profile<span class='caret'></span></a>";
                    echo "<div>";
				        echo "<ul>";
			                echo "<li><a href='editProfile.php'>Edit</a></li>";
			            echo "</ul>";
			        echo "</div>";
                echo "</li>";
                echo "<li><a href='Calendar2/Cal/index.php'>My Calendar</a></li>";
		        echo "<li>";
      		        echo "<a href='#'>Grades<span class='caret'></span></a>";
			        echo "<div>";
				        echo "<ul>";
				            echo "<li><a href='viewGrades.php'>View</a></li>";
                            echo "<li><a href='enterAssignment.php'>Enter</a></li>";
			            echo "</ul>";
			        echo "</div>";
		        echo "</li>";
		    
		    
            echo "<li><a href='logout.php'>Logout</a></li>";
	    echo "</ul>";
    echo "</nav>";
        
      echo "</div>";
    }

    function generateTeacherCalNav(){
        echo "<div id='navigationBar'>";
            
        echo "<nav>";
	        echo "<ul>";
		        echo "<li><a href='../../teacherMainPage.php'>Home</a></li>";
                echo "<li>";
                    echo "<a href='../../profileTemplate.php'>Profile<span class='caret'></span></a>";
                    echo "<div>";
				        echo "<ul>";
			                echo "<li><a href='../../editProfile.php'>Edit</a></li>";
			            echo "</ul>";
			        echo "</div>";
                echo "</li>";
                echo "<li><a href='Calendar2/Cal/index.php'>My Calendar</a></li>";
		        echo "<li>";
      		        echo "<a href='#'>Grades<span class='caret'></span></a>";
			        echo "<div>";
				        echo "<ul>";
				            echo "<li><a href='../../viewGrades.php'>View</a></li>";
                            echo "<li><a href='../../enterAssignment.php'>Enter</a></li>";
			            echo "</ul>";
			        echo "</div>";
		        echo "</li>";
		    
		    
            echo "<li><a href='../../logout.php'>Logout</a></li>";
	    echo "</ul>";
    echo "</nav>";
        
      echo "</div>";
    }

    function generateParentNav(){
        echo 
        "<div id='navigationBar'>
            
        <nav>
	        <ul>
		        <li><a href='parentHome.php'>Home</a></li>
                <li><a href='Calendar2/Cal/index.php'>Teacher Calendar</a></li>
                <li><a href='parentViewTeacher.php'>Teacher Profile</a></li>
                <li>
      		        <a href='#'>Grades<span class='caret'></span></a>
			        <div>
				        <ul>
				            <li><a href='parentViewGrades.php'>View</a></li>
			            </ul>
			        </div>
		        </li>
            <li><a href='logout.php'>Logout</a></li>
	    </ul>
    </nav>    
      </div>";
    }

    function generateParentCalNav(){
        
        echo 
        "<div id='navigationBar'>
            
        <nav>
	        <ul>
		        <li><a href='../../parentHome.php'>Home</a></li>
                <li><a href='Calendar2/Cal/index.php'>Teacher Calendar</a></li>
                <li><a href='../../profileTemplate.php'>Teacher Profile</a></li>
                <li>
      		        <a href='#'>Grades<span class='caret'></span></a>
			        <div>
				        <ul>
				            <li><a href='../../parentViewGrades.php'>View</a></li>
			            </ul>
			        </div>
		        </li>
            <li><a href='../../logout.php'>Logout</a></li>
	    </ul>
    </nav>    
      </div>";
    }
    
?>