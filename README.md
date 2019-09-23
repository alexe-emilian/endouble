### PROJECT OVERVIEW
- API Platform was used due to its many features that are already included in the framework and fit the project needs
- The API has a single endpoint http://localhost:8000/api/resources that takes data through `GET` or `POST` requests and returns the appropriate responses
    - The class `ResourceController` in `api\src\Api\Controller\ResourceController.php` handles the requests and returns a `json` response
- In a RESTful approach, for list a `GET` request should be used, however, since the payload indicated in the assignment was a `json` body I decided to handle both
    - The method `getParameters` in `ApiHandlerService` handles the logic for parameter retrieval, allowing us to quickly remove a method from the route
        - Remove the method that we do not wish to have on our endpoint from the controller method
        - Change `getParameters` so that it offers support only for one set of data   
- In case of an exception being thrown, an event subscriber has also been created so that the user always receives a proper `json` response
    - The class `ApiExceptionSubscriber` in `api\src\Api\EventListener\ApiExceptionSubscriber.php` handles the logic mentioned above
- Unit tests have also been created for the classes found in the `Client`, `Handler`, and `Service` directories 
    
### PROJECT SETUP
- Due to my limited home setup(Windows 10 HOME edition), I was unable to use docker even though I preferred that method and instead used the `Symfony WebServerBundle` to start the server and test the endpoints
- `docker` would have started all the appropriate containers, however in the case that the assignment is tested without docker it also requires php, composer and an appropriate certificate to be able to make calls to the APIs 
- To start the server simply navigate to the `api` directory inside the project and use `php bin/console server:run`
- More information can be found on https://api-platform.com/docs/distribution/ regarding the framework itself  

### ASSIGNMENT REQUIREMENTS
- All the requests in the assignment will return the proper response except
```
{
  "sourceId": "comics",
  "year": 2015,
  "limit": 2
}
```
- As it can be seen in the response next to the request block in `meta.request.sourceId` and in `data` the `sourceId` should have been `space` and the year `2013`.
- This is also the first request in the list presented in the assignment
- A `POST` request with the body below will return the appropriate data
```
{
  "sourceId": "space",
  "year": 2013,
  "limit": 2
}
```
- Considering the fact that for the `XKCD` response no examples are present in the assignment several design decisions have been made:
    - The `XKCD` api returns only one comic, however, the `comics` source will always return a list
    - This can be done with the field `numbers` on the request, examples below
        - `[45, 310, 476]`
        - `"114,230"`
    - This was done to remain consistent with the functionality of the `space` source
    - In order to receive the latest comic, the `numbers` field can be omitted from the request 
    - Only a few properties returned by the `XKCD` api will be used.
    - None of these properties have been transformed in any way so that the flexibility of the project regarding responses could be demonstrated
    - More information on the last point above will follow during the section in which it is explained how new remote sources are added
    
### PROJECT DESIGN
- In order to easily accommodate for new sources, a chain of responsibility pattern was used to handle the request
- `ApiHandlerService:handle()` method is used to iterate through all the current source implementations
- All the api handlers implement the interface `ApiHandlerInterface`
- All the services that implement the interface `ApiHandlerInterface` are tagged `api.request.handler` as it can be seen in the `services.yaml` file
- All the services tagged `api.request.handler` are used as parameters for `ApiHandlerService`
- Once a handler is found through the method `canHandle()` that can process the request then method `handle()` is called
- The handlers then make a call to the appropriate client in which the proper response is acquired from the api and then transformed if necessary
- `SpacexClient` details
    - In order to transform the response from the `SpaceX` api, the method `getResponse` on `ResponseBuilderService` was used 
- `XkcdClient` details
    - As it was mentioned during the **ASSIGNMENT REQUIREMENTS** section, no example was presented for the response of the `comics` source
    - In order to remain consistent across sources, the `XkcdClient` looks in the `numbers` parameter and makes multiple calls to the `Xkcd` api
    - These responses are then directly deserialized and returned

### ADDING A NEW SOURCE
- In order to add a new source a few simple steps must be followed
    - Add a new constant in `SourceEnum` for the new source, this will help us later on
    - Create a new directory in `src` with the appropriate source name
    - Add a new handler class that implements `ApiHandlerInterface`
        - This class contains logic both for deciding if the request can be handled and the handling logic itself
    - Add a new client class that implements `ClientInterface`
        - This class will handle the communication with the new api
    - One or more response classes can also be created that will help when deserializing the response

