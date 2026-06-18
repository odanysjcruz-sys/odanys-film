<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body      { font-family: 'Helvetica Neue', Arial, sans-serif; background:#f4f4f4; margin:0; padding:2rem; color:#1a1a1a; }
        .card     { background:#ffffff; max-width:580px; margin:0 auto; padding:2.5rem; border-top:3px solid #c9a84c; }
        .heading  { font-size:1.3rem; font-weight:700; letter-spacing:0.05em; margin:0 0 2rem; text-transform:uppercase; }
        .label    { font-size:0.68rem; letter-spacing:0.2em; text-transform:uppercase; color:#999; margin:0 0 4px; }
        .value    { font-size:0.95rem; margin:0 0 1.4rem; color:#1a1a1a; }
        .message  { background:#f9f9f9; border-left:3px solid #c9a84c; padding:1rem 1.2rem; font-size:0.95rem; line-height:1.7; white-space:pre-wrap; }
        hr        { border:none; border-top:1px solid #eee; margin:1.5rem 0; }
        a         { color:#c9a84c; }
    </style>
</head>
<body>
    <div class="card">
        <p class="heading">New Contact Form Submission</p>

        <p class="label">Name</p>
        <p class="value">{{ $data['name'] }}</p>

        <p class="label">Email</p>
        <p class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>

        <p class="label">Project Type</p>
        <p class="value">{{ $data['project_type'] }}</p>

        <hr>

        <p class="label">Message</p>
        <div class="message">{{ $data['message'] }}</div>
    </div>
</body>
</html>
