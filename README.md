# oeffitrack-mobile
Mobile public transport tracking App

<img src="https://github.com/chm0815/oeffitrack-mobile/blob/master/screenshots/oet_logtool_rotes.PNG" width="300" height="500"/>

<img src="https://github.com/chm0815/oeffitrack-mobile/blob/master/screenshots/oet_logtool_logging.PNG" width="300" height="500"/>


Install:
- php mysql required (install a current version of wamp on windows)
- enable apache module mod_rewrite
- change the DocumentRoot in http.conf to your web directory
- import the database dump (basic_dump.sql)
- create a mysql user and configure web/application/config/database.php
- After these steps the basic version of oeffitrack should run in your browser

Mobile Logtool:
 - http://localhost/logging/moblogtool/<routeid>/<geomock>
 - http://localhost/logging/moblogtool/2/1
 
Run Tests:
-  http://localhost/logging/moblogtool/2/1/qunit
