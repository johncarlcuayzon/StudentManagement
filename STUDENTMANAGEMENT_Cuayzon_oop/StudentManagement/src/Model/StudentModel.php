<?php

Namespace Cuayzon\StudentManagement\Model;

Use Cuayzon\StudentManagement\Core\Crud;
Use Cuayzon\StudentManagement\Core\Database;

Class StudentModel extends Database implements Crud
{
    Public $id;
    Public $fullname;
    Public $yearlevel;
    Public $course;
    Public $section;

    Public function __construct()
    {
        Parent::__construct(); // Call Database constructor to set $this->conn

        // Initialize properties
        $this->id = "";
        $this->fullname = "";
        $this->yearlevel = "";
        $this->course = "";
        $this->section = "";
    }

    Public function displayInfo()
    {
        Echo "ID: " . $this->id . "\n";
        Echo "Fullname: " . $this->fullname . "\n";
        Echo "Year Level: " . $this->yearlevel . "\n";
        Echo "Course: " . $this->course . "\n";
        Echo "Section: " . $this->section . "\n";
    }

    Public function create()
    {
        $sql = "INSERT INTO students (id, name, year_level, course, section) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        If (!$stmt) {
            Return "Prepare failed: " . $this->conn->error;
        }

        $stmt->bind_param("sssss", $this->id, $this->fullname, $this->yearlevel, $this->course, $this->section);
        $stmt->execute();

        If ($stmt->affected_rows > 0) {
            Return true;
        } else {
            Return false;
        }
    }

    Public function read()
    {
        $sql = "SELECT * FROM students";
        $result = $this->conn->query($sql);

        If ($result && $result->num_rows > 0) {
            Return $result->fetch_all(MYSQLI_ASSOC);
        }

        Return [];
    }

    Public function update()
    {
        $sql = "UPDATE students SET name = ?, year_level = ?, course = ?, section = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        If (!$stmt) {
            Return "Prepare failed: " . $this->conn->error;
        }

        $stmt->bind_param("sssss", $this->fullname, $this->yearlevel, $this->course, $this->section, $this->id);
        $stmt->execute();

        Return $stmt->affected_rows > 0;
    }

    Public function delete()
    {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        If (!$stmt) {
            Return "Prepare failed: " . $this->conn->error;
        }

        $stmt->bind_param("s", $this->id);
        $stmt->execute();

        Return $stmt->affected_rows > 0;
    }
}
?>
