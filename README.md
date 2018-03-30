# sigfox-back-end-api-and-laravel-service
Example of a laravel service class to communicate with Sigfox Back End API.

This class uses Curl in order to perform the calls to the Sigfox API. To make a successful request, you need basic authentication (64bits) using your username and password provided by the Sigfox Back End. Authentication has to be performed on every request.

The id mentionned in the class is the id of the Sigfox device, usually something like '1ACD23'.

The class has 4 methods:

  - read_last($username, $password, $id) which returns the last message received from the sigfox device.
  - read_multiple($username, $password, $id, $limit) which returns the messages received from the sigfox device according to the limit parameter set.
  - read_device_intel($username, $password, $id) which returns the informations about the sigfox device.
  - read_toekn_intel($username, $password, $id) which returns the informations about the token used by the sigfox device.

