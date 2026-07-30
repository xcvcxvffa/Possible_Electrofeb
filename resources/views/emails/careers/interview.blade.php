<!DOCTYPE html>
<html>
<head>
    <title>Interview Invitation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2>Interview Invitation - {{ $application->career->title }}</h2>
    <p>Dear {{ $application->full_name }},</p>
    <p>We have reviewed your application for the <strong>{{ $application->career->title }}</strong> position and would like to invite you for an interview.</p>
    <p>Our team will reach out to you shortly to finalize the schedule and logistics.</p>
    <br>
    <p>Best regards,</p>
    <p><strong>HR Team</strong><br>Possible Electrofeb LLP</p>
</body>
</html>
