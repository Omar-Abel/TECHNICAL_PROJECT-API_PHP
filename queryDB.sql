CREATE DATABASE API_Contacts;

USE API_Contacts;


CREATE TABLE `Contacts` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(60) NOT NULL,
	`lastName` VARCHAR(60) NOT NULL,
	`email` VARCHAR(120) NOT NULL,
	`phone` VARCHAR(12) NOT NULL,
	`extraPhone` VARCHAR(12) NOT NULL DEFAULT 'Vacio',
	PRIMARY KEY (`id`)
);

INSERT INTO Contacts(firstName, lastName, email, phone) VALUES ('Omar', 'Lora', 'omarlora14@gmail.com', '829-775-7852');

SELECT * FROM Contacts


