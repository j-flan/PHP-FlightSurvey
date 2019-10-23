<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Jeff Flanegan
    CWB 208
    EnterAirlineSurveyData.php
    2019-10-22-->
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
    </head>
    <body>      
    <?php
    //You should not let an outside souce have the ability to create a database or table.
    //You can easily create the database and table with these commands within the mysql server.
    /*CREATE DATABASE survey;
    CREATE TABLE passengers (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    fDate DATE, fTime TIME, fNumber INT, airline VARCHAR(50), sCity VARCHAR(50), eCity VARCHAR(50), 
    friend VARCHAR(10), space VARCHAR(10), comfort VARCHAR(10), clean VARCHAR(10), noise VARCHAR(10));*/
    
        //connect to database
        $DBName = "survey";
        $DBConnect = new mysqli("localhost", "root", "", $DBName);
        //throw error
        if ($DBConnect->connect_error){
            die("Unable to connect to the database
                    server.". $DBConnect->connect_error);
        }
        //Get values from fields
        else{
            $table = "passengers"; 
            $fDate = ($_POST['date']);
            $fTime = ($_POST['time']);
            $fNumber = stripslashes($_POST['number']);
            $airline = stripslashes($_POST['airline']);
            $sCity = stripslashes($_POST['sCity']);
            $eCity = stripslashes($_POST['eCity']);
            //make sure all radio buttons have been entered
            if (!isset($_POST['friend']) || !isset($_POST['space']) || !isset($_POST['comfort']) || !isset($_POST['clean']) || !isset($_POST['noise'])) {
                    echo "<p>You must rate all fields. Please return to the previous page and complete the form</p>";
            }
            else{
                $friend = ($_POST['friend']);
                $space = ($_POST['space']);
                $comfort = ($_POST['comfort']);
                $clean = ($_POST['clean']);
                $noise = ($_POST['noise']);
                //Insert form values to database
                $SQLstring = "INSERT INTO $table
                VALUES (NULL, '$fDate', '$fTime', '$fNumber', '$airline', '$sCity', '$eCity', '$friend', '$space', '$comfort', '$clean', '$noise')";
                //execute query within if statement              
                if ($DBConnect->query($SQLstring) === FALSE)
                    //throw error
                    echo "<p>Unable to execute the query.<br>Error:". $SQLstring
                        . ": " . $DBConnect->error . "</p>";
                else
                    echo "Thank you for filling out our survey!!";
            }
            //close object
            $DBConnect->close();
        }                          
	?>
    </body>
</html>