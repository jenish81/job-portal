<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['step']) && $_POST['step'] == '1') {
        $_SESSION['personal_info'] = [
            'full_name' => $_POST['full_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
        ];
        $_SESSION['message'] = 'Personal information saved!';
        header('Location: portal.php?step=2');
        exit();
    } elseif (isset($_POST['step']) && $_POST['step'] == '2') {
        $_SESSION['education'] = [
            'degree' => $_POST['degree'],
            'field_of_study' => $_POST['field_of_study'],
            'institution' => $_POST['institution'],
            'graduation_year' => $_POST['graduation_year']
        ];
        $_SESSION['message'] = 'Educational information saved!';
        header('Location: portal.php?step=3');
        exit();
    } elseif (isset($_POST['step']) && $_POST['step'] == '3') {
        $_SESSION['work_experience'] = [
            'job_title' => $_POST['job_title'],
            'company' => $_POST['company'],
            'years_experience' => $_POST['years_experience'],
            'responsibilities' => $_POST['responsibilities']
        ];
        $_SESSION['message'] = 'Work experience saved!';
        header('Location: information.php');
        exit();
    }
}

$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Application</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .application-form {
            width: 300px;
        }

        .application-form label,
        .application-form input,
        .application-form textarea,
        .application-form button,
        .application-form a {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .application-form a {
            text-align: center;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="application-form">
        <h2>Job Application</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <p style="color: green;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>

        <?php if ($step == 1): ?>
            <form method="POST" action="portal.php">
                <input type="hidden" name="step" value="1">
                <label>Full Name:</label>
                <input type="text" name="full_name" required>

                <label>Email Address:</label>
                <input type="email" name="email" value="<?php echo isset($_SESSION['personal_info']['email']) ? $_SESSION['personal_info']['email'] : ''; ?>" required>

                <label>Phone Number:</label>
                <input type="tel" name="phone" required>

                <button type="submit">Next</button>
            </form>
        <?php elseif ($step == 2): ?>
            <form method="POST" action="portal.php">
                <input type="hidden" name="step" value="2">
                <label>Highest Degree Obtained:</label>
                <input type="text" name="degree" required>

                <label>Field of Study:</label>
                <input type="text" name="field_of_study" required>

                <label>Name of Institution:</label>
                <input type="text" name="institution" required>

                <label>Year of Graduation:</label>
                <input type="number" name="graduation_year" required>

                <button type="submit">Next</button>
                <a href="portal.php?step=1">Previous</a>
            </form>
        <?php elseif ($step == 3): ?>
            <form method="POST" action="portal.php">
                <input type="hidden" name="step" value="3">
                <label>Previous Job Title:</label>
                <input type="text" name="job_title" required>

                <label>Company Name:</label>
                <input type="text" name="company" required>

                <label>Years of Experience:</label>
                <input type="number" name="years_experience" required>

                <label>Key Responsibilities:</label>
                <textarea name="responsibilities" required></textarea>

                <button type="submit">Next</button>
                <a href="portal.php?step=2">Previous</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>