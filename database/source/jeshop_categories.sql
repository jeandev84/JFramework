create table categories
(
    id    int(100) auto_increment
        primary key,
    title text not null
);

INSERT INTO jeshop.categories (id, title) VALUES (1, 'Electronics');
INSERT INTO jeshop.categories (id, title) VALUES (2, 'Ladies Wears');
INSERT INTO jeshop.categories (id, title) VALUES (3, 'Mens Wear');
INSERT INTO jeshop.categories (id, title) VALUES (4, 'Kids Wear');
INSERT INTO jeshop.categories (id, title) VALUES (5, 'Furnitures');
INSERT INTO jeshop.categories (id, title) VALUES (6, 'Home Appliances');
INSERT INTO jeshop.categories (id, title) VALUES (7, 'Electronics Gadgets');