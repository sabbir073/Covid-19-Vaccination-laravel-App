<!-- resources/views/emails/vaccination-scheduled.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Your COVID Vaccine Appointment</title>
</head>
<body>
    <h1>Dear {{ $name }},</h1>
    <p>Your COVID vaccine appointment has been scheduled.</p>
    <p>Vaccine Center: <strong>{{ $center }}</strong></p>
    <p>Scheduled Date: <strong>{{ $scheduled_date }}</strong></p>
    <p>Please make sure to be on time for your vaccination.</p>
    <p>Thank you for registering!</p>
</body>
</html>
