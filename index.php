<?php 
    $servername = "35.184.10.72";
    $username = "root";
    $password = "csci578cool";
    $dbname = "dorys_shells";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        // check for any updates for this user
        $userid = $_GET['userid'];
        $sql = "SELECT * FROM subscriptions WHERE userid = \"$userid\"";
        $result = $conn->query($sql);
        $data = array();

        // initially set modified to false - if one of the user's subscriptions is updated it will be set to true
        $data["modified"] = "false";   

        if ($result->num_rows > 0) 
        {
            $counter = 0;
            while($row = $result->fetch_assoc()) 
            {
                // check if this row is this user's subscription and if it's modified
                if($row["modified"] == 1) {
                    $data[$counter] = array("url" => $row["url"], "elementid" => $row["elementid"]);
                    $counter++;
                    $data["modified"] = "true";
                }
            }
            
            // set modified to false for this user's modified subscriptions
            $sql = "UPDATE subscriptions SET modified = 0 WHERE userid = $userid";
            if($conn->query($sql) === TRUE) 
            {
                echo "Record updated successfully";
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }        
        }

        // send json back
        header('Content-Type: application/json');
        echo json_encode($data);  

    } 
    else if($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
       // create subscription
       if($_POST['update'] == "1")
       {
            // update subscription value
            $subscriptionid = $_POST['subscriptionid'];
            $newValue = $_POST['newValue'];
            $sql = "UPDATE subscriptions SET modified = 1, currentvalue = \"$newValue\" WHERE subscriptionid = \"$subscriptionid\"";
            if($conn->query($sql) === TRUE) 
            {
                echo "Record updated successfully";
            }
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
       }
       else
       {
           // create new subscription
            $userid = $_POST['userid'];
            $url = $_POST['url'];
            $elementName = $_POST['elementname'];
            $elementClass = $_POST['elementclass'];
            $elementId = $_POST['elementid'];
            $currentValue = $_POST['currentvalue'];
            $elementName = $_POST['elementname'];
            
            $sql = "INSERT INTO subscriptions (userid, url, elementname, elementclass, elementid, currentvalue, modified) VALUES \"$userid\", \"$url\", \"$elementName\", \"$elementClass\", \"$elementId\", \"$currentValue\", false)";
            if ($conn->query($sql) === TRUE) 
            {
                echo "New record created successfully";
            } 
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>