## User_Research_Login
- By: Lexi Sterio

## Prerequisites
- Atom
- Terminal
- PHPmyAdmin

## Websites used for reference
- http://php.net/manual/en/reserved.variables.session.php
- http://php.net/manual/en/function.date.php
- http://php.net/manual/en/language.operators.comparison.php

## Step 1
- Allow the user to login and edit the account (done in class)

## Step 2
- When the new user logs in for the first time they are sent to edit their account, skipping the admin page
- in order to do this you create a new field in the database user_first, by default this value
is set to 1
- After the first login of the user, we change this value to 0

# Step 3
- New user has a time limit to login after their account has been created. If they do not login before the time expires their account will be suspended.
- For this to happen you need to use the date/time function from php in order to create two date objects and make a comparison between them
- you will get the time difference between the too objects in minutes
- you will set the max time value of the users first login and then you will use this value to compare it with the difference in time from when they first logged in

## Authors
- Lexi Sterio
