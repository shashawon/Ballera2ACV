<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Builder</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #ffffff;
            --card: #f5f5f5;
            --border: #222222;
            --accent: #b8860b;
            --accent2: #d4a017;
            --text: #111111;
            --muted: #555555;
            --input-bg: #ffffff;
            --red: #861515;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Times New Roman', Times, serif;
            min-height: 100vh;
            padding: 60px 20px;
        }

        .container {
            max-width: 720px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            border-top: 5px solid var(--red);
            border-bottom: 3px solid var(--accent);
            padding: 24px 0;
        }

        .header .eyebrow {
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 10px;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .header h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            line-height: 1.15;
            color: var(--text);
        }

        .header h1 span {
            color: var(--accent);
        }

        .header p {
            color: var(--muted);
            font-size: 0.92rem;
            margin-top: 8px;
            font-family: Arial, sans-serif;
        }

        .card {
            background: var(--card);
            border: 2px solid var(--border);
            border-radius: 0;
            padding: 30px 28px;
            margin-bottom: 18px;
        }

        .section-label {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #ffffff;
            background: var(--red);
            display: inline-block;
            padding: 4px 12px;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-grid .full { grid-column: 1 / -1; }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 12px;
            font-weight: bold;
            color: var(--text);
            letter-spacing: 0.3px;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="date"],
        textarea,
        select {
            background: var(--input-bg);
            border: 1.5px solid #555555;
            border-radius: 0;
            padding: 10px 12px;
            color: var(--text);
            font-family: Arial, sans-serif;
            font-size: 0.9rem;
            width: 100%;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--accent);
            outline: 2px solid var(--accent);
            outline-offset: 0px;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
            line-height: 1.5;
        }

        select option { background: #ffffff; }

        .file-upload {
            position: relative;
        }

        .file-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-label {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--input-bg);
            border: 1.5px dashed #555555;
            border-radius: 0;
            padding: 12px 14px;
            cursor: pointer;
        }

        .file-upload:hover .file-label {
            border-color: var(--accent);
            background: #fffbee;
        }

        .file-icon {
            width: 34px;
            height: 34px;
            background: var(--accent2);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .file-text small {
            display: block;
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
            font-family: Arial, sans-serif;
        }

        .skills-hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
            font-family: Arial, sans-serif;
        }

        .submit-wrap {
            text-align: center;
            padding-top: 10px;
        }

        button[type="submit"] {
            background: var(--red);
            color: #ffffff;
            border: 2px solid var(--text);
            border-radius: 0;
            padding: 14px 48px;
            font-family: Arial, sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: var(--text);
            color: var(--accent2);
        }

        button[type="submit"]:active {
            background: var(--accent);
            color: var(--text);
        }

        @media (max-width: 560px) {
            .form-grid { grid-template-columns: 1fr; }
            .card { padding: 20px 16px; }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <p class="eyebrow">Portfolio</p>
        <h1>Build Your CV</h1>
        <p>Fill in the details below to generate your curriculum vitae.</p>
    </div>

    <form action="./view/output.php" method="POST" enctype="multipart/form-data">

        <div class="card">
            <p class="section-label">01 — Personal Information</p>
            <div class="form-grid">
                <div class="field full">
                    <label>Profile Photo</label>
                    <div class="file-upload">
                        <input type="file" name="profile" accept="image/*" id="photoInput">
                        <div class="file-label">
                            <div class="file-icon">PIC</div>
                            <div class="file-text">
                                <span>Click to upload photo</span>
                                <small>JPG, PNG, GIF — max 2MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="e.g. Juan" required>
                </div>
                <div class="field">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="e.g. dela Cruz" required>
                </div>
                <div class="field">
                    <label for="birthdate">Date of Birth</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="field">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="" disabled selected>Select</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Prefer not to say</option>
                    </select>
                </div>
                <div class="field">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" placeholder="e.g. Filipino">
                </div>
                <div class="field">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="City, Province">
                </div>
            </div>
        </div>

        <div class="card">
            <p class="section-label">02 — Contact Details</p>
            <div class="form-grid">
                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@email.com" required>
                </div>
                <div class="field">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="+63 912 345 6789">
                </div>
                <div class="field">
                    <label for="github">GitHub (optional)</label>
                    <input type="text" id="github" name="github" placeholder="github.com/username">
                </div>
                <div class="field">
                    <label for="linkedin">LinkedIn (optional)</label>
                    <input type="text" id="linkedin" name="linkedin" placeholder="linkedin.com/in/username">
                </div>
            </div>
        </div>

        <div class="card">
            <p class="section-label">03 — About Me</p>
            <div class="field">
                <label for="summary">Professional Summary</label>
                <textarea id="summary" name="summary" placeholder="Write a short summary about yourself, your goals, and what you bring to the table..."></textarea>
            </div>
        </div>

        <div class="card">
            <p class="section-label">04 — Education & Skills</p>
            <div class="form-grid">
                <div class="field full">
                    <label for="education">Education Background</label>
                    <textarea id="education" name="education" placeholder="e.g. BS Information Technology — Eastern Visayas State University (2021–Present)"></textarea>
                </div>
                <div class="field full">
                    <label for="skills">Technical Skills</label>
                    <textarea id="skills" name="skills" placeholder="e.g. HTML, CSS, JavaScript, PHP, MySQL, Git..."></textarea>
                    <span class="skills-hint">Separate skills with commas for better display.</span>
                </div>
                <div class="field full">
                    <label for="experience">Work / Project Experience</label>
                    <textarea id="experience" name="experience" placeholder="e.g. Capstone Project: Lost and Found System — EVSU-OCC (2024)&#10;Freelance web developer for local businesses (2023)"></textarea>
                </div>
            </div>
        </div>

        <div class="submit-wrap">
            <button type="submit" name="submit">Generate My CV</button>
        </div>

    </form>
</div>

<script>
    document.getElementById('photoInput').addEventListener('change', function () {
        const label = this.closest('.file-upload').querySelector('.file-text span');
        label.textContent = this.files[0] ? this.files[0].name : 'Click to upload photo';
    });
</script>
</body>
</html>
