<?php
// Database connection variables
$servername = "localhost";
$username = "root";  // Your database username
$password = "";  // Your database password (if any)
$dbname = "school_attendance";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $studentNames = $_POST['studentName'];
    $studentIds = $_POST['studentId'];
    $attendanceStatus = $_POST['attendanceStatus'];
    $date = $_POST['date'];  // Date
    $subject = $_POST['subject'];  // Subject

    // Loop through each student and save their data in the database
    for ($i = 0; $i < count($studentNames); $i++) {
        $name = $studentNames[$i];
        $id = $studentIds[$i];
        $status = $attendanceStatus[$i];

        // Prepare the SQL query to insert data into the database
        $sql = "INSERT INTO attendance (student_name, student_id, attendance_status, date, subject)
                VALUES (?, ?, ?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters (string types: s for strings)
            $stmt->bind_param("sssss", $name, $id, $status, $date, $subject);

            // Execute the query
            if ($stmt->execute()) {
                // Data inserted successfully
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();

    // Display confirmation message
    echo "<p>Attendance has been successfully recorded in the database!</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="attendance-form">
        <h2><u>Student Attendance Form</u></h2>
        <form action="php.php" method="POST">
            <!-- Add Date and Subject Fields -->
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required><br><br>

            <label for="subject">Subject Name:</label>
            <input type="text" name="subject" id="subject" required placeholder="Enter Subject Name"><br><br>

            <!-- Table for multiple students -->
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Student 1 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="John " required></td>
                        <td><input type="text" name="studentId[]" value="S12345" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[0]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[0]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[0]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 2 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Jane " required></td>
                        <td><input type="text" name="studentId[]" value="S12346" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[1]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[1]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[1]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 3 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Michael " required></td>
                        <td><input type="text" name="studentId[]" value="S12347" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[2]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[2]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[2]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 4 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Emily " required></td>
                        <td><input type="text" name="studentId[]" value="S12348" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[3]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[3]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[3]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 5 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="David " required></td>
                        <td><input type="text" name="studentId[]" value="S12349" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[4]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[4]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[4]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 6 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Sophia " required></td>
                        <td><input type="text" name="studentId[]" value="S12350" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[5]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[5]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[5]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 7 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="James " required></td>
                        <td><input type="text" name="studentId[]" value="S12351" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[6]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[6]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[6]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 8 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Harris " required></td>
                        <td><input type="text" name="studentId[]" value="S12352" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[7]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[7]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[7]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 9 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Anderson " required></td>
                        <td><input type="text" name="studentId[]" value="S12353" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[8]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[8]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[8]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Student 10 -->
                    <tr>
                        <td><input type="text" name="studentName[]" value="Liam " required></td>
                        <td><input type="text" name="studentId[]" value="S12354" required></td>
                        <td>
                            <div class="attendance-status">
                                <label><input type="radio" name="attendanceStatus[9]" value="present" required> Present</label>
                                <label><input type="radio" name="attendanceStatus[9]" value="absent" required> Absent</label>
                                <label><input type="radio" name="attendanceStatus[9]" value="late" required> Late</label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Submit Button -->
            <button type="submit">Submit Attendance</button>
        </form>
    </div>

</body>
</html>
