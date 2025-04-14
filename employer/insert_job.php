<?php include('session.php'); ?>
<?php include('connection.php'); ?>

<?php
//echo $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $job_id = $_POST['jobId'];
    $salary = $_POST['salary'];
    $openings = $_POST['openings'];
    $posted_on = $_POST['postedOn'];
    $last_date = $_POST['lastDate'];
    $company_name = $_POST['companyName'];
    $job_title = $_POST['jobTitle'];
    $organisation_type = $_POST['organisationType'];
    $functional_area = $_POST['functionalArea'];
    $functional_role = $_POST['functionalRole'];
    $job_description = $_POST['jobDescription'];
    $qualification = $_POST['qualification'];
    $country = $_POST['country'];
    $occupation = $_POST['occupation'];
    $job_type = $_POST['jobType'];
    $gender_pref = $_POST['genderPref'];
    $ex_servicemen = $_POST['exServicemen'];
    $category = $_POST['category'];

    // Get session user_id
    $user_id = $_SESSION['user_id'];

    // Get employer_id from employers table
    $employer_id = '';
    $added_by = '';

    $query_emp = "SELECT id FROM employers WHERE user_id = '$user_id'";
    $result_emp = mysqli_query($con, $query_emp);

    if ($result_emp && mysqli_num_rows($result_emp) > 0) {
        $row_emp = mysqli_fetch_assoc($result_emp);
        $employer_id = $row_emp['id'];
    }

    // Get name from users table
    $query_user = "SELECT full_name FROM users WHERE id = '$user_id'";
    $result_user = mysqli_query($con, $query_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $row_user = mysqli_fetch_assoc($result_user);
        $added_by = $row_user['full_name'];
    }

    // Insert into totaljobs with employee_id and added_by
    $sql = "INSERT INTO totaljobs (job_id, salary, openings, posted_on, last_date, company_name, job_title, organisation_type, functional_area, functional_role, job_description, qualification, country, occupation, job_type, gender_preference, ex_servicemen_preferred, category, employee_id, added_by) 
            VALUES ('$job_id', '$salary', '$openings', '$posted_on', '$last_date', '$company_name', '$job_title', '$organisation_type', '$functional_area', '$functional_role', '$job_description', '$qualification', '$country', '$occupation', '$job_type', '$gender_pref', '$ex_servicemen', '$category', '$employer_id', '$added_by')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Job posted successfully!'); window.location.href='post_job.php';</script>";
    } else {
        echo "<script>alert('Error posting job: " . $con->error . "');</script>";
    }

    $con->close();
}
?>
