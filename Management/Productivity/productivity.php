<?php
session_start();
@include '../database/connect.php'; // Database connection

if(isset($_POST["submit"])) {
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $subject = $_POST['subject'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO productivity (project_id, task_id, subject, date, start_time, end_time, comment) VALUES ('$project_id', '$task_id', '$subject', '$date', '$start_time', '$end_time', '$comment')");
    $stmt->execute();

    header("Location: ../Task/task-list.php");
}

$project_id = $_GET['project_id'];
$task_id = $_GET['task_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<h1>Add Productivity</h1>
    <form method="post">
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" required>
        <br>
        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" required>
        <br>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment"></textarea>
        <br>
        <input type="submit" name="submit" value="Add Productivity">
    </form>
</body>
</html>