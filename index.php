<?php 
    $servername = "35.184.10.72";
    $username = "root";
    $password = "csci578cool";
    $dbname = "dorys_shells";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        // get info sent
        $userid = $_GET['userid'];

        // if creating subscription
        if($_GET['request'] == 'new')
        {
            $url = $_GET['url'];
            $elementId = $_GET['elementid'];
            $currentValue = $_GET['currentvalue'];
            $elementName = $_GET['elementname'];

            // update db
            $sql = "INSERT INTO subscriptions (userid, url, elementid, currentvalue, elementname, modified) VALUES (" . $userid . ",\"" . $url ."\",\"" . $elementId . "\",\"" . $currentValue . "\",\"" . $elementName . "\",false)";
            if ($conn->query($sql) === TRUE) 
            {
                echo "New record created successfully";
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // requesting update
        else 
        {
            // check db for updates for this user
            $sql = "SELECT * FROM subscriptions";
            $result = $conn->query($sql);
            $data = array();
            $data["modified"] = "false";      

            if ($result->num_rows > 0) 
            {
                $counter = 0;

                while($row = $result->fetch_assoc()) 
                {
                    // check if this row is this user's subscription and if it's modified
                    if($row["userid"] == $userid)
                    {
                        if($row["modified"] == 1)
                        {
                            $data[$counter] = array("url" => $row["url"], "elementid" => $row["elementid"]);
                            $counter++;
                            $data["modified"] = "true";
                        }
                    }
                }
            } 

            // send json back
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }       
?>