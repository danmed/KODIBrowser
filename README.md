# KODIBrowser

Description : 

Allows the browsing of Movies and TVShows via the Kodi MySQL database.

# Features : 
* Browse movies by Recently Added, Genre, Rating, Year, Name (All limited to 30 random results)
* Play movie on desired Kodi front end (not working for TV yet)
* Watch trailers
* Browse TV Shows by name or Recently Added
* Browse individual episodes
* Play Episodes on Desired Kodi front end.

# Coming Soon :
* Suggestions please :)

# Prereqs : 
* PHP5
* MySQL
* For Krypton (DB Version 107) MySQL installs ONLY!


# Instructions
Point config.inc.php to your MySQL database and put in your tmdb and tvdb API keys

Index.php - returns last 30 entries added to DB
TVshows.php - returns last 30 entries added to DB

Any of the search functions returns 30 random results from the DB

# Screenshots

![Alt text](/screenshots/main.PNG?raw=true "Optional Title")
![Alt text](/screenshots/movieinfo.PNG?raw=true "Optional Title")
![Alt text](/screenshots/tvinfo.PNG?raw=true "Optional Title")
![Alt text](/screenshots/tvshows.PNG?raw=true "Optional Title")
