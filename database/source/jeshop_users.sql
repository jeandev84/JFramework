create table users
(
    id        int(10) auto_increment
        primary key,
    firstname varchar(100) not null,
    lastname  varchar(100) not null,
    email     varchar(300) not null,
    password  varchar(300) not null,
    mobile    varchar(10)  not null,
    address1  varchar(300) not null,
    address2  varchar(11)  not null
);

INSERT INTO jeshop.users (id, firstname, lastname, email, password, mobile, address1, address2) VALUES (1, 'demo', 'demo', 'demo@gmal.com', '12345', '123456789', 'Kolkata', 'VIP Road');
INSERT INTO jeshop.users (id, firstname, lastname, email, password, mobile, address1, address2) VALUES (2, 'Rizwan', 'Khan', 'rizwankhan.august16@gmail.com', '25f9e794323b453885f5181f1b624d0b', '9832268432', 'Hutton Road', 'Kolkata');
INSERT INTO jeshop.users (id, firstname, lastname, email, password, mobile, address1, address2) VALUES (3, 'Rizwan', 'Khan', 'salmankhan@gmail.com', '25f9e794323b453885f5181f1b624d0b', '8389080182', 'Hutton Road', 'Asansol');