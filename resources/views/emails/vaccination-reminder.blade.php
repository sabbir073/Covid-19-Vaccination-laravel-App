<!-- resources/views/emails/vaccination-reminder.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Your COVID Vaccine Appointment Reminder</title>
</head>
<body>
    <h1>Dear {{ $name }},</h1>
    <p>This is a reminder that your COVID vaccine appointment is scheduled for tomorrow.</p>
    <p>Vaccine Center: <strong>{{ $center }}</strong></p>
    <p>Scheduled Date: <strong>{{ $scheduled_date }}</strong></p>
    <p>Please make sure to be on time for your vaccination.</p>
    <p>Thank you!</p>
</body>
</html>
