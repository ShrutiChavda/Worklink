<?php
include('session.php');
echo $id;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign POST variables
    $jobId = mysqli_real_escape_string($con, $_POST['jobId']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $openings = intval($_POST['openings']);
    $postedOn = mysqli_real_escape_string($con, $_POST['postedOn']);
    $lastDate = mysqli_real_escape_string($con, $_POST['lastDate']);
    $companyName = mysqli_real_escape_string($con, $_POST['companyName']);
    $jobTitle = mysqli_real_escape_string($con, $_POST['jobTitle']);
    $organisationType = mysqli_real_escape_string($con, $_POST['organisationType']);
    $functionalArea = mysqli_real_escape_string($con, $_POST['functionalArea']);
    $functionalRole = mysqli_real_escape_string($con, $_POST['functionalRole']);
    $jobDescription = mysqli_real_escape_string($con, $_POST['jobDescription']);
    $qualification = mysqli_real_escape_string($con, $_POST['qualification']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
    $jobType = mysqli_real_escape_string($con, $_POST['jobType']);
    $genderPref = mysqli_real_escape_string($con, $_POST['genderPref']);
    $exServicemen = mysqli_real_escape_string($con, $_POST['exServicemen']);

    // Get the job record ID (you might want to include a hidden field for this in your form)
    // Assuming 'id' is passed in URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $query = "UPDATE totaljobs SET 
            job_id = '$jobId',
            salary = '$salary',
            openings = '$openings',
            posted_on = '$postedOn',
            last_date = '$lastDate',
            company_name = '$companyName',
            job_title = '$jobTitle',
            organisation_type = '$organisationType',
            functional_area = '$functionalArea',
            functional_role = '$functionalRole',
            job_description = '$jobDescription',
            qualification = '$qualification',
            country = '$country',
            occupation = '$occupation',
            job_type = '$jobType',
            gender_preference = '$genderPref',
            ex_servicemen_preferred = '$exServicemen'
        WHERE id = $id";

        if (mysqli_query($con, $query)) {
            echo "<script>alert('Job updated successfully'); window.location.href = 'manage_jobs.php';</script>";
        } else {
            echo "<script>alert('Error updating job: " . mysqli_error($con) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Invalid request: No job ID provided'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method'); window.history.back();</script>";
}
?>
