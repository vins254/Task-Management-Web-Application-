<?php
include"../database/connect.php";

session_start();
if(isset($_POST["edit"])) {
    $id = $_POST["id"];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $project_manager = $_POST['manager_id'];
    
    $team_members = $_POST['members_id'];// No need to implode, as it's already a comma-separated string
   
    $description = $_POST['description'];
    

    $stmt = $conn->prepare("UPDATE project SET name = '$name', status = '$status', from_date = '$from_date', to_date = '$to_date',  manager_id = '$project_manager', members_id = '$team_members', description = '$description' WHERE id = '$id'");

   
    if ($stmt->execute()) {
        
        $_SESSION["edit"] = "Project Updated Successfully";
        header("Location:../Projects/project-list.php");
        exit();
    }
    else {
        echo "Failed: " . $conn->error;
    }
    $stmt->close();
    
}


$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM project where id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

$project_manager = $conn->query("SELECT *, concat(first_name,' ',last_name) as name FROM users where user_role = 2 order by concat(first_name,' ',last_name) asc");
$team_members = $conn->query("SELECT id, concat(first_name,' ',last_name) as name FROM users where user_role = 3 order by concat(first_name,' ',last_name) asc");
$stat = ["Pending", "Started", "On-Progress", "On-Hold", "Over Due", "Done"];




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
    <style><?php include('../CSS/edit-project.css'); ?></style>

    <style>
        /* Your custom styles here */
        .select-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .select-container select {
            width: 100%;
            padding: 5px;
        }
        .selected-members {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }
        .selected-member {
            display: flex;
            align-items: center;
            background: #f0f0f0;
            border-radius: 5px;
            padding: 5px 10px;
        }
        .selected-member span {
            margin-right: 10px;
        }
        .remove-member {
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
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

            <div class="wrapper">
        <header>
            <h3>Edit Details</h3>
            <div class="back">
                <a href="../Projects/project-list.php">Back</a>
            </div>
        </header>

        



            <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $project["id"]; ?>">
            <div class="input-box">
            <div class="input-field">
                    <label for="" class="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $project["name"]; ?>" required>
                </div>
                <div class="input-field">
                    <label for="" class="status">Status:</label>
                    <select name="status" id="status">
                        <?php foreach ($stat as $key => $value) { ?>
						<option value="<?php echo $key; ?>" <?php echo $key == $project['status'] ? "selected": ''; ?>><?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-field">
                    <label for="" class="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" autocomplete="off" value="<?php echo $project["from_date"] ;?>">
                </div>
                <div class="input-field">
                    <label for="" class="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" autocomplete="off" value="<?php echo $project["to_date"] ; ?>">
                </div>

                <div class="input-field">
                    <label for="" class="manager">Project Manager</label>
                    <select name="manager_id" id="manager_id" required>
                    
                        <?php while($row= $project_manager->fetch_assoc()) { ?>
              	           
              	            
              	        
              	        <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $project['manager_id'] ? "selected" : ''; ?>><?php echo ucwords($row['name']) ?></option>
              	        <?php } ?> 
                    </select>
                </div>
                <div class="input-field">
                    <label for="members_select" class="team_members">Project Team Members</label>
                    <div class="select-container">
                        <select id="members_select">
                            <option></option>
                        <?php while($row= $team_members->fetch_assoc()) { ?>
              	            <option value="<?php echo $row['id']; ?>" <?php echo in_array($row['id'], explode(",", $project['members_id'])) ? "selected" : ''; ?>><?php echo $row['name']; ?></option>
              	        <?php } ?> 
                        </select>
                        <div class="selected-members" id="selected_members">
    <?php
    // Display selected members as editable boxes
    if (!empty($project['members_id'])) {
        $selected_members = explode(",", $project['members_id']);
        foreach ($selected_members as $member_id) {
            // Ensure $member_id is numeric before querying the database
            if (is_numeric($member_id)) {
                $member_query = $conn->prepare("SELECT *, CONCAT(first_name, ' ', last_name) AS name FROM users WHERE id = ?");
                $member_query->bind_param("i", $member_id);
                $member_query->execute();
                $member_result = $member_query->get_result();
                $member = $member_result->fetch_assoc();

                if ($member) {
                    echo '<div class="selected-member">
                            <span>' . htmlspecialchars($member['name']) . '</span>
                            <button type="button" class="remove-member" data-id="' . $member_id . '">x</button>
                          </div>';
                }
            }
        }
    }
    ?>
</div>


                    </div>
                </div>
                <input type="hidden" name="members_id" id="hidden_members_input" value="<?php echo $project['members_id']; ?>">
                <!--<div class="input-field">
                    <label for="" class="team_members">Project team members</label>
                    <select multiple name="members_id[]"   id="members_id">
                        
                    <?php while($row= $team_members->fetch_assoc()) { ?>
              	        <option value="<?php echo $row['id']; ?>" <?php echo in_array($row['id'], explode(",", $project['members_id'])) ? "selected" : ''; ?>><?php echo $row['name']; ?></option>
              	        <?php } ?> 
                    </select>
                </div>--->
                <div class="input">
                <div class="input-field">
					<label for="" class="description">Description</label>
					<textarea name="description" id="" cols="50" rows="10" class="form-control">
                    <?php echo $project["description"]; ?>
					</textarea>
				</div>
                <div class="btn">
                    <input type="hidden" name="id" value='<?php echo $project["id"]; ?>'>
                    <input type="submit" value="Edit" name="edit">
                </div>
                </div>
                
                
                
                
                
            </div>
        </form>
    



        
        
        
        
        
        <?php
        
        ?>
</div>


            
        

       
    </div>
     <script>  
    document.addEventListener('DOMContentLoaded', function() {
    const membersSelect = document.getElementById('members_select');
    const selectedMembersDiv = document.getElementById('selected_members');
    const hiddenMembersInput = document.getElementById('hidden_members_input');

    membersSelect.addEventListener('change', function() {
        const selectedOption = membersSelect.options[membersSelect.selectedIndex];
        if (selectedOption.value && !isAlreadySelected(selectedOption.value)) {
            const memberDiv = document.createElement('div');
            memberDiv.className = 'selected-member';
            memberDiv.innerHTML = '<span>' + selectedOption.text + '</span>' +
                                  '<button type="button" class="remove-member" data-id="' + selectedOption.value + '">x</button>';
            selectedMembersDiv.appendChild(memberDiv);

            // Disable the selected option
            selectedOption.disabled = true;
            updateHiddenInput();
            
            // Clear the select field
            membersSelect.selectedIndex = 0;
        } else {
            membersSelect.selectedIndex = 0;
        }
    });

    selectedMembersDiv.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-member')) {
            const memberId = event.target.getAttribute('data-id');
            const selectedOption = membersSelect.querySelector('option[value="' + memberId + '"]');
            if (selectedOption) {
                selectedOption.disabled = false;
            }
            event.target.parentNode.remove();
            updateHiddenInput();
        }
    });

    function isAlreadySelected(value) {
        return Array.from(selectedMembersDiv.querySelectorAll('.selected-member')).some(div => div.querySelector('button').getAttribute('data-id') === value);
    }

    function updateHiddenInput() {
        const selectedValues = Array.from(selectedMembersDiv.querySelectorAll('.selected-member')).map(div => div.querySelector('button').getAttribute('data-id'));
        hiddenMembersInput.value = selectedValues.join(',');
    }
});
</script> 


    <script type="text/javascript" src="../index.js"></script>







        
        
   
</body>
</html>