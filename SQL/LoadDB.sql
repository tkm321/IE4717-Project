INSERT INTO products (product_id, product_name, product_price, product_category, product_subcat) VALUES
    (1, 'APPLE MACBOOK AIR 15"', 1899.00, 1, 'MACBOOK'),
    (2, 'ASUS VIVOBOOK X1405ZA-LY104W', 1583.00, 1, 'LAPTOP'),
    (3, 'SAMSUNG S23 Ultra 12+1TB-CREAM SM-S918', 2458.00, 2,'PHONE'),
    (4, 'APPLE IPHONE 15 512GB BLUE MTPG3ZP/A', 1779.00, 2,'PHONE'),
    (5, 'GARMIN SMART WATCH ENDURO 2 (GM-010-02754-13)', 1739.00, 2, 'WEARABLES'),
    (6, 'SONY OLED TV XR-48A90K', 4037.00, 3, 'TV'),
    (7, 'SAMSUNG OLED TV QA65S95BAKXXS', 5449.00, 3, 'TV'),
    (8, 'SONY SOUND BAR HT-A9', 2725.00, 3, 'SOUND SYSTEM'),
    (9, 'APPLE AIRPODS PRO (2ND GENERATION) WITH MAGSAFE CASE (USB-C) MTJV3ZA/A', 362.35, 3, 'HEADPHONES'),
    (10, 'DYSON RECHARGEABLE VAC V12S DETECT SLIM', 1299.00, 4, 'VACUUM CLEANER'),
    (11, 'DAIKIN SINGLE SPLIT CTKM25VVMG/MKM50VVMG', 2349.00, 4, 'AIR CONDITIONER'),
    (12, 'ECOVACS ROBOTIC VACUUM DEEBOT T20 OMNI', 1299.00, 4, 'VACUUM CLEANER');

INSERT INTO total_sales (product_id, total_price, total_qty) VALUES
    (1, 0.0, 0),
    (2, 0.0, 0),
    (3, 0.0, 0),
    (4, 0.0, 0),
    (5, 0.0, 0),
    (6, 0.0, 0),
    (7, 0.0, 0),
    (8, 0.0, 0),
    (9, 0.0, 0),
    (10, 0.0, 0),
    (11, 0.0, 0),
    (12, 0.0, 0);
	
INSERT INTO reviews (product_id, reviews_total, reviews_qty) VALUES
    (1, 5, 2),
    (2, 41, 10),
    (3, 15, 3),
    (4, 3, 1),
    (5, 0, 0),
    (6, 0, 0),
    (7, 0, 0),
    (8, 0, 0),
    (9, 0, 0),
    (10, 0, 0),
    (11, 0, 0),
    (12, 0, 0);