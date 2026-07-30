<!DOCTYPE html>
<html>
<head>
    <title>Application Received</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2>Application Received - {{ $application->career->title }}</h2>
    <p>Dear {{ $application->full_name }},</p>
    <p>Thank you for applying for the <strong>{{ $application->career->title }}</strong> position at Possible Electrofeb LLP.</p>
    <p>We have successfully received your application. Our recruitment team will review your profile, and if your qualifications match our current needs, we will contact you for the next steps.</p>
    <br>
    <p>Best regards,</p>
    <p><strong>HR Team</strong><br>Possible Electrofeb LLP</p>
</body>
</html>
