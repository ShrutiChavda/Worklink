<?php
include('session.php');
include('connection.php');

if (!isset($_GET['id'])) {
    header("Location: update_assessments.php");
    exit;
}

$id = intval($_GET['id']);
$provider_id = $_SESSION['user_id'];
$msg = "";

$assessmentQuery = mysqli_query($con, "SELECT * FROM assessments WHERE id = $id AND provider_id = $provider_id");
$assessment = mysqli_fetch_assoc($assessmentQuery);
if (!$assessment) {
    die("Assessment not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $type = $_POST['type'];
    $timer = isset($_POST['timer']) ? intval($_POST['timer']) : null;
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;

    $questions = [];

    if ($type == 'Text') {
        foreach ($_POST['text_questions'] as $q) {
            $q = trim($q);
            if (!empty($q)) {
                $questions[] = ['q' => $q];
            }
        }
    } else {
        $mcq_qs = $_POST['mcq_questions'];
        for ($i = 0; $i < count($mcq_qs); $i++) {
            $questions[] = [
                'q' => trim($mcq_qs[$i]),
                'options' => [
                    trim($_POST['opt1'][$i]),
                    trim($_POST['opt2'][$i]),
                    trim($_POST['opt3'][$i]),
                    trim($_POST['opt4'][$i])
                ],
                'answer' => intval($_POST['correct'][$i])
            ];
        }
    }

    $questions_json = mysqli_real_escape_string($con, json_encode($questions));

    $update_sql = "UPDATE assessments SET 
        title = '$title',
        type = '$type',
        questions = '$questions_json',
        timer_minutes = " . ($timer !== null ? "'$timer'" : "NULL") . ",
        due_date = " . ($due_date ? "'$due_date'" : "NULL") . "
        WHERE id = $id AND provider_id = $provider_id";

    if (mysqli_query($con, $update_sql)) {
        header("Location: update_assessments.php?success=1");
        exit;
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($con) . "</div>";
    }
}

$questions = json_decode($assessment['questions'], true);

function getCourseName($id, $con) {
    $r = mysqli_fetch_assoc(mysqli_query($con, "SELECT course_name FROM training_programs WHERE id = $id"));
    return $r ? htmlspecialchars($r['course_name']) : '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Assessment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
    .question-block {
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
    }

    @media (max-width: 576px) {

        .form-group label,
        .question-block label {
            font-size: 0.9rem;
        }
    }
    </style>
</head>


<body id="page-top">

    <?php include('sidebar.php'); include('header.php'); ?>

    <div class="container-fluid">
        <h2 class="mb-4 text-primary">Edit Assessment</h2>
        <?= $msg ?>
        <form method="POST" class="card p-4 shadow-sm">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Course:</label>
                    <input type="text" class="form-control" value="<?= getCourseName($assessment['course_id'], $con) ?>"
                        readonly>
                </div>

                <div class="form-group col-md-12">
                    <label>Assessment Title:</label>
                    <input type="text" name="title" class="form-control"
                        value="<?= htmlspecialchars($assessment['title']) ?>" required>
                </div>

                <div class="form-group col-md-12">
                    <label>Question Type:</label>
                    <select name="type" id="typeSelect" class="form-control" required
                        onchange="toggleQuestionType(this.value)">
                        <option value="Text" <?= $assessment['type'] === 'Text' ? 'selected' : '' ?>>Plain Text</option>
                        <option value="MCQ" <?= $assessment['type'] === 'MCQ' ? 'selected' : '' ?>>MCQ</option>
                        <option value="Multichoice" <?= $assessment['type'] === 'Multichoice' ? 'selected' : '' ?>>
                            Multichoice</option>
                    </select>
                </div>
            </div>

            <div id="textQuestions" class="mt-3" style="<?= $assessment['type'] == 'Text' ? '' : 'display:none;' ?>">
                <label>Questions:</label>
                <div id="textContainer">
                    <?php if ($assessment['type'] === 'Text') {
                    foreach ($questions as $q) {
                        echo "<input type='text' name='text_questions[]' class='form-control mb-2' value='" . htmlspecialchars($q['q']) . "' required>";
                    }
                } ?>
                </div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addTextQuestion()">+ Add Text
                    Question</button>
            </div>

            <div id="mcqQuestions" class="mt-3" style="<?= $assessment['type'] !== 'Text' ? '' : 'display:none;' ?>">
                <label>Questions:</label>
                <div id="mcqContainer">
                    <?php if ($assessment['type'] !== 'Text') {
                    foreach ($questions as $q) { ?>
                    <div class="question-block">
                        <label>Question:</label>
                        <input type="text" name="mcq_questions[]" class="form-control mb-2"
                            value="<?= htmlspecialchars($q['q']) ?>" required>
                        <?php foreach ($q['options'] as $i => $opt) { ?>
                        <label>Option <?= $i + 1 ?>:</label>
                        <input type="text" name="opt<?= $i + 1 ?>[]" class="form-control mb-1"
                            value="<?= htmlspecialchars($opt) ?>" required>
                        <?php } ?>
                        <label>Correct Answer (1-4):</label>
                        <input type="number" name="correct[]" class="form-control" min="1" max="4"
                            value="<?= htmlspecialchars($q['answer']) ?>" required>
                    </div>
                    <?php }
                } ?>
                </div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addMCQ()">+ Add MCQ</button>
            </div>

            <div class="row mt-3" id="timerSection"
                style="<?= $assessment['type'] !== 'Text' ? 'display:flex' : 'display:none' ?>">
                <div class="form-group col-md-6 col-sm-12">
                    <label>Assessment Timer (minutes):</label>
                    <input type="number" name="timer" class="form-control"
                        value="<?= htmlspecialchars($assessment['timer_minutes']) ?>">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label>Due Date:</label>
                    <input type="date" name="due_date" class="form-control"
                        value="<?= htmlspecialchars($assessment['due_date']) ?>">
                </div>
            </div>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success">Update Assessment</button>
            </div>
        </form>
    </div>

    <?php include_once('footer.php'); ?>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <script>
    function toggleQuestionType(type) {
        document.getElementById('textQuestions').style.display = (type === 'Text') ? 'block' : 'none';
        document.getElementById('mcqQuestions').style.display = (type !== 'Text') ? 'block' : 'none';
        document.getElementById('timerSection').style.display = (type !== 'Text') ? 'flex' : 'none';
    }

    function addTextQuestion() {
        let container = document.getElementById('textContainer');
        container.insertAdjacentHTML('beforeend',
            `<input type="text" name="text_questions[]" class="form-control mb-2" placeholder="Enter question" required>`
            );
    }

    function addMCQ() {
        let container = document.getElementById('mcqContainer');
        container.insertAdjacentHTML('beforeend', `
        <div class="question-block">
            <label>Question:</label>
            <input type="text" name="mcq_questions[]" class="form-control mb-2" required>
            <label>Option 1:</label><input type="text" name="opt1[]" class="form-control mb-1" required>
            <label>Option 2:</label><input type="text" name="opt2[]" class="form-control mb-1" required>
            <label>Option 3:</label><input type="text" name="opt3[]" class="form-control mb-1" required>
            <label>Option 4:</label><input type="text" name="opt4[]" class="form-control mb-1" required>
            <label>Correct Answer (1-4):</label><input type="number" name="correct[]" class="form-control" min="1" max="4" required>
        </div>`);
    }
    </script>

</body>

</html>