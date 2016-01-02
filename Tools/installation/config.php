<?php
	
	/* Name BASE_URL to match the path from root directory of your local environment to
	 * the Tools directory of this project.
	 */
	//example: define("BASE_URL","/test_projects/applicants/ehrich/Tools/");
	define("BASE_URL","/Tools/");
	
	//no need to change
	define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"] . BASE_URL);
	
	/* modify this to match your own server */
	//example 1 (localhost):        define("LINK_ROOT","http://localhost".BASE_URL);
	//example 2 (mydomainname.com): define("LINK_ROOT","http://mydomainname.com".BASE_URL);
	define("LINK_ROOT","http://localhost:8888".BASE_URL);
	
	/*************************************************************************/
	
	/* THE FOLLOWING VARIABLES ARE FOR THE DATABASE CONNECTIONS CREATED WITHIN
	 * CONTOLLER-CODE FUNCTIONS IN "Tools/inc/functions.php"
	 */
	 
	/* modify this according to the name of the server hosting the 'tools' database
	 * you create in the installation process
	 */
	//example: define("DB_HOST","cs5555.hostingcompany.com")
	define("DB_HOST","localhost");
	
	//this should not change
    define("DB_NAME","tools");
    
    //at this point I think the rest speaks for itself... :)
    define("DB_PORT","3306");
    define("DB_USER","root");
    define("DB_PASS","root");
