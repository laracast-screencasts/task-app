TaskApp Installation steps
==============================

	1. Clone the repository/project
	
		Repository: laracast-screencasts/task-app
		branch: main
		
		git clone https://github.com/laracast-screencasts/task-app.git
  	    cd task-app

	2. Update the composer
	
		composer update

    3. create .env file in main directery
        copy .env.example 
        replace you DB configuration with current DB configuration in .env file

    4. Database Migrations
	
    	php artisan migrate
		
	5. Link to storage folder
	
		php artisan storage:link
		
	6. run project
        php artisan serve 
    
    7. Task Operation
        All task operation run in Postman

        8.1 create task
        http://{your_url}/api/create - POST

        form-data
            name
            description
            image
            type

        http://{your_url}/api/list - GET

        http://{your_url}/api/show/{id} - GET
        replace your id with your id in url


    8. Run cron job 
        php artisan app:taskdelete   