<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application = [
        'personal_info' => $_SESSION['personal_info'],
        'education' => $_SESSION['education'],
        'work_experience' => $_SESSION['work_experience']
    ];

    $applications_file = 'applications.json';
    if (!file_exists($applications_file)) {
        file_put_contents($applications_file, json_encode([]));
    }

    $applications = json_decode(file_get_contents($applications_file), true);
    $applications[] = $application;
    file_put_contents($applications_file, json_encode($applications));

    session_destroy();

    echo "Application submitted successfully!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Review Application</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .review-form {
            width: 400px;
        }

        .review-form h3,
        .review-form p,
        .review-form button,
        .review-form a {
            margin-bottom: 15px;
            display: block;
        }

        .review-form a {
            text-align: center;
            text-decoration: none;
            color: blue;
        }

        button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="review-form">
        <h2>Review Your Application</h2>

        <h3>Personal Information</h3>
        <p><strong>Full Name:</strong> <?php echo $_SESSION['personal_info']['full_name']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['personal_info']['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $_SESSION['personal_info']['phone']; ?></p>

        <h3>Educational Background</h3>
        <p><strong>Degree:</strong> <?php echo $_SESSION['education']['degree']; ?></p>
        <p><strong>Field of Study:</strong> <?php echo $_SESSION['education']['field_of_study']; ?></p>
        <p><strong>Institution:</strong> <?php echo $_SESSION['education']['institution']; ?></p>
        <p><strong>Year of Graduation:</strong> <?php echo $_SESSION['education']['graduation_year']; ?></p>

        <h3>Work Experience</h3>
        <p><strong>Job Title:</strong> <?php echo $_SESSION['work_experience']['job_title']; ?></p>
        <p><strong>Company:</strong> <?php echo $_SESSION['work_experience']['company']; ?></p>
        <p><strong>Years of Experience:</strong> <?php echo $_SESSION['work_experience']['years_experience']; ?></p>
        <p><strong>Responsibilities:</strong> <?php echo $_SESSION['work_experience']['responsibilities']; ?></p>

        <form method="POST" action="information.php">
            <button type="submit">Submit Application</button>
        </form>
        <a href="portal.php?step=3">Back</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
