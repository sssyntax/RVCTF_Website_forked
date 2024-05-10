# RVCTF_Website
Official GitHub for RVCTF Website. Please use this github to register any changes. 

Content pages
1. Login pages
2. User pages


## 1. Login pages
**Login page**
- Default page where user is not logged in
- Users will login through google login system
- The email used will determine admin access (login through email that is admin for admin rights)
- Login feature will allow users to save progress on the ctf challenges
- Note: Only students account are allowed to login into the website

**Team choice page**
- Users will join or create a team

**Create team page**
- Team name and password will be requested from team leader to authenticate members that are joining

**Join team page**
- Team name and password will be requested from user to authenticate them when joining team

**Send invite page**
- Accessible through the challenge page
- Only team leaders can send a team invite, the list of invited members is based on people who has login in the page before. Invited user has to login with the specific email and will be redirected to *team join* page

**Team join page**
- Upon invitation, login into the email that is being invited will automatically redirect the user to the team join page.
- Invited user will get to decide whether to accept or reject the invitation
- Whether the user accepts or reject, the user will automatically be redirected to the challenge page

## 2. User pages
**Challenge page**
- Default page where user is logged in
- Provides challenges categories by ctf categories
- Points system on top right
- Link to resources on top right

**Resources page**
- Accessible through challenge page
- Provides resources with animation in different categories

**Leaderboard page**
- Note: Only accessible to admins
- Show team points based on highest to lowest

**Make admin page**
- Accessible through top right of challenge page
- Note: Only accessible to admins
- Used to edit admin access with a list based on people who has login in the page before, does data validation to check for valid email address and confirmation to edit admin rights
- Admin access are used to add/remove/edit challenges, access leaderboard page


# Editing locally for the 1st time

## Setting up the DB
1. Run the MYSQL feature on xampp
2. Go to localhost on the web browser, then click phpMyAdmin to enter the DB menu
3. Create a new DB called "ctfdb". Click on the new DB and import ctfdb.sql into new database
4. Go to "connect.inc.php" (under backend --> includes) Change the username, password, dbname and server name based on the instructions inside



ALL paths should be relative to index.php
A tags should use href = "index.php?filename=%" where % is the name of the page you wanna go to



> A collaboration between RVCTF and RdeV
