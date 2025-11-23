<?php
// Enable CORS for local development
header("Access-Control-Allow-Origin: *");

// Show errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$dbname = "world";
$username = "lab5_user";      // MySQL user
$password = "password123";    // MySQL password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup === 'cities') {
    $sql = "SELECT c.name AS city, c.district, c.population
            FROM cities c
            JOIN countries cs ON c.country_code = cs.code
            WHERE cs.name LIKE '%$country%'";
} else {
    $sql = "SELECT name, continent, indep_year, head_of_state
            FROM countries
            WHERE name LIKE '%$country%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    if ($lookup === 'cities') {
        echo "<tr><th>City</th><th>District</th><th>Population</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['city']}</td><td>{$row['district']}</td><td>{$row['population']}</td></tr>";
        }
    } else {
        echo "<tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['name']}</td><td>{$row['continent']}</td><td>{$row['indep_year']}</td><td>{$row['head_of_state']}</td></tr>";
        }
    }
    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
