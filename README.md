# Sample API
This sample API implements the backend section of the [UQLibrary Work Test](https://github.com/uqlibrary/work-test) 

## Local Development
A local development environment has been prepared using `vagrant`. To run the application locally, copy the 
`Homestead.example.yaml` file to `Homestead.yaml` and modify it according to your needs.
 
Remember to set the folder path to point to where you have cloned this application.

Next, copy the `.env.example` to `.env` and modify it to suit your needs.

You will also need to add a host entry in your `/etc/hosts` file to point the default
IP address `192.168.10.10` to `homestead.app` - or whatever your specified IP and/or hostname is.

To start the virtual machine, run `vagrant up` from the command line.

When the VM has successfully started, ssh into the box using `vagrant ssh`.

Run `composer install` to install the required Compoer dependencies.

Then enter the following commands to install the database.
 
```sh
$ cd sample-api
$ php artisan migrate --seed
```
## API Services
This API implements the following endpoint services:

`GET /api/library/{id}`

Returns a JSON with library details for the specified `id`, where `id` is an integer value,
or returns a HTTP status code of `404` if the specified `id` is not found.

`POST /api/library`

Stores a library object supplied as a JSON representation.

You must set a `X-VALID-USER: ${token}` request header to authenticate to the endpoint.    

#### Example JSON body 
```json
{
  "id":   10123, 
  "code": "ARC100", 
  "name": "Architecture / Music Library", 
  "abbr": "Arch Music", 
  "url": "http://www.library.uq.edu.au/locations/architecture-music-library" 
}
```

Where:

`id` must be a positive number

`code` must be a 3 character, 3 number combination e.g. `ARC101`

`name` must be a string

`abbr` must be a string

`url` must be a valid URL

#### Possible return codes
`201 Created` if the resource was successfully created.

`401` if an invalid X-VALID-USER token or if the header is not supplied.

`422` on parameter validation failure.
  
Returns `500` error in all other cases.

`GET /api/findSmallestLeaf`

Returns the minimum value of an unsorted binary tree, given the sample JSON input described in `resources/fixtures/sample-tree.json`  


__NOTE:__ A sample Postman collection has been included in this repository for testing purposes.


## Unit Tests
To run the unit tests, ssh into the vagrant box and enter:

```sh
$ cd sample-api
$ php vendor/bin/phpunit tests
```

## Additional Information

### Time Estimates
Estimated time required to implement: 10 hrs

Actual time: 10 hrs

### Production Deployment

1. Use BambooCI or similar tool to clone and build the repository into a deployable artifact (zip).
2. Use BambooCI's built-in AWSCodeDeploy plugin to deploy the artifact, and environment configuration (i.e. `.env`) to configured EC2 and RDS instances.
3. For scalability, ELBs and auto-scaling groups can be configured as part of the AWS configuration scripts.
4. For optimization, the EC2 instances should be configured to run nginx and the RDS tuned for high throughput.

### Issues

None


