CREATE TABLE request (
     request_number INT(10) NOT NULL AUTO_INCREMENT,
     request_date DATETIME NOT NULL,
     description varchar(100) NOT NULL,
     weight varchar(10) NOT NULL,
     address varchar(20) NOT NULL,
     suburb varchar(10) NOT NULL,
     preferredDay ENUM('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'),
     preferredMonth ENUM('Jan','Feb','Mar','April','May','June','July','Aug','Sep','Oct','Nov','Dec'),
     preferredYear varchar(10) NOT NULL,
     preferredTime ENUM('7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
     minute varchar(10) NOT NULL,
     receiver varchar(15) NOT NULL,
     receiverAddress varchar(20) NOT NULL,
     receiverSuburb varchar(15) NOT NULL,
     receiverState ENUM('Australian Capital Territory','New South Wales','Northern Territory','Queensland','South Australia','Tasmania','Victoria','Western Australia'),
     customer_name varchar(20),
     Customer_Id INT(10),
     INDEX par_ind (Customer_Id),
     PRIMARY KEY (request_number),
     CONSTRAINT fk_customer FOREIGN KEY (Customer_Id)
         REFERENCES register(customer_number)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
