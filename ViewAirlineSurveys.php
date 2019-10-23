<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Jeff Flanegan
    CWB 208
    ViewAirlineSurveys.php
    2019-10-22-->
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

    </head>
    <body>
    <?php
        //connect to database
        $DBName = 'survey';
        $DBConnect = new mysqli('localhost', 'root', "", $DBName);
        if ($DBConnect->connect_error){
            //throw error
            die("Unable to connect to the database
                    server.". $DBConnect->connect_error); 
        }                  
        else{
            //query table                    
            $TableName = "passengers";
            $SQLstring = "SELECT * FROM $TableName";
            //execute query in if statement
            if(($Result = $DBConnect->query($SQLstring)) == FALSE){
                echo "<p>There are no entries in the Airline Survey!</p>";
            }
            //show table to webpage
            else{
                //create row headers
                echo "<p>The following surveys have been filled out:</p>";
                echo "<table width='100%' border='1'>";
                echo "<tr><th>Flight Date</th><th>Flight Time</th><th>Flight Number</th>
                <th>Airline</th><th>Start City</th>
                <th>End City</th><th>Friendliness</th>
                <th>Space</th><th>Comfort</th>
                <th>Cleanliness</th><th>Noise</th></tr>";
                //fetch associative values from each data field per row
                while($Row = $Result->fetch_assoc()){
                    echo "<tr><td><center>{$Row['fDate']}</center></td>
                    <td><center>{$Row['fTime']}</center></td>
                    <td><center>{$Row['fNumber']}</center></td>
                    <td><center>{$Row['airline']}</center></td>
                    <td><center>{$Row['sCity']}</center></td>
                    <td><center>{$Row['eCity']}</center></td>
                    <td><center>{$Row['friend']}</center></td>
                    <td><center>{$Row['space']}</center></td>
                    <td><center>{$Row['comfort']}</center></td>
                    <td><center>{$Row['clean']}</center></td>
                    <td><center>{$Row['noise']}</center></td></tr>";
                }
            }
            //close objects
            $Result->free();                 
            $DBConnect->close();
        }
	?>
    </body>
</html>