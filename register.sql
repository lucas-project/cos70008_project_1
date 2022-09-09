CREATE TABLE `register` (
    customer_number int(10) AUTO_INCREMENT,
    customer_name varchar(20),
    password varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    phone varchar(15) NOT NULL,
 PRIMARY KEY (customer_number,customer_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

