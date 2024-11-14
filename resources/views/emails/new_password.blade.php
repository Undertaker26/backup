<!-- resources/views/emails/new_password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>New Password</title>
</head>
<body>
    <p>Dear {{ $username }},</p>
    <p>We want to inform you that your password has been reset. This action was taken to enhance the security of your account. </p>
    <p>Please use the following new password to log in</p>
   <p><strong>{{ $newPassword }}</strong></p>
    <p>For your security, we recommend that you change this password to something more memorable and secure after you log in. A strong password typically includes:</p>
    <ul>
        <li>At least 12 characters</li>
        <li>A mix of uppercase and lowercase letters</li>
        <li>Numbers</li>
        <li>Special characters (e.g., !, @, #, $)</li>
    </ul>
    <p>If you did not request this password reset or if you believe your account may have been compromised, please contact our support team immediately.</p>

<p>Thank you for your attention to this matter.</p>
</body>
</html>
