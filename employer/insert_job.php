<?php  include('session.php');  ?>

<?php


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

    // Simple SQL query
    $sql = "INSERT INTO totaljobs (job_id, salary, openings, posted_on, last_date, company_name, job_title, organisation_type, functional_area, functional_role, job_description, qualification, country, occupation, job_type, gender_preference, ex_servicemen_preferred) 
            VALUES ('$job_id', '$salary', '$openings', '$posted_on', '$last_date', '$company_name', '$job_title', '$organisation_type', '$functional_area', '$functional_role', '$job_description', '$qualification', '$country', '$occupation', '$job_type', '$gender_pref', '$ex_servicemen')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Job posted successfully!'); window.location.href='post_job.php';</script>";
    } else {
        echo "<script>alert('Error posting job: " . $con->error . "');</script>";
    }

    $con->close();
}
?>
