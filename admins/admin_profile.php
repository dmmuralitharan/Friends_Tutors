    <section class="container d-flex flex-column align-items-center mt-5">

    	<table class="table w-50 text-center">
    		<?php
			$username = $_SESSION['adminusername'];
			$admin_details = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");
			if ($admin_details) {
				$admin_details_row = mysqli_fetch_assoc($admin_details);
				$userid =  $admin_details_row['userid'];
				echo ("
    		<thead>
    			<div class='d-flex mb-3 ms-auto'>
    				<a href='admin_home.php?profile&e=' class='btn btn-primary-clr  ms-auto' data-bs-toggle='modal' data-bs-adminid='" . $userid . "' data-bs-adminusername='" . $admin_details_row['username'] . "' data-bs-adminemail='" . $admin_details_row['email'] . "' data-bs-adminpassword='" . $admin_details_row['password'] . "' data-bs-target='#editAdmin'>
    					Edit
    				</a>
    			</div>
    		</thead>
    		<tbody>
				<tr>
				<th>User ID</th>
				<td>" . $userid . "</td>
				</tr>
				<tr>
				<th>Username</th>
				<td>" . $admin_details_row['username'] . "</td>
				</tr>
				<tr>
				<th>E-mail</th>
				<td>" . $admin_details_row['email'] . "</td>
				</tr>
				<tr>
					<th>Password</th>
					<td>" . $admin_details_row['password'] . "</td>
				</tr>
			");
			} else {
				echo ("ERROR" . mysqli_error($conn));
			}
			?>
    		</tbody>
    	</table>
    </section>

    <div class="modal fade" id="editAdmin">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="addClassLabel">Edit Admin User</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    			</div>
    			<div class="modal-body">
    				<form action="" method="post">
    					<div class="form-floating mb-3">
    						<input type="text" class="form-control" id="adminuserid" name="adminuserid" placeholder="Admin ID" value="">
    						<label for="userid">Admin ID</label>
    					</div>
    					<div class="form-floating mb-3">
    						<input type="text" class="form-control" id="adminusername" name="adminusername" placeholder="Admin Name">
    						<label for="username">Admin Name</label>
    					</div>
    					<div class="form-floating mb-3">
    						<input type="text" class="form-control" id="adminemail" name="adminemail" placeholder="Admin E-mail">
    						<label for="email">E-mail</label>
    					</div>
    					<div class="form-floating">
    						<input type="password" class="form-control" id="adminpassword" name="adminpassword" placeholder="Admin Password">
    						<label for="password">Password</label>
    					</div>
    					<div class="modal-footer">
    						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    						<button type="submit" name="update-admin-submit" class="btn btn-primary-clr">Update Admin</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>

    <script>
    	let editAdmin = document.getElementById('editAdmin')
    	editAdmin.addEventListener('show.bs.modal', function(event) {
    		let button = event.relatedTarget
    		let adminId = button.getAttribute('data-bs-adminid')
    		window.history.pushState({}, "", `admin_home.php?profile&e=${adminId}`);
    		let adminUsername = button.getAttribute('data-bs-adminusername')
    		let adminEmail = button.getAttribute('data-bs-adminemail')
    		let adminPassword= button.getAttribute('data-bs-adminpassword')

			let adminIdInput = editAdmin.querySelector('#adminuserid')
    		let adminUsernameInput = editAdmin.querySelector('#adminusername')
    		let adminEmailInput = editAdmin.querySelector('#adminemail')
    		let adminPasswordInput = editAdmin.querySelector('#adminpassword')
			
    		adminIdInput.value = adminId
    		adminUsernameInput.value = adminUsername
    		adminEmailInput.value = adminEmail
    		adminPasswordInput.value = adminPassword
    	})
    </script>

	<?php


if (isset($_POST['update-admin-submit'])) {

    $old_admin_userid = $_GET['e'];
    $new_admin_userid = $_POST['adminuserid'];
    $new_admin_username = $_POST['adminusername'];
    $new_admin_email = $_POST['adminemail'];
    $new_admin_password = $_POST['adminpassword'];

    $update_admin = mysqli_query($conn, "UPDATE admins SET userid='$new_admin_userid',username='$new_admin_username',email='$new_admin_email',password='$new_admin_password' WHERE userid='$old_admin_userid'");
    if ($update_admin) {
		$_SESSION["adminusername"] = $new_admin_username;
        alertMessage('Success', 'Admin Updated Successfully');
        echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?admin';
                }, 2000);
                </script>
                ");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>