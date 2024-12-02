<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Create PDO connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if a country is specified in the GET request
if (isset($_GET['country'])) {
    $country = $_GET['country'];

    // SQL query to get countries matching the search
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output countries in a table
    echo "<table>";
    echo "<tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
        echo "<td>" . ($row['independence_year'] ? $row['independence_year'] : 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // If no country specified, return all countries
    $stmt = $conn->query("SELECT * FROM countries");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output countries in a table
    echo "<table>";
    echo "<tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
        echo "<td>" . ($row['independence_year'] ? $row['independence_year'] : 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>