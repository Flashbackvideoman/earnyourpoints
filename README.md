#Test for Trybaker from Norm Strassner
## by Norman H. Strassner
### April, 2018

**earnyourpoints is a web application built for BAKER as a work sample.**

Upon startup, you will be prompted for a telephone number, which you can enter in almost any format.
If the phone number was found not in the database, then you are prompted to enter your first and last name, and your email address.
That, along with the phone number you entered will be saved and you will be given an initial 50 points.

If you enter your recorded phone number again, and it has been at least 5 minutes, then you will earn an additional 20 points.
If 5 minutes have not elapsed since your last entry for that phone number, you will be notified of such and must wait the entire 5 minutes.

An automatic minute to minute on-screen countdown will show you how much time you have left before you can successfully add more points.

To run locally:  http://localhost/earnyourpoints

Requirements:
LAMP or WAMP stack
SMTP services

**Warning: SMTP server MUST be setup to successfully send mail via PHP**




