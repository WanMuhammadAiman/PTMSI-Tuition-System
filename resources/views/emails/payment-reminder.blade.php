<!DOCTYPE html>
<html>
<body>
    <p>Dear {{ $name }},</p>

    <p>This is a friendly reminder that your tuition fee for this month has not been paid yet. 
    Kindly complete your payment as soon as possible to avoid any interruptions to your classes.</p>

    <p><a href="{{ url('/student/payment') }}">Click here to pay now</a></p>

    <p>Thank you,<br>PTMSI Tuition Center</p>
</body>
</html>
