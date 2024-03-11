<header>
	<nav class="navbar navbar-expand-lg m-0 p-0">
		<div class="container-fluid">
			<a class="navbar-brand" href="../index.php">
				<img src="../src/img/logo.png" alt="Friends Tutors Logo" width="200">
			</a>
			<button class="navbar-toggler" style="color: var(--primary-clr);" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon d-flex justify-content-center align-items-center" style="color: var(--primary-clr);">&#9776;</span>
			</button>
			<div class=" collapse navbar-collapse" id="navbarSupportedContent">
				<?php
				if (isset($_SESSION['username'])) {
					echo ("      
                <div class='ms-auto d-flex justify-content-center align-items-center gap-3 me-4'>
                    <span>
						<a href='./user_profile.php'>
							<svg xmlns='http://www.w3.org/2000/svg' width='35' height='35' fill='currentColor' class='bi bi-person-square' viewBox='0 0 16 16'>
								<path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0'/>
								<path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z'/>
							</svg>
						</a>
					</span>
                    <span><strong>" . $_SESSION['username'] . "</strong></span>
                    <a class='btn fw-bold logout-btn' href='user_logout.php'>Logout</a>
                </div>
                ");
				} else {
					echo ("
                <div class='ms-auto d-flex justify-content-center align-items-center gap-3 me-4'>
                <a href='./login.php' class='btn fw-bold login-btn'>Login</a>
                <a href='./signin.php' class='btn fw-bold signin-btn'>Create New Account</a>
                </div>
            ");
				} ?>
			</div>
		</div>
	</nav>

</header>