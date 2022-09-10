CREATE TABLE request (
     request_number INT(10) NOT NULL AUTO_INCREMENT,
     request_date DATETIME NOT NULL,
     description varchar(100) NOT NULL,
     weight varchar(10) NOT NULL,
     address varchar(20) NOT NULL,
     suburb varchar(10) NOT NULL,
     preferredDate DATE,

     time varchar(10) NOT NULL,
     receiver varchar(15) NOT NULL,
     receiverAddress varchar(20) NOT NULL,
     receiverSuburb varchar(15) NOT NULL,
     receiverState ENUM('Australian Capital Territory','New South Wales','Northern Territory','Queensland','South Australia','Tasmania','Victoria','Western Australia'),
     customer_name varchar(20),
     customer_number INT(10),

     INDEX (customer_number,customer_name),
     PRIMARY KEY (request_number),
     CONSTRAINT fk_customer  FOREIGN KEY (customer_number,customer_name) REFERENCES register(customer_number,customer_name)


)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
