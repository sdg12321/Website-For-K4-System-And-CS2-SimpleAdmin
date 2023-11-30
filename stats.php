<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplay - CS2 Stats</title>
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" >
	<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
	<meta name="description" content="List with the statistics of players on the CS2.TOPLAY.RO server." />


<?php
// Include header.php
include 'header.php';

// Include connection.php for connection details
include 'src/connection.php';
?>
	
<body>
    <h1>List with the statistics of players on the CS2.TOPLAY.RO server.</h1>
	
 <!-- Search form for names -->
	<div class="searchdiv">
    <form method="GET" action="">
        <input type="text" id="search" name="search" placeholder="Enter name...">
        <button type="submit">Search</button>
    </form>
<?php
// Check if a search has been performed
if (isset($_GET['search'])) {
    echo '<a href="' . $_SERVER['PHP_SELF'] . '" class="back-button">Back to All</a>';
}
?>
</div><br>

<?php
// Set the number of records per page
$recordsPerPage = 15;

// Set the number of visible pages in pagination
$visiblePages = 3;

// Current page (default is 1 if not set)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset to retrieve the correct records for the current page
$offset = ($current_page - 1) * $recordsPerPage;

// Query to extract the desired information in descending order of kills
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT name, lastseen, kills, deaths, hits, headshots, grenades, mvp, steam_id, round_win, round_lose FROM k4stats WHERE name LIKE :search ORDER BY kills DESC LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindParam(':limit', $recordsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
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
                <div class="cell">Kills</div>
                <div class="cell">Deaths</div>
                <div class="cell">Hits</div>
                <div class="cell">Headshots</div>                
                <div class="cell">MVP</div>              
            </div>';

 // Calculate the total number of records (not just those on the current page)
        $countQuery = "SELECT COUNT(*) as total FROM k4stats WHERE name LIKE :search";
        $countStmt = $conn->prepare($countQuery);
		$countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $countStmt->execute();
        $totalCount = $countStmt->fetchColumn();

        // Calculate the total number of pages
        $totalPages = ceil($totalCount / $recordsPerPage);

        // Calculate the range of visible pages based on the current page
        $startPage = max(1, $current_page - floor($visiblePages / 2));
        $endPage = min($totalPages, $startPage + $visiblePages - 1);

        // Calculate the order number of the first row on the page
        $startRowNumber = ($current_page - 1) * $recordsPerPage + 1;

    // Iterate through the results and display the information within the HTML template
    $startRowNumber = ($current_page - 1) * $recordsPerPage + 1;
    foreach ($result as $row) {
        echo '<div class="row">
                <div class="cell" data-title="#">' . $startRowNumber . '</div>
                <div class="cell" data-title="Name"><a href="https://steamcommunity.com/profiles/' . $row["steam_id"] . '" target="_blank" rel="noopener">' . $row["name"] . '</a></div>
                <div class="cell" data-title="Kills">' . $row["kills"] . '</div>
                <div class="cell" data-title="Deaths">' . $row["deaths"] . '</div>
                <div class="cell" data-title="Hits">' . $row["hits"] . '</div>
                <div class="cell" data-title="Headshots">' . $row["headshots"] . '</div>               
                <div class="cell" data-title="MVP">' . $row["mvp"] . '</div>               
              </div>';
        $startRowNumber++;
    }

     // Display the ending part of the table
        echo '</div>';

        // Display pagination buttons with improved CSS
      echo '<div class="pagination">';
// Button for the first page
if ($startPage > 1) {
    echo '<a href="?page=1';
    if (!empty($search)) {
        echo '&search=' . $search;
    }
    echo '">1</a>';
    if ($startPage > 2) {
        echo '<span>...</span>';
    }
}

// Display the buttons for each page in the calculated range
for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = ($current_page == $i) ? 'active' : '';
    echo '<a href="?page=' . $i;
    if (!empty($search)) {
        echo '&search=' . $search;
    }
    echo '" class="' . $activeClass . '">' . $i . '</a>';
}

// Button for the last page
if ($endPage < $totalPages) {
    if ($endPage < $totalPages - 1) {
        echo '<span>...</span>';
    }
    echo '<a href="?page=' . $totalPages;
    if (!empty($search)) {
        echo '&search=' . $search;
    }
    echo '">' . $totalPages . '</a>';
}
echo '</div>';

   // Close the wrapper
        echo '</div>';
    } else {
        echo '<div class="errordiv">Nothing was found!' . $stmt->errorInfo()[2] . '</div>';
    }
	
// Close the connection to the database
$conn = null;
?>
</body>
</html>
