<?php
  include('session.php'); 

    $id = $_REQUEST['id'];

    $q="delete from totaljobs where id=$id";
    if (mysqli_query($con, $q)) {
        echo "<script>
            alert('Job deleted successfully');
            window.location.href = 'manage_jobs.php';
        </script>";
    } else {
        echo "<script>
            alert('Error deleting job');
            window.location.href = 'manage_jobs.php';
        </script>";
    }
?>