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

    // Check if 'lookup' parameter is set to 'cities'
    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
        // SQL query to get cities matching the country
        $stmt = $conn->prepare("
            SELECT c.name AS city_name, c.district, c.population
            FROM cities c
            JOIN countries cs ON c.country_code = cs.code
            WHERE cs.name LIKE :country
            ORDER BY c.population DESC
        ");
        $stmt->execute(['country' => "%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any countries match the search
        $countryStmt = $conn->prepare("SELECT COUNT(*) FROM countries WHERE name LIKE :country");
        $countryStmt->execute(['country' => "%$country%"]);
        $countryExists = $countryStmt->fetchColumn() > 0;

        // Output results or appropriate message
        if ($results) {
            echo "<table>";
            echo "<tr><th>City</th><th>District</th><th>Population</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['city_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['district']) . "</td>";
                echo "<td>" . number_format($row['population']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } elseif (!$countryExists) {
            echo "Country not found";
        } else {
            echo "No cities found";
        }
    } else {
        // SQL query to get countries matching the search
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->execute(['country' => "%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output results or appropriate message
        if ($results) {
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
            echo "Country not found";
        }
    }
} else {
    echo "Please enter a country name.";
}
?>