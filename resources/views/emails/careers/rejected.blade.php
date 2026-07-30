<!DOCTYPE html>
<html>
<head>
    <title>Update on your application</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2>Update on your application for {{ $application->career->title }}</h2>
    <p>Dear {{ $application->full_name }},</p>
    <p>Thank you for taking the time to apply for the <strong>{{ $application->career->title }}</strong> position at Possible Electrofeb LLP.</p>
    <p>While we were impressed with your background, we have decided to move forward with other candidates whose qualifications better meet our current needs for this role.</p>
    <p>We will keep your resume on file and may reach out if a suitable position opens up in the future.</p>
    <p>We wish you the best in your job search and future career endeavors.</p>
    <br>
    <p>Best regards,</p>
    <p><strong>HR Team</strong><br>Possible Electrofeb LLP</p>
</body>
</html>
