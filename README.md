# Web application for Trybaker
## by Norman H. Strassner
### April, 2018

**earnyourpoints is a web application built for BAKER as a work sample.**

I. Installation
Download the zip file from the archive and place the root directory from the zip file into your base www directory.

If necessary, edit the file js/loyalty_globals.inc to change the following defaults:
-    $db = "loyaltydb";
-    $con = mysqli_connect("localhost", "root", "");
-   $DEVELOPMENT = false; *
 
 &ast;Note that the $DEVELOPMENT variable, if TRUE will turn off PHP warnings like mail errors if you do not have a working SMTP driver.*

Requirements:
- LAMP or WAMP stack (PHP7, MySQL, Apache, etc.)
- SMTP services

**Warning: SMTP server MUST be setup to successfully send mail via PHP**

Upon startup, you will be prompted for a telephone number, which you can enter in almost any format, as long as there are 10 actual digits.  All other characters are discared.

If the phone number was found not in the database, then you are prompted to enter your first and last name, and your email address.
That, along with the phone number you entered will be saved and you will be given an initial 50 points.

If you enter your recorded phone number again, and it has been at least 5 minutes, then you will earn an additional 20 points.
If 5 minutes have not elapsed since your last entry for that phone number, you will be notified of such and must wait the entire 5 minutes.

An automatic minute to minute on-screen countdown will show you how much time you have left before you can successfully add more points.

If audio is enabled on your computer, then short audio snippets will be played on errors or successful point accumulations.

To run locally:  http://localhost/earnyourpoints





