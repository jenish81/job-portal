# Job Application Portal with User Authentication

## Overview
In order to handle sessions, submit job applications, and authenticate users, this project provides a job application portal with a multi-step form. - User registration and login with "Remember Me" functionality is one of the main features.
- A multi-step employment application that requests personal data, educational history, and work history.
- Session management, which saves form data while the user moves through various stages.
- An application review page where users can check and make changes before submitting.
- The application is saved as a JSON file upon final submission.


## Files
- `index.php`: The "Remember Me" feature-equipped login page.
- The page where users register (`registration.php`).
- `portal.php`: A multi-step application for a job that asks about work experience, education, and personal information.
- `information.php`: Check and send off this page.
- `logout.php`: Features related to logout.

## Usage
1. Download the project or clone the repository.
2. Verify that PHP and JSON file handling are supported by your web server.
3. To initiate the username and password procedure, open `index.php`.
4. Use `registration.php` to register a user.
5. Go through the `portal.php` job application form after logging in.
6. After going over the data in `information.php`, submit the application.


## Project Structure
- `applications.json`: Stores all submitted applications.
- `users.json`: Stores user registration information.