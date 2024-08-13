<?php
                  
    include("../database/connect.php"); 
    $id = $_GET['id']; 
    $stat = ["Pending","Started","On-Progress","On-Hold","Over Due","Done"];
    $stmt = $conn->prepare("SELECT p.*, CONCAT(u.first_name,' ',u.last_name) as manager FROM project p JOIN users u ON p.manager_id = u.id WHERE p.id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
                        
    
    // Fetch selected team members
$members_id = explode(",", $row['members_id']); // Assuming $row['members_id'] is a comma-separated list of member IDs
$members = [];
$stmt_member = $conn->prepare("SELECT *, CONCAT(first_name, ' ', last_name) AS name FROM users WHERE id = ?");
$stmt_member->bind_param("i", $member_id); // Assuming id is an integer

foreach ($members_id as $member_id) {
    $stmt_member->bind_param("i", $member_id);
    $stmt_member->execute();
    $result_member = $stmt_member->get_result();
    if ($member_row = $result_member->fetch_assoc()) {
        $members[] = $member_row['name'];
    }
}
$i = 1;
$task = $conn->query("SELECT * FROM tasks WHERE project_id = $id");

if(isset($_POST["submit"])) {
    $project_id = $_POST['project_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $stat = ["Pending","Started","On-Progress","On-Hold","Over Due","Done"];
    $stmt = $conn->prepare("INSERT INTO tasks (project_id, task, description, status) VALUES ('$project_id', '$name', '$description', '$status')");
    if ($stmt->execute()) {
        $_SESSION["submit"] = "Task Added Successfully";
        // Redirect without any output before header
        header("Location: view.php?id=$project_id");
        exit();
    } else {
        echo "Failed: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    

    <style><?php include('../style.css'); ?></style>
    <style><?php include('../CSS/view-project.css'); ?></style>
</head>
<body>

<div class="sidebar">
        <div class="logo-details">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
            <span class="logo-name">Admin</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../index.php">
                <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="link-name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../index.php">Dashboard</a></li>
                </ul>
            </li>
            
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="link-name">Users</span>
                    </a>
                    <i class="arrow fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">Users</a></li>
                    <li><a href="../users/user.php">Add New</a></li>
                    <li><a href="../users/user-list.php">List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fa fa-database" aria-hidden="true"></i>
                        <span class="link-name">Projects</span>
                    </a>
                    <i class="arrow fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">Projects</a></li>
                    <li><a href="../Projects/create.php">Add New</a></li>
                    <li><a href="../Projects/project-list.php">List</a></li>
                </ul>
            </li>
            <li>
                <a href="../Task/task-list.php">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="link-name">Tasks</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../Task/task-list.php">Tasks</a></li>
                </ul>
            </li>
            <li>
                <a href="../Report/report.php">
                <i class="fa fa-th-list" aria-hidden="true"></i>
                    <span class="link-name">Report</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../Report/report.php">Report</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="home-section">
        
            <div class="home-content">
                <i class="bx-menu">xx</i>
                <span class="text">Task Management </span>
            
                <div class="user">
                    <div class="bg-img"style="background-image: url(xx)"></div>
                    <span>xx</span>
                    <span><a href="../Login/log-out.php">Logout</a></span>
                </div>
            </div>

            <div class="container">
                <header>
                    <h3>View Project</h3>
                    <div class="back">
                         <a href="../Projects/project-list.php">Back</a>
                    </div>
                </header>
                <form action="#">
                    <div class="project-details">

                    
                    <!----$sql = $conn->query("SELECT * FROM project where id = ".$_GET['id'])->fetch_array();
                        foreach($sql as $k => $v){
                            $$k = $v;
                        }
                        
                        $project_manager = $conn->query("SELECT *,concat(first_name,' ',last_name) as name FROM users where id = $manager_id");
                        $project_manager = $project_manager->num_rows > 0 ? $project_manager->fetch_array() : array(); ---->
                    
                    <div class="input">
                        <h3>Project Name</h3>
                        <p><?php echo $row['name']; ?></p>
                    </div>
                
                    <div class="input">
                        <h3>From Date</h3>
                        <p><?php echo date("F d, Y",strtotime($row['from_date'])); ?></p> 

                    </div>
                    <div class="input">
                        <h3>To Date</h3>
                        <p><?php echo date("F d, Y",strtotime($row['to_date'])) ?></p> 
                    </div>
                    <div class="input">
                        <h3>Status</h3>
                        <p>
                        <?php echo $stat[$row['status']]; ?>
                        </p>
                    </div>
                    <div class="input">
                        <h3>Project Manager</h3>
                        <p>
                        
              	        
                        <b><?php echo $row['manager']; ?></b>
                            
                        
              	        
                        </p>
                    </div>
                    <div class="input">
                        <h3>Project Team Member/s</h3>
                        <ul>
                            <?php foreach ($members as $member) : ?>
                                <li>
                                    <?php echo $member; ?>
                            
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <div class="input">
                        <h3>Description</h3>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                
                
                
                    <?php
                    ?>
                    </div>
                </form>
    

                <div class="wrapper">
                    <div class="close-btn">&times;</div>
                        <h3>New Task</h3>
                        <form action="" method="post">
                        <input type="hidden" name="project_id" value="<?php echo $id; ?>" required>
                        
                            <div class="input-box">
                                <div class="input-field">
                                    <label for="" class="name">Task</label>
                                    <input type="text" name="name" id="name" placeholder="Name" required>
                                </div>

                                <div class="input-field">
					                <label for="" class="description">Description</label>
					                <textarea name="description" id="" cols="50" rows="10" class="form-control" placeholder="Task Description">
                                        
					                </textarea>
				                </div>

                                <div class="input-field">
                                    <label for="" class="status">Status</label>
                                    <select name="status" id="status">
                                        <option value="0">Pending</option>
						                <option value="2">On-Progress</option>
						                <option value="5">Done</option>
                                    </select>
                                </div>
                                <div class="btn">
                                    <input type="submit" value="Save" name="submit">
                                    <input type="reset" value="Cancel" name="cancel">
                                </div>
                            </div>
                
                            
                        </form>
                    </div> 
                </div>


    <div class="table table-responsive">
    <div class="table-section">
            <div class="table-header">
            <h3>Task List:</h3>
        
            <button type="button" id="show-task">+Add New Task</button>   
              
                
            </div>
            <table width="100%">
                <colgroup>
						<col width="5%">
						<col width="25%">
						<col width="30%">
						<col width="15%">
						<col width="15%">
				</colgroup>
                <thead>
                    <tr>
                        <th># No</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($tasks = $task->fetch_assoc()) { ?>

                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td> <?php echo $tasks['task']; ?> </td>
                            <td><?php echo $tasks['description']; ?></td>
                            
                            <td>
                            <?php
							 echo $stat[$tasks['status']];
							?>
                            </td>
                            <td>
                                <a href="../Task/view-task.php?id=<?php echo $tasks["id"]; ?>">View</a>
                                <a href="../Task/edit-task.php?id=<?php echo $tasks["id"]; ?>">Edit</a>
                                <a href="../Task/delete-task.php?id=<?php echo $tasks["id"]; ?>">Delete</a>
                            </td>

                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        </div>



    </div>
        
        
        


    <script type="text/javascript" src="../index.js"></script>
    <script type="text/javascript" src="../new_task.js"></script>



    
</body>
</html>