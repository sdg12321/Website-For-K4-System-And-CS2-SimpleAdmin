<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplay - CS2 Hours Played</title>
    <link rel="stylesheet" href="src/style.css">
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" >
	<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
	<meta name="description" content="List with the hours played by each player on the CS2.TOPLAY.RO server." />
</head>

<?php
// Include header.php
include 'header.php';

// Include connection.php for connection details.
include 'src/connection.php';
?>
	
<body>

    <h1>List with the hours played by each player on the CS2.TOPLAY.RO server.</h1>

<?php
function secondsToMinutes($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    if ($minutes > 0 && $seconds > 30) {
        $minutes++; // We round up if we have more than 30 seconds.
    }

    $result = '';

    if ($hours > 0) {
        $result .= $hours . ' h ';
    }

    // Modification here to display zero minutes if there are no minutes.
    $result .= $minutes > 0 ? $minutes . ' min' : '0 min';

    return $result;
}

// Set the number of records per page.
$recordsPerPage = 15;

// Set the number of visible pages in pagination.
$visiblePages = 3;

// Current page (default is 1 if not set)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to retrieve the correct records for the current page
$offset = ($current_page - 1) * $recordsPerPage;

// Query to extract the desired information in descending order of the "all" column
$query = "SELECT name, `all`, ct, t, spec, steam_id, dead, alive FROM k4times ORDER BY `all` DESC LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindParam(':limit', $recordsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the query was successful
if ($result) {
    // Display the beginning part of the wrapper
    echo '<div class="wrapper">';

    // Display the beginning part of the table
    echo '<div class="table">
            <div class="row header">
                <div class="cell">#</div>
                <div class="cell">Name</div>
                <div class="cell">Total (approx.)</div>
                <div class="cell">CT</div>
                <div class="cell">Terrorist</div>
                <div class="cell">Spec</div>
            </div>';

    // Iterate through the results and display the information within the HTML template
    $startRowNumber = ($current_page - 1) * $recordsPerPage + 1;
    foreach ($result as $row) {
        echo '<div class="row">
                <div class="cell" data-title="#">' . $startRowNumber . '</div>
                <div class="cell" data-title="Name"><a href="https://steamcommunity.com/profiles/' . $row["steam_id"] . '" target="_blank" rel="noopener">' . $row["name"] . '</a></div>
                <div class="cell" data-title="Total (aprox.)">' . secondsToMinutes($row["all"]) . '</div>
                <div class="cell" data-title="CT">' . secondsToMinutes($row["ct"]) . '</div>
                <div class="cell" data-title="Terrorist">' . secondsToMinutes($row["t"]) . '</div>
                <div class="cell" data-title="Spec">' . secondsToMinutes($row["spec"]) . '</div>
              </div>';
        $startRowNumber++;
    }

    // Display the ending part of the table
    echo '</div>';

    // Display pagination buttons with improved CSS
    echo '<div class="pagination">';
    // Button for the first page
    $startPage = max(1, $current_page - floor($visiblePages / 2));
    if ($startPage > 1) {
        echo '<a href="?page=1">1</a>';
        if ($startPage > 2) {
            echo '<span>...</span>';
        }
    }

// Calculate the total number of records (not just those on the current page)
$countQuery = "SELECT COUNT(*) as total FROM k4times";
$countStmt = $conn->prepare($countQuery);
$countStmt->execute();
$totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

if ($totalCount) {
    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $recordsPerPage);

    // Calculate the range of visible pages based on the current page
    $endPage = min($totalPages, $startPage + $visiblePages - 1);

    // Display the buttons for each page in the calculated range
    for ($i = $startPage; $i <= $endPage; $i++) {
        $activeClass = ($current_page == $i) ? 'active' : '';
        echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
    }

    // Button for the last page
    if ($endPage < $totalPages) {
        if ($endPage < $totalPages - 1) {
            echo '<span>...</span>';
        }
        echo '<a href="?page=' . $totalPages . '">' . $totalPages . '</a>';
    }
    echo '</div>';

    // Close the wrapper
    echo '</div>';
} else {
    echo "Query error: " . $countStmt->errorInfo()[2];
}

} else {
    echo "Query error: " . $stmt->errorInfo()[2];
}

// Close the connection to the database
$conn = null;
?>
</body>
</html>
