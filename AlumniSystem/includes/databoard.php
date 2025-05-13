<?php
include 'conn.php';
if($result = $conn -> query("SELECT * FROM studentinfo WHERE sex = 'M'")) {
    $mCount = $result->num_rows;
}

if($result = $conn -> query("SELECT * FROM studentinfo WHERE sex = 'F'")) {
    $fCount = $result->num_rows;
}

if($result = $conn -> query("SELECT * FROM studentinfo")) {
    $ALLCount = $result->num_rows;
}

$progcount = [0,0,0,0,0,0,0,0];
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CITCS'")) {
    $CITCS_count = $result->num_rows;
    $progcount[0] = $CITCS_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CAS'")) {
    $CAS_count = $result->num_rows;
    $progcount[1] = $CAS_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CBA'")) {
    $CBA_count = $result->num_rows;
    $progcount[2] = $CBA_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CCJ'")) {
    $CCJ_count = $result->num_rows;
    $progcount[3] = $CCJ_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'COM'")) {
    $COM_count = $result->num_rows;
    $progcount[4] = $COM_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CTE'")) {
    $CTE_count = $result->num_rows;
    $progcount[5] = $CTE_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'IPPG'")) {
    $IPPG_count = $result->num_rows;
    $progcount[6] = $IPPG_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'ISW'")) {
    $ISW_count = $result->num_rows;
    $progcount[7] = $ISW_count;
}
$conn -> close();

echo json_encode($progcount);
?>