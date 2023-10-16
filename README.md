

 **1. **Clone on github****
	```sh
	git clone https://github.com/Samuel-Bie/helpdesk-backend.git
	```

**2. **Install the dependencies****

	```bash
	composer  install
	```
**3. Configure database and the queue driver**
To easy this process just copy the *.env.example* file to *.env*

 **4. Spin up the containers**
```bash
./vendor/bin/sail  up
```
 **5. Migrate the database and seed**
```bash
./vendor/bin/sail  artisan  migrate:fresh  --seed
```
 **6. Run the queue worker**
```bash
./vendor/bin/sail  artisan  queue:work
```
 **6. Access the Application**
Once the containers are up and running, you can access your Laravel application at http://localhost .

 **7. Testing the endpoints**
For testing in postman use the employee user
```
employee.user@test.com
password
```
For testing in postman use the regular user
```
regular.user@test.com
password
```
 **7. Endpoints documentation**
--Postman documentation
The Endpoints documentation is available in the following link (POSTMAN documentation)
https://documenter.getpostman.com/view/7413633/2s9YJgULiz

-- Swagger documentation
or after running the app the swagger documentation will be  available at:
http://localhost/api/documentation
