# MyCustomerApp
This is a test Project for Customer Registration App.
This Consist of two modules as mentioned below.

  - Frontend (VUE JS App)
  - Backend (Laravel - LUMEN API App)


### Frontend (VUE JS App) - mycustomerapi

Frontend uses a Vue Js Single Page app to create and show Customers in the web browser. This uses below technologies to fulfill its needs.

* [Vue JS] - HTML enhanced for web apps!
* [Bootsrap 4] - CSS web UI framework
* [Node Modules] - Runtime and development support

### Backend (Laravel - LUMEN API App) - myCustomerApp

Backend uses a Lumen based Laravel framwork to use a lightweighted app to handle API requests effienlty. From backend its getting and sending frontend API responses and process through the DB.
### Installation
Before proceeding to the below command need to install composer. https://getcomposer.org/download/

Goto the backend folder "myCustomerApp" and open the command terminal and run below code.

```sh
$ cd myCustomerApp
$ composer install
```
Create a database and modify the ".env" file and modifiy the database config details relatively.

Then run migration for updating the database tables

```sh
$ php artisan migrate
```

when need to start the backend run code below

```sh
$ php -S localhost:8000 -t public
```
This (localhost:8000) is the URL which uses from the Frontend to run the APIs.

Then goto the Frontend folder "mycustomerapi" and open the terminal and run below command to config enviorenment

```sh
$ npm install
```

To start the MyCustomerApp run below command.
```sh
$ npm run dev
```








