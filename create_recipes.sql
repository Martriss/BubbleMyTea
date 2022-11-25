INSERT INTO recipes (name, description, price, inCatalog,image)
 VALUES
        ("Kokusan","purée de cerises au lait frappé à base du thé oolong",5, true,"img/products/1.jpg"),
        ("Sunsundae","Purée d'ananas, crème de coco, frappé à base du thé oolong",5, true,"img/products/2.jpg"),
        ("Ozonea","Purée de cerises et jus bergamote frappée a la base du thé oolong",5, true,"img/products/3.jpg"),
        ("Fruitful","Purée de mandarine, zest orange et lime frappé à base de thé oolong",5, true,"img/products/4.jpg"),
        ("Ibizcus","Thé noir, infusion de fleurs d'hibiscus, jus d'orange, litchi et ses perles",5, true,"img/products/5.jpg"),
        ("Napoli","Thé vert au jasmin, basilic, mandarine et perle passion",5, true,"img/products/6.jpg"),
        ("Coconut island","Thé vert au jasmin, lait de coco, coco et gelée de coco",5, true,"img/products/7.jpg"),
        ("Tea Dulce de Leche","Thé noir, lait de vache, caramel et perle de tapioca",5, true,"img/products/8.jpg"),
        ("Pomme d'amour","Thé vert jasmin, jus de pomme frais infusé aux pralines et perles de pommes",5, true,"img/products/9.jpg"),
        ("Tea cookies","Thé noir au lait, aux éclats de cookies,caramel et perles de tapiocas",5, true,"img/products/10.jpg");

INSERT INTO popings (name, price)
 VALUES 
        ("Perles de tapioca", 0.5),
        ("Gelée de coco", 0.5),
        ("Aloe vera", 0.5),
        ("Perles de pomme verte", 0.5),
        ("Perles de fraise", 0.5),
        ("Perles de fruit de la passion", 0.5),
        ("Perles de pêche", 0.5),
        ("Perles de litchi", 0.5);

INSERT INTO orders (user_id, price,created_at)
 VALUES
       (1, 5,CURRENT_TIMESTAMP()),
       (1, 5,CURRENT_TIMESTAMP()),
       (2, 5,CURRENT_TIMESTAMP()),
       (1, 5,CURRENT_TIMESTAMP());

INSERT INTO products (recipe_id, poping_id, price, sweetness, created_at, updated_at)
 VALUES 
        (1, 1, 5, "sans sucre",CURRENT_TIMESTAMP(), NULL),
        (3, 2, 5, "sans sucre",CURRENT_TIMESTAMP(), NULL),
        (6, 4, 5, "sans sucre",CURRENT_TIMESTAMP(), NULL),
        (4, 3, 5, "sans sucre",CURRENT_TIMESTAMP(), NULL),
        (5, 3, 5, "sans sucre",CURRENT_TIMESTAMP(), NULL);

INSERT INTO supplements(product_id, poping_id)
 VALUES
        (2, 4),
        (2, 3),
        (2, 5),
        (3, 7);

INSERT INTO order_products (order_id, product_id)
 VALUES
       (1, 1),
       (2, 2),
       (3, 3),
       (4, 4),
       (4, 5);