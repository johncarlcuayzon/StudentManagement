<?php

include 'vendor/autoload.php';

use Cuayzon\StudentManagement\Core\Database;
use Cuayzon\StudentManagement\Model\StudentModel;


$db = new Database;
$student = new StudentModel;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $student->id = $_POST['id'];
                $student->fullname = $_POST['fullname'];
                $student->yearlevel = $_POST['yearlevel'];
                $student->course = $_POST['course'];
                $student->section = $_POST['section'];
                $student->create();
                break;
            case 'update':
                $student->id = $_POST['id'];
                $student->fullname = $_POST['fullname'];
                $student->yearlevel = $_POST['yearlevel'];
                $student->course = $_POST['course'];
                $student->section = $_POST['section'];
                $student->update();
                break;
            case 'delete':
                $student->id = $_POST['id'];
                $student->delete();
                break;
        }
    }
}


$students = $student->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
</head>
<body>

<h1>Student Management</h1>

<h2>Create Student</h2>
<form method="post">
    <input type="hidden" name="action" value="create">
    ID: <input type="text" name="id"><br>
    Full Name: <input type="text" name="fullname"><br>
    Year Level: <input type="text" name="yearlevel"><br>
    Course: <input type="text" name="course"><br>
    Section: <input type="text" name="section"><br>
    <input type="submit" value="Create">
</form>

<h2>Update Student</h2>
<form method="post">
    <input type="hidden" name="action" value="update">
    ID: <input type="text" name="id"><br>
    Full Name: <input type="text" name="fullname"><br>
    Year Level: <input type="text" name="yearlevel"><br>
    Course: <input type="text" name="course"><br>
    Section: <input type="text" name="section"><br>
    <input type="submit" value="Update">
</form>


<h2>Delete Student</h2>
<form method="post">
    <input type="hidden" name="action" value="delete">
    ID: <input type="text" name="id"><br>
    <input type="submit" value="Delete">
</form>

<h2>Student List</h2>
<?php if ($students): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Year Level</th>
                <th>Course</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $studentData): ?>
                <tr>
                    <td><?php echo $studentData['id']; ?></td>
                    <td><?php echo $studentData['name']; ?></td>
                    <td><?php echo $studentData['year_level']; ?></td>
                    <td><?php echo $studentData['course']; ?></td>
                    <td><?php echo $studentData['section']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No students found.</p>
<?php endif; ?>

</body>
</html>
<?
