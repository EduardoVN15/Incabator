<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>High School Student Profile</title>
    <?php 
	// Database configuration
$host = 'auth-db1536.hstgr.io';
$dbname = 'u237055794_schoolMaps';
$dbUsername = 'u237055794_ghs_schoolMaps';
$dbPassword = 'ZwbHRi^4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';

        // Check if the user is in edit mode
        $isEditMode = isset($_SESSION['edit_mode']) && $_SESSION['edit_mode'] === true;

        // Handle edit mode toggle
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_edit'])) {
            $_SESSION['edit_mode'] = !$isEditMode;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // Save form data
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_data'])) {
            $_SESSION['student_data'] = $_POST['student_data'];
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // Load saved data
        $studentData = isset($_SESSION['student_data']) ? $_SESSION['student_data'] : [];
    ?>
     <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        header, footer {
            width: 100%;
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        input[disabled], textarea[disabled] {
            background-color: #f9f9f9;
            color: #999;
            cursor: not-allowed;
        }
        .edit-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .save-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .save-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>High School Student Profile</h1>

    <form method="POST">
        <button type="submit" name="toggle_edit" class="edit-button">
            <?php echo $isEditMode ? "Disable Edit Mode" : "Enable Edit Mode"; ?>
        </button>

        <?php if ($isEditMode): ?>
            <button type="submit" name="save_data" class="save-button">Save Data</button>
        <?php endif; ?>

        <div class="section">
            <h2>Personal Information</h2>
            <table>
                <tr>
                    <th>Detail</th>
                    <th>Information</th>
                </tr>
                <tr>
                    <td>user Name</td>
                    <td><input type="text" name="student_data[user_name]" value="<?php echo htmlspecialchars($studentData['user_name'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                </tr>
                <tr>
                    <td>Grade Level</td>
                    <td><input type="text" name="student_data[grade_level]" value="<?php echo htmlspecialchars($studentData['grade_level'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                </tr>
                <tr>
                    <td>Student ID</td>
                    <td><input type="text" name="student_data[student_id]" value="<?php echo htmlspecialchars($studentData['student_id'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                </tr>
                <tr>
                    <td>Counselor Name</td>
                    <td><input type="text" name="student_data[counselor_name]" value="<?php echo htmlspecialchars($studentData['counselor_name'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                </tr>
				

            </table>
        </div>

        <div class="section">
            <h2>Daily Schedule</h2>
            <table>
                <tr>
                    <th>Period</th>
                    <th>Course Name</th>
                    <th>Teacher</th>
                    <th>Room</th>
                </tr>
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <tr>
                        <td>Period <?php echo $i; ?></td>
                        <td><input type="text" name="student_data[period_<?php echo $i; ?>_course]" value="<?php echo htmlspecialchars($studentData['period_' . $i . '_course'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                        <td><input type="text" name="student_data[period_<?php echo $i; ?>_teacher]" value="<?php echo htmlspecialchars($studentData['period_' . $i . '_teacher'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                        <td><input type="text" name="student_data[period_<?php echo $i; ?>_room]" value="<?php echo htmlspecialchars($studentData['period_' . $i . '_room'] ?? ''); ?>" <?php echo !$isEditMode ? 'disabled' : ''; ?>></td>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
    </form>
</body>
</html>