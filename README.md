## Installing the project
* Clone the repository

`git clone git@github.com:ThomasCantonnet/nanos.git`

* Build docker images

`cd docker; docker-compose build`

* Run docker-compose

`docker-compose up -d`

* Run the database migrations inside the container

`docker exec -it docker_web_1 bash`

`cd /home/nanos`

`php public/index.php migrations:migrate`

`php public/index.php nanos:campaign:import`

* Go to the frontend

`http://127.0.0.1`
