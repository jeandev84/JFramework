create table brands
(
    id    int(100) auto_increment
        primary key,
    title text not null
);

INSERT INTO jeshop.brands (id, title) VALUES (1, 'HP');
INSERT INTO jeshop.brands (id, title) VALUES (2, 'Samsung');
INSERT INTO jeshop.brands (id, title) VALUES (3, 'Apple');
INSERT INTO jeshop.brands (id, title) VALUES (4, 'Sony');
INSERT INTO jeshop.brands (id, title) VALUES (5, 'LG');
INSERT INTO jeshop.brands (id, title) VALUES (6, 'Cloth Brand');