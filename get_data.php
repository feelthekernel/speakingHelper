<?php
require_once('connect.php');
$classID = $_GET['classid'];
$query = "SELECT name FROM students WHERE classID = ?";
$names = [];
if($stmt = $mysqli->prepare($query))
{
    $stmt->bind_param("s", $classID);
    $stmt->execute();
    $result = $stmt->get_result();
    $index = 0;
    while($row = $result->fetch_assoc())
    {
        $names[$index] = $row['name'];
        $index++;
    }
}
echo json_encode($names);
?>