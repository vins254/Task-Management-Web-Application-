<?php

include"../database/connect.php";
session_start();
if(isset($_POST["submit"])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $project_manager = $_POST['manager_id'];
    $team_members = implode(",", $_POST['members_id']);
    $description = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO `project`(`id`, `name`, `status`, `from_date`, `to_date`, `manager_id`, `members_id`, `description`) 
    VALUES (NULL,'$name','$status','$from_date','$to_date','$project_manager','$team_members','$description')");
    
    if ($stmt->execute()) {
        $_SESSION["submit"] = "Project Added Successfully";
        header("Location:../Projects/project-list.php");
        exit();
    } else {
        echo "Failed: " . $conn->error;
    }

    $stmt->close();
    
}


$project_manager = $conn->query("SELECT *,concat(first_name,' ',last_name) as name FROM users where user_role = 2 order by concat(first_name,' ',last_name) asc");
$team_member = $conn->query("SELECT *,concat(first_name,' ',last_name) as name FROM users where user_role = 3 order by concat(first_name,' ',last_name) asc");
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
    <style><?php include('../CSS/create-project.css'); ?></style>
    <style>
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
        }
    </style>
    </head>
<>
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
                <i class="bx-menu fa fa-align-justify" aria-hidden="true"></i>
                <span class="text">Task Management </span>
            
                <div class="user">
                    <div class="bg-img"style="background-image: url(xx)"></div>
                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    <span><a href="../Login/log-out.php">Logout</a></span>
                </div>
            </div>
            <div class="wrapper">
            <h3>New Project</h3>
        <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

            <div class="input-box">
                <div class="input-field">
                    <label for="" class="name">Project Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-field">
                    <label for="" class="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="0">Pending</option>
						<option value="3">On-Hold</option>
						<option value="5">Done</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="" class="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" autocomplete="off">
                </div>
                <div class="input-field">
                    <label for="" class="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" autocomplete="off">
                </div>

                <div class="input-field">
                    <label for="" class="manager">Project Manager</label>
                    <select name="manager_id" id="manager_id">
                    <option></option>
                        <?php while($row= $project_manager->fetch_assoc()) {  ?>
              	            
              	            
              	       
              	        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              	        <?php } ?> 
                    </select>
                </div>
                <div class="input-field">
                    <label for="members_select" class="team_members">Project Team Members</label>
                    <div class="select-container">
                        <select id="members_select">
                            <option></option>
                            <?php while ($team = $team_member->fetch_assoc()) { ?>
                                <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="selected-members" id="selected_members"></div>
                    </div>
                </div>

                <!---<div class="input-field">
                    <label for="" class="team_members">Project team members</label>
                    <select name="members_id[]" id="members_id">
                     
                    <?php 
                            
              	            
              	            while($team= $team_member->fetch_assoc()) {
              	        ?>
              	        <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
              	        <?php } ?> 
                    </select>
                    <div id="selected_members"></div>
                </div>--->
                <div class="input">
                <div class="input-field">
					<label for="" class="description">Description</label>
					<textarea name="description" id="" cols="50" rows="10" class="form-control">
					</textarea>
				</div>
                <div class="btn">
                    <input type="submit" value="Save" name="submit">
                    <input type="reset" value="Cancel" name="cancel" onclick="location.href='../Projects/project-list.php'">
                </div>
                </div>
                
            </div>
            <input type="hidden" name="members_id[]" id="hidden_members_input">
        </form>
    </div>
    

           

       
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
    const membersSelect = document.getElementById('members_select');
    const selectedMembersDiv = document.getElementById('selected_members');
    const hiddenMembersInput = document.getElementById('hidden_members_input');

    membersSelect.addEventListener('change', () => {
        const selectedOption = membersSelect.options[membersSelect.selectedIndex];
        if (selectedOption.value && !isAlreadySelected(selectedOption.value)) {
            // Create a container div for each selected member
            const memberDiv = document.createElement('div');
            memberDiv.className = 'selected-member';
            memberDiv.setAttribute('data-value', selectedOption.value);

            // Create a span to hold the member name
            const memberName = document.createElement('span');
            memberName.textContent = selectedOption.text;
            memberDiv.appendChild(memberName);

            // Create a remove button
            const removeButton = document.createElement('button');
            removeButton.textContent = 'x';
            removeButton.className = 'remove-member';
            removeButton.addEventListener('click', () => {
                membersSelect.querySelector(`option[value="${selectedOption.value}"]`).disabled = false;
                memberDiv.remove();
                updateHiddenInput();
            });
            memberDiv.appendChild(removeButton);

            // Append the member div to the selected members div
            selectedMembersDiv.appendChild(memberDiv);

            // Disable the option in the select field to prevent duplicate selection
            selectedOption.disabled = true;

            // Add the member to the hidden input
            updateHiddenInput();

            // Clear the select field
            membersSelect.selectedIndex = 0;
        } else {
            // Reset the select field if duplicate or empty selection
            membersSelect.selectedIndex = 0;
        }
    });

    function updateHiddenInput() {
        const selectedValues = Array.from(selectedMembersDiv.querySelectorAll('.selected-member')).map(div => div.getAttribute('data-value'));
        hiddenMembersInput.value = selectedValues.join(',');
    }

    function isAlreadySelected(value) {
        return Array.from(selectedMembersDiv.querySelectorAll('.selected-member')).some(div => div.getAttribute('data-value') === value);
    }
});
</script>

            <!-----<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const membersSelect = document.getElementById('members_id');
    const selectedMembersDiv = document.getElementById('selected_members');

    membersSelect.addEventListener('change', () => {
        // Clear the div first
        selectedMembersDiv.innerHTML = ''; 
        const selectedOptions = Array.from(membersSelect.selectedOptions);

        selectedOptions.forEach(option => {
            // Create a container div for each selected member
            const memberDiv = document.createElement('div');
            memberDiv.className = 'member';
            memberDiv.setAttribute('data-value', option.value);

            // Create a span to hold the member name
            const memberName = document.createElement('span');
            memberName.textContent = option.text;
            memberDiv.appendChild(memberName);

            // Create a remove button
            const removeButton = document.createElement('button');
            removeButton.textContent = 'x';
            removeButton.className = 'remove-member';
            removeButton.addEventListener('click', () => {
                membersSelect.querySelector(`option[value="${option.value}"]`).selected = false;
                memberDiv.remove();
            });
            memberDiv.appendChild(removeButton);

            // Append the member div to the selected members div
            selectedMembersDiv.appendChild(memberDiv);
        });
    });
});
</script>    ----->
        


    <script type="text/javascript" src="../index.js"></script>













</body>
</html>