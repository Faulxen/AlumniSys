<?php

include 'conn.php';
$data = json_decode(file_get_contents('php://input'), true);

$filters = array(
    'search' => isset($data['search']) ? $data['search'] : '',
    'departments' => isset($data['departments']) ? $data['departments'] : array(),
    'quickFilters' => isset($data['quickFilters']) ? $data['quickFilters'] : array(),
    'suggestions' => isset($data['suggestions']) ? $data['suggestions'] : array()
);

// Create a search query based on the filters
$query = "SELECT studentinfo.*, studentgrades.genAve FROM studentinfo 
          INNER JOIN studentgrades ON studentinfo.studentID = studentgrades.studentID WHERE 1=1";
$params = array();
$types = '';

if (!empty($filters['search'])) {
    $query .= " AND (studentinfo.fname LIKE ? OR studentinfo.lname LIKE ? OR studentinfo.studentID LIKE ?)";
    $searchTerm = '%' . $filters['search'] . '%';
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= 'sss';
}

if (!empty($filters['departments'])) {
    $query .= " AND studentinfo.department IN (" . implode(',', array_fill(0, count($filters['departments']), '?')) . ")";
    $params = array_merge($params, $filters['departments']);
    $types .= str_repeat('s', count($filters['departments']));
}

if (!empty($filters['quickFilters'])) {
    $query .= " AND studentinfo.yearG IN (" . implode(',', array_fill(0, count($filters['quickFilters']), '?')) . ")";
    $params = array_merge($params, $filters['quickFilters']);
    $types .= str_repeat('s', count($filters['quickFilters']));
}

$stmt = $conn->prepare($query);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$resultsArray = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsArray[] = $row;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($resultsArray);

?>
