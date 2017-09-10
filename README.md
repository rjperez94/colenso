# Colenso

## Overview

### The Colenso Project

The intent of the Project is to ignite public and academic interest in Colenso's words – published, unpublished, private letters, journals – both in Māori and English, by sharing them with the world in digital form. We envisage a hub for all things Colenso: a place to read documents in the original, explore his writing through transcriptions, and as a place to experiment with new research and interpretation methods.

The Colenso Project team includes Dr Sydney Shep, Frith Driver-Burgess, Rhys Owen, Charlotte Darling, Meredith Paterson, and Dr Ian St George (The Colenso Society). Previous team members included Melissa Bryant, Emma Chapman, Donelle McKinley and Jamie Norrish.

## Features

- Adding new letters
- Viewing letters in XML database
- Editing letters in XML database
- Searching letters in XML database
	- logical
	- xQuery
- Download search result XMLs into a zip file

## Setup XAMPP
1. Download and install XAMPP from <a href="https://www.apachefriends.org/index.html">here</a>
2. Open directory `XAMPP -> apache -> conf -> httpd.conf`
3. Look for line "Options Indexes FollowSymLinks Includes ExecCGI" (w/o quotes). Delete word "Indexes"
	-This disables site-directory viewing
4. Open directory `XAMPP -> php -> php.ini`
5. Look for line "extension=php_openssl.dll" (w/o quotes). Make sure it has no semicolon before the line. If it has, delete it
	-This allows for encrypted information transmission (to be available in the future, just in case)
6. Open directory `XAMPP -> htdocs` and make a new folder called `colenso` (You may change the name, if you want)
7. Clone this repository to that `colenso` folder
8. Open the XAMPP Control Panel and start Apache module (You may need to install the Apache service)

## Setup BaseX
1. Download and install the BaseX module from <a href="http://basex.org/products/download/all-downloads/">here</a>
2. Download and extract the Colenso XML files from <a href="http://ecs.victoria.ac.nz/foswiki/pub/Courses/SWEN303_2016T1/Assignments/Colenso_TEIs.zip">here</a>
3. Open directory `BaseX -> bin -> basexgui`. The BaseX GUI will open
4. Go to `Database menu -> New`
5. In the input file, select the directory where you extracted the Colenso XML files. Choose a name for the database and the input format as XML. Press OK
6. The Colenso database will now be created and opened automatically upon completion
7. Go to `Database menu -> Properties`
8. Go to Full-Text tab
9. Tick:
	-Language:English
	-Stemming
	-Diacritics
10. Then dapress Create to establish full-text index. After this, press Optimize All to optimise the DB. Close the GUI
11. Go to `BaseX -> bin -> basexserver` to start the server

- - - -

You can now view the site my going to <a href="https://www.localhost/colenso">http://localhost/colenso/</a> in your browser. <strong>Make sure that the XAMPP Apache module and BaseX server is started before you do this</strong>

Please <a href="http://ecs.victoria.ac.nz/Courses/SWEN303_2016T1/Assignments">click here</a> for more information about this project

To view a working demonstration of the features of this project, visit Google Drive<a href="https://drive.google.com/file/d/0B6WmKGfecjMXVmZkRTlYQkFfVVU/view?usp=sharing"> here</a>
