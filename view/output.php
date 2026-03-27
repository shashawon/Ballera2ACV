<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname   = htmlspecialchars($_POST['firstname']   ?? '');
    $lastname    = htmlspecialchars($_POST['lastname']    ?? '');
    $birthdate   = htmlspecialchars($_POST['birthdate']   ?? '');
    $gender      = htmlspecialchars($_POST['gender']      ?? '');
    $nationality = htmlspecialchars($_POST['nationality'] ?? '');
    $address     = htmlspecialchars($_POST['address']     ?? '');
    $email       = htmlspecialchars($_POST['email']       ?? '');
    $phone       = htmlspecialchars($_POST['phone']       ?? '');
    $github      = htmlspecialchars($_POST['github']      ?? '');
    $linkedin    = htmlspecialchars($_POST['linkedin']    ?? '');
    $summary     = htmlspecialchars($_POST['summary']     ?? '');
    $education   = htmlspecialchars($_POST['education']   ?? '');
    $skills      = htmlspecialchars($_POST['skills']      ?? '');
    $experience  = htmlspecialchars($_POST['experience']  ?? '');

    $age = '';
    if (!empty($birthdate)) {
        $dob = new DateTime($birthdate);
        $now = new DateTime();
        $age = $dob->diff($now)->y;
    }

    $skillsList = array_filter(array_map('trim', explode(',', $skills)));

    $photoPath = '';
    if (!empty($_FILES['profile']['name'])) {
        $allowed   = ['jpg', 'jpeg', 'png', 'gif'];
        $filename  = $_FILES['profile']['name'];
        $tempfile  = $_FILES['profile']['tmp_name'];
        $ext       = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $newName   = 'profile_' . time() . '.' . $ext;
            $folder    = "../assets/uploads/";
            $photoPath = "../assets/uploads/" . $newName;

            if (!is_dir($folder)) mkdir($folder, 0777, true);
            move_uploaded_file($tempfile, $folder . $newName);
        }
    }

} else {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $firstname . ' ' . $lastname ?> — CV</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #eb6d6dab;
            --paper: #ffffff;
            --dark: #861515;
            --accent: #b8860b;
            --accent2: #d4a017;
            --muted: #521515;
            --border: #222222;
            --tag-bg: #f5f5f5;
            --red: #972626;
        }

        body {
            background: #f0f0f0;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;
            color: var(--dark);
        }

        .cv-wrap {
            max-width: 860px;
            margin: 0 auto;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--dark);
            font-size: 13px;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
            border: 2px solid var(--dark);
            padding: 6px 14px;
        }
        .back-btn:hover {
            background: var(--dark);
            color: #ffffff;
        }
        .back-btn::before { content: '←'; font-size: 15px; }

        .cv {
            background: var(--paper);
            border: 3px solid var(--dark);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 6px 6px 0px var(--dark);
        }

        .cv-hero {
            background: var(--dark);
            padding: 40px 44px;
            display: flex;
            gap: 30px;
            align-items: flex-start;
            border-bottom: 4px solid var(--accent2);
        }

        .cv-photo {
            width: 110px;
            height: 110px;
            border-radius: 0;
            object-fit: cover;
            border: 3px solid var(--accent2);
            flex-shrink: 0;
        }

        .cv-photo-placeholder {
            width: 110px;
            height: 110px;
            border-radius: 0;
            background: #222222;
            border: 2px dashed var(--accent2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            flex-shrink: 0;
        }

        .cv-hero-info {
            padding-top: 4px;
        }

        .cv-hero-info .name {
            font-family: 'Times New Roman', Times, serif;
            font-size: clamp(1.7rem, 4vw, 2.6rem);
            color: #ffffff;
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .cv-hero-info .name em {
            color: var(--accent2);
            font-style: normal;
        }

        .cv-hero-info .meta {
            color: #ffffff;
            font-size: 12px;
            font-weight: normal;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
        }

        .contact-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pill {
            background: #8529299b;
            border: 1px solid #fdfdfd;
            border-radius: 0;
            padding: 4px 12px;
            font-size: 12px;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pill span { opacity: 0.5; font-size: 11px; }

        .cv-body {
            display: grid;
            grid-template-columns: 1fr 300px;
        }

        .cv-main {
            padding: 36px 40px;
            border-right: 2px solid var(--dark);
        }

        .cv-side {
            padding: 36px 28px;
            background: #f5f5f5;
            min-width: 0;
            word-break: break-all;
            overflow-wrap: break-word;
        }

        .section { margin-bottom: 32px; }
        .section:last-child { margin-bottom: 0; }

        .section-title {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #ffffff;
            background: var(--red);
            font-weight: bold;
            margin-bottom: 14px;
            padding: 4px 10px;
            display: inline-block;
            font-family: Arial, sans-serif;
        }

        .summary-text {
            font-size: 0.9rem;
            line-height: 1.75;
            color: var(--muted);
        }

        .exp-block {
            border-left: 3px solid var(--accent2);
            padding-left: 16px;
            position: relative;
        }

        .exp-block::before {
            content: '';
            width: 9px; height: 9px;
            background: var(--red);
            position: absolute;
            left: -6px; top: 5px;
        }

        .exp-text {
            font-size: 0.88rem;
            line-height: 1.7;
            color: var(--muted);
            white-space: pre-line;
        }

        .skills-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .skill-tag {
            background: var(--tag-bg);
            border: 1.5px solid var(--accent);
            border-radius: 0;
            padding: 4px 11px;
            font-size: 12px;
            font-weight: bold;
            color: var(--accent);
            font-family: Arial, sans-serif;
        }

        .info-item {
            margin-bottom: 16px;
            border-bottom: 1px solid #dddddd;
            padding-bottom: 14px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item .label {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--red);
            font-weight: bold;
            margin-bottom: 4px;
            font-family: Arial, sans-serif;
        }

        .info-item .value {
            font-size: 0.87rem;
            color: var(--dark);
            line-height: 1.5;
        }

        .info-item .value a {
            color: var(--accent);
            text-decoration: underline;
            word-break: break-all;
        }

        .actions {
            text-align: center;
            margin-top: 24px;
        }

        .print-btn {
            background: var(--red);
            color: #ffffff;
            border: 2px solid var(--dark);
            border-radius: 0;
            padding: 12px 38px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .print-btn:hover {
            background: var(--dark);
            color: var(--accent2);
        }

        .print-btn:active {
            background: var(--accent);
            color: var(--dark);
        }

        @media print {
            body { background: white; padding: 0; }
            .back-btn, .actions { display: none; }
            .cv { box-shadow: none; border: none; }
        }

        @media (max-width: 640px) {
            .cv-body { grid-template-columns: 1fr; }
            .cv-main { border-right: none; border-bottom: 2px solid var(--dark); padding: 24px 20px; }
            .cv-side { padding: 24px 20px; }
            .cv-hero { flex-direction: column; padding: 28px 20px; gap: 18px; }
        }
    </style>
</head>
<body>

<div class="cv-wrap">

    <a href="../index.php" class="back-btn">Back to Form</a>

    <div class="cv">

        <div class="cv-hero">
            <?php if ($photoPath): ?>
                <img src="<?= $photoPath ?>" alt="Profile Photo" class="cv-photo">
            <?php else: ?>
                <div class="cv-photo-placeholder">👤</div>
            <?php endif; ?>

            <div class="cv-hero-info">
                <h1 class="name">
                    <?= $firstname ?> <em><?= $lastname ?></em>
                </h1>
                <p class="meta">
                    <?= $age ? $age . ' years old' : '' ?>
                    <?= ($age && $gender) ? ' · ' : '' ?>
                    <?= $gender ?>
                    <?= ($nationality) ? ' · ' . $nationality : '' ?>
                </p>
                <div class="contact-pills">
                    <?php if ($email): ?>
                        <div class="pill"><span>✉</span> <?= $email ?></div>
                    <?php endif; ?>
                    <?php if ($phone): ?>
                        <div class="pill"><span>☎</span> <?= $phone ?></div>
                    <?php endif; ?>
                    <?php if ($address): ?>
                        <div class="pill"><span>📍</span> <?= $address ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="cv-body">

            <!-- Main Column -->
            <div class="cv-main">

                <?php if ($summary): ?>
                <div class="section">
                    <h2 class="section-title">About Me</h2>
                    <p class="summary-text"><?= nl2br($summary) ?></p>
                </div>
                <?php endif; ?>

                <?php if ($experience): ?>
                <div class="section">
                    <h2 class="section-title">Experience & Projects</h2>
                    <div class="exp-block">
                        <p class="exp-text"><?= nl2br($experience) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($education): ?>
                <div class="section">
                    <h2 class="section-title">Education</h2>
                    <div class="exp-block">
                        <p class="exp-text"><?= nl2br($education) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($skillsList)): ?>
                <div class="section">
                    <h2 class="section-title">Skills</h2>
                    <div class="skills-tags">
                        <?php foreach ($skillsList as $skill): ?>
                            <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <div class="cv-side">

                <div class="section">
                    <h2 class="section-title">Details</h2>

                    <?php if ($birthdate): ?>
                    <div class="info-item">
                        <div class="label">Date of Birth</div>
                        <div class="value"><?= date('F j, Y', strtotime($birthdate)) ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if ($address): ?>
                    <div class="info-item">
                        <div class="label">Location</div>
                        <div class="value"><?= $address ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if ($email): ?>
                    <div class="info-item">
                        <div class="label">Email</div>
                        <div class="value"><a href="mailto:<?= $email ?>"><?= $email ?></a></div>
                    </div>
                    <?php endif; ?>

                    <?php if ($phone): ?>
                    <div class="info-item">
                        <div class="label">Phone</div>
                        <div class="value"><?= $phone ?></div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($github || $linkedin): ?>
                <div class="section">
                    <h2 class="section-title">Links</h2>

                    <?php if ($github): ?>
                    <div class="info-item">
                        <div class="label">GitHub</div>
                        <div class="value"><a href="https://<?= $github ?>" target="_blank"><?= $github ?></a></div>
                    </div>
                    <?php endif; ?>

                    <?php if ($linkedin): ?>
                    <div class="info-item">
                        <div class="label">LinkedIn</div>
                        <div class="value"><a href="https://<?= $linkedin ?>" target="_blank"><?= $linkedin ?></a></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <div class="actions">
        <button class="print-btn" onclick="window.print()">🖨 Print / Save as PDF</button>
    </div>

</div>

</body>
</html>
