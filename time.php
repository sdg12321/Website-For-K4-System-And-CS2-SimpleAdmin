<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplay - CS2 Hours Played<</title>
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" >
	<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
	<meta name="description" content="List with the hours played by each player on the CS2.TOPLAY.RO server." />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
// Include header.php
include 'header.php';

// Include connection.php for connection details.
include 'src/connection.php';
?>
	<script>
$(document).ready(function(){
    jQuery(".cell1").click(function() {
		var btn_call_action = jQuery(this);

        var data_steamid = jQuery(this).attr("data-steamid");
		var data_dead = jQuery(this).attr("data-dead");
		var data_alive = jQuery(this).attr("data-alive");
		var data_names = jQuery(this).attr("data-names");
	
	
  Swal.fire({
	icon: "info",  
	html: '<b>Steam Profile:</b> <a href="https://steamcommunity.com/profiles/' + data_steamid + '" target="_blank" rel="noopener">' + data_names + '</a><br><b>Dead:</b> ' + (data_dead ? data_dead : '-') + '<br><b>Alive:</b> ' + (data_alive ? data_alive : '-'),
	confirmButtonText: 'Inchide'
})
    });
});
</script>
<body>

    <h1>List with the hours played by each player on the CS2.TOPLAY.RO server.</h1>
	
 <!-- Search form for names -->
	<div class="searchdiv">
    <form method="GET" action="">
        <input type="text" id="search" name="search" placeholder="Enter Player Name">
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
 $search = isset($_GET['search']) ? $_GET['search'] : '';
	$query = "SELECT name, `all`, ct, t, spec, steam_id, dead, alive FROM k4times WHERE name LIKE :search ORDER BY `all` DESC LIMIT :offset, :limit";
	$stmt = $conn->prepare($query);
	$stmt->bindValue(':limit', $recordsPerPage, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
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
                <div class="cell">Total (approx.)</div>
                <div class="cell">CT</div>
                <div class="cell">Terrorist</div>
                <div class="cell">Spec</div>
            </div>';

// Calculate the total number of records (not just those on the current page)
        $countQuery = "SELECT COUNT(*) as total FROM k4times WHERE name LIKE :search";
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

		
    foreach ($result as $row) {
        echo '<div class="row">
                <div class="cell" data-title="#">' . $startRowNumber . '</div>
                <div class="cell cell1" data-title="Name" data-steamid="' . $row["steam_id"] . '" data-dead="' . secondsToMinutes($row["dead"]) . '" data-alive="' . secondsToMinutes($row["alive"]) . '" data-names="' . $row["name"] . '">' . $row["name"] . '</div>
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
