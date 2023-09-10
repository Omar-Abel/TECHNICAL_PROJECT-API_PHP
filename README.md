# API REST | PHP NO FRAMEWORKS
In this technical project I made an API REST using only PHP without frameworks. I used MySQL to access and store the data.

The project have in the MySQL database a table called "Contacts" where through the API, we can see the contacts, add, update and delete a contact. 

## API IN ACTION
I will be using **Postman** to test the API.

> GET contacts

In this method we receive a JSON with all the contacts at the moment in the table:
![HTTP GET](https://i.imgur.com/zqOpc0a.png)
 >GET one contact (by id)

In this method we receive a JSON with only one contact, by passing the id as a param, in case the id doesn't exits, it will throw an error asking with a valid id:
![HTTP GET ID](https://i.imgur.com/H6pfvoT.png)
> POST contact

In this method we send a contact object, in the body we must specify the fields and values to add the contact (you don't have to add id, and the extra phone number is optional). It has validations for empty values, big values, only text or only numbers and so on: 
![HTTP POST](https://i.imgur.com/zoTXi58.png)
> PUT contact

In this method we update the data from a contact, in order to that we have to add the Id, and all the other fields, then add the new values and send it. It has all the validations and only accepts currents IDs: 
![HTTP PUT](https://i.imgur.com/6l3SyhW.png)
>DELETE contact (by id)

In this method we delete a contact from the table, by passing the id as a param, in case the id doesn't exits, it will throw an error asking with a valid id:
![HTTP DELETE](https://i.imgur.com/MmD0K6x.png)
