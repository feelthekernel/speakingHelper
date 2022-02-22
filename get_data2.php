<?php
require_once('connect.php');
$classID = $_GET['classid'];
$query = "SELECT sentence FROM sentences WHERE classID = ?";
$sentences = [];
if($stmt = $mysqli->prepare($query))
{
    $stmt->bind_param("s", $classID);
    $stmt->execute();
    $result = $stmt->get_result();
    $index = 0;
    while($row = $result->fetch_assoc())
    {
        $sentences[$index] = $row['sentence'];
        $index++;
    }
}
echo json_encode($sentences);
?>