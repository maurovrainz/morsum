# Introduction

## Components

This is the framework made for the Morsum coding challenge.
It respects the classic MVC pattern, and it's composed by 4 essential parts.

- The Request: This object contains the whole data of the request, query params, form params, files, server, headers, etc.

- The Router: It is responsible of 3 tasks, store the Routes, match the url with the Routes, and generate a url based on a stored Route.

- The Resolver: receives the Route and the Request, and calls the proper controller action. The action will return a Response.

- The Response: it contains the view data generated in the controller action, and the response headers.

And each of these elemenets works together inside of the main application object, an instance of the class Morsum\Application.

The Flow:

1. Someone request our application, so the method "run" of our Application instance is called.
2. An instance of Request is created containing the http request data.
3. The URL is taken from the Request in order to obtain a Route.
4. The Router search in its routes one who matches with URL.
5. Once the URL matched, we have the Route, and it contains the data about the controller and the accion.
6. The Request and the Routes is passed to the Resolver, who creates the Controller instance and executes the Action.
7. The controller returned a Response instance, contain the view data and the response headers.
8. The response is sent and the execution flow ends.

## The directory structure

- config/
The application boostrap, configuration, routes.

- framework/
The framework's PHP code

- src/
The project's PHP code and the MVC structure.

- vendor/
The third-party dependencies.

- web/
The web root directory.
