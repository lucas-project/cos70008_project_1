CREATE TABLE `register` (
    customer_number int(10) NOT NULL AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    password varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    phone varchar(15) NOT NULL,
 PRIMARY KEY (customer_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

