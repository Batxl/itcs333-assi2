<?php
// API Endpoint URL
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetching the API data
$response = file_get_contents($url);
if ($response === FALSE) {
    echo "<p>Failed to fetch data from the API.</p>";
    exit;
}

// Decode JSON data
$data = json_decode($response, true);

if (!isset($data['results']) || empty($data['results'])) {
    echo "<p>No data available to display.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1.5.0/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>UOB Student Nationality Data</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['results'] as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record['year'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($record['semester'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($record['the_programs'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($record['nationality'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($record['colleges'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($record['number_of_students'] ?? 'N/A') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
