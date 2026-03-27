# CV Builder

A simple web-based CV generator built with HTML, CSS, and PHP.

## Features
- Fill out a form with personal info, contact details, education, skills, and experience
- Upload a profile photo
- Generates a clean, printable CV output
- Print or save as PDF directly from the browser

## Folder Structure
```
your-project/
├── index.php               ← CV input form
├── assets/
│   └── uploads/            ← auto-created, stores uploaded photos
└── view/
    └── output.php          ← processes form and displays the CV
```

## How to Run
1. Place the project folder inside your local server directory (e.g. `htdocs` for XAMPP)
2. Start Apache in XAMPP (or your preferred local server)
3. Open your browser and go to `http://localhost/Ballera2ACV/index.php`
4. Fill out the form and click **Generate My CV**

## Requirements
- PHP 7.4 or higher
- A local server (XAMPP, WAMP, Laragon, etc.)

## Notes
- Accepted photo formats: JPG, PNG, GIF (max 2MB)
- Skills should be separated by commas for proper tag display
- Use the **Print / Save as PDF** button on the output page to save your CV
