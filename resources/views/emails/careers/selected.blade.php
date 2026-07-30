<!DOCTYPE html>
<html>
<head>
    <title>Job Offer</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2>Congratulations! - {{ $application->career->title }}</h2>
    <p>Dear {{ $application->full_name }},</p>
    <p>We are delighted to offer you the position of <strong>{{ $application->career->title }}</strong> at Possible Electrofeb LLP.</p>
    <p>Our HR representative will be in touch with you shortly to share the formal offer letter and discuss the onboarding process.</p>
    <p>We look forward to welcoming you to the team!</p>
    <br>
    <p>Best regards,</p>
    <p><strong>HR Team</strong><br>Possible Electrofeb LLP</p>
</body>
</html>
