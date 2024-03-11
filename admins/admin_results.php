<section class="container mt-5">

    <?php
    $results_details = mysqli_query($conn, "SELECT * FROM results");
    if ($results_details) {
        if (mysqli_num_rows($results_details) > 0) {
    ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class ID</th>
                        <th scope="col">Subject ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Result</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                </tbody>
        <?php
            $row_count = 1;
            while ($results_details_row = mysqli_fetch_assoc($results_details)) {
                echo ("
							<tr>
								<th scope='row'>$row_count</th>
								<td>" . $results_details_row['classid'] . "</td>
								<td>" . $results_details_row['subjectid'] . "</td>
								<td>" . $results_details_row['username'] . "</td>
								<td>" . $results_details_row['result'] . "</td>
								<td>" . $results_details_row['date'] . "</td>
								<td class='actions'>
									<a href='admin_home.php?results&d=" . $results_details_row['quizid'] . "' class=''> 
										<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
										<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
										<path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
										</svg>
								  	</a>
								</td>
							</tr>
						");
                $row_count++;
            }
        } else {
            echo ("<h3 class='text-center text-danger'>No Results Available</h3>");
        }
    } else {
        echo ("ERROR" . mysqli_error($conn));
    }
        ?>
        </tbody>
    </table>
</section>


<?php

if (isset($_GET['results']) && isset($_GET['d'])) {
	$quiz_id = $_GET['d'];
	$result_deleting = mysqli_query($conn, "DELETE FROM results WHERE quizid='$quiz_id'");

	if ($result_deleting) {
		alertMessage('Success', 'Result Deleted Successfully');

		echo ("
        <script>
        setTimeout(() => {
            window.location.href ='./admin_home.php?results';
        }, 2000);
        </script>
        ");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}
mysqli_close($conn);
?>