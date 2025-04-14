<?php  
include('session.php');  
include('connection.php');

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provider_id = $_SESSION['user_id'];
    $course_id = intval($_POST['course_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $type = $_POST['type'];
    $timer = isset($_POST['timer']) ? intval($_POST['timer']) : null;
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;

    $questions = [];
    if ($type == 'Text') {
        foreach ($_POST['text_questions'] as $q) {
            if (!empty($q)) {
                $questions[] = ['q' => $q];
            }
        }
    } else {
        for ($i = 0; $i < count($_POST['mcq_questions']); $i++) {
            $questions[] = [
                'q' => $_POST['mcq_questions'][$i],
                'options' => [
                    $_POST['opt1'][$i],
                    $_POST['opt2'][$i],
                    $_POST['opt3'][$i],
                    $_POST['opt4'][$i]
                ],
                'answer' => $_POST['correct'][$i]
            ];
        }
    }

    $questions_json = mysqli_real_escape_string($con, json_encode($questions));

    $sql = "INSERT INTO assessments (provider_id, course_id, title, type, questions, timer_minutes, due_date)
            VALUES ('$provider_id', '$course_id', '$title', '$type', '$questions_json', " .
            ($timer ? "'$timer'" : "NULL") . ", " .
            ($due_date ? "'$due_date'" : "NULL") . ")";

    if (mysqli_query($con, $sql)) {
        $msg = "<div class='alert alert-success'>Assessment created successfully.</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Assessments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
    .question-block {
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
    }
    </style>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
    <?php include('sidebar.php'); include('header.php'); ?>

    <div class="container-fluid">
        <h2 class="mb-4">Create Assessment</h2>
        <?= $msg ?>
        <form method="POST" class="card p-4 shadow-sm">
            <div class="form-group">
                <label>Select Course:</label>
                <select name="course_id" class="form-control" required>
                    <option value="">-- Select Course --</option>
                    <?php
                $q = mysqli_query($con, "SELECT id, course_name FROM training_programs");
                while($c = mysqli_fetch_assoc($q)) {
                    echo "<option value='{$c['id']}'>{$c['course_name']}</option>";
                }
                ?>
                </select>
            </div>

            <div class="form-group">
                <label>Assessment Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Question Type:</label>
                <select name="type" id="typeSelect" class="form-control" required
                    onchange="toggleQuestionType(this.value)">
                    <option value="Text">Plain Text</option>
                    <option value="MCQ">MCQ</option>
                    <option value="Multichoice">Multichoice</option>
                </select>
            </div>

            <div id="textQuestions" class="mt-3">
                <label>Questions:</label>
                <div id="textContainer"></div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addTextQuestion()">+ Add Text
                    Question</button>
            </div>

            <div id="mcqQuestions" class="mt-3" style="display:none;">
                <label>Questions:</label>
                <div id="mcqContainer"></div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addMCQ()">+ Add MCQ</button>
            </div>

            <div class="row mt-3" id="timerSection" style="display:none;">
                <div class="form-group col-md-6">
                    <label>Assessment Timer (minutes):</label>
                    <input type="number" name="timer" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Due Date:</label>
                    <input type="date" name="due_date" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create Assessment</button>
        </form>
    </div>
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
        let index = container.children.length;
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


    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>