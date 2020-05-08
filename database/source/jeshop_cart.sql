create table cart
(
    id            int(10) auto_increment
        primary key,
    p_id          int(10)      not null,
    ip_add        varchar(250) not null,
    user_id       int(10)      not null,
    product_title varchar(200) not null,
    product_image varchar(200) not null,
    qty           int(10)      not null,
    price         int(10)      not null,
    total_amt     int(10)      not null
);

INSERT INTO jeshop.cart (id, p_id, ip_add, user_id, product_title, product_image, qty, price, total_amt) VALUES (1, 1, '0', 0, 'Samsung Dous 2', 'samsung mobile.jpg', 1, 5000, 5000);
INSERT INTO jeshop.cart (id, p_id, ip_add, user_id, product_title, product_image, qty, price, total_amt) VALUES (2, 2, '0', 0, 'iPhone 5s', 'iphone mobile.jpg', 1, 25000, 25000);