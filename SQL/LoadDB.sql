INSERT INTO products (product_id, product_name, product_price, product_category, product_subcat, product_discount, product_stock) VALUES
    (1, 'APPLE MACBOOK AIR 15"', 1899.00, 1, 'MACBOOK',0,100),
    (2, 'ASUS VIVOBOOK X1405ZA-LY104W', 1583.00, 1, 'LAPTOP',0,100),
    (3, 'SAMSUNG S23 Ultra 12+1TB-CREAM SM-S918', 2458.00, 2,'PHONE',0,100),
    (4, 'APPLE IPHONE 15 512GB BLUE MTPG3ZP/A', 1779.00, 2,'PHONE',0,100),
    (5, 'GARMIN SMART WATCH ENDURO 2 (GM-010-02754-13)', 1739.00, 2, 'WEARABLES',0,100),
    (6, 'SONY OLED TV XR-48A90K', 4037.00, 3, 'TV',0,100),
    (7, 'SAMSUNG OLED TV QA65S95BAKXXS', 5449.00, 3, 'TV',0,100),
    (8, 'SONY SOUND BAR HT-A9', 2725.00, 3, 'SOUND SYSTEM',0,100),
    (9, 'APPLE AIRPODS PRO (2ND GENERATION) WITH MAGSAFE CASE (USB-C) MTJV3ZA/A', 362.35, 3, 'HEADPHONES',0,100),
    (10, 'DYSON RECHARGEABLE VAC V12S DETECT SLIM', 1299.00, 4, 'VACUUM CLEANER',0,100),
    (11, 'DAIKIN SINGLE SPLIT CTKM25VVMG/MKM50VVMG', 2349.00, 4, 'AIR CONDITIONER',0,100),
    (12, 'ECOVACS ROBOTIC VACUUM DEEBOT T20 OMNI', 1299.00, 4, 'VACUUM CLEANER',0,100);

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
    (1, 0, 0),
    (2, 0, 0),
    (3, 0, 0),
    (4, 0, 0),
    (5, 0, 0),
    (6, 0, 0),
    (7, 0, 0),
    (8, 0, 0),
    (9, 0, 0),
    (10, 0, 0),
    (11, 0, 0),
    (12, 0, 0);
    
INSERT INTO members (member_id, member_name, member_email, member_contact, member_password) VALUES
    (0, 'admin', 'admin', 0, 'admin'),
	(1, 'testone', 'test01@gmail.com', 88888888, '0ebfbadc8eb323262c3095350f44e9c7'),
	(2, 'testtwo', 'test02@gmail.com', 88883333, 'e8f45e4474e9b49b903d903459074eeb');
	
INSERT INTO product_desc (product_id, product_desc) VALUES
	(1, 'The 15-inch MacBook Air is impossibly thin and has a stunning Liquid Retina display. Supercharged by the M2 chip — and with up to 18 hours of battery life — it delivers incredible performance in an ultra-portable design.'),
    (2, 'Turn everyday tasks into something special with Vivobook 14 (X1404ZA-AM170W), your essential tool for getting things done easier, anywhere. It’s completely user-friendly too, with its 180° lay-flat hinge and physical webcam shield.'),
    (3, 'Please visit https://www.samsung.com/sg/smartphones/galaxy-s23/ for more information'),
    (4, 'iPhone 15 brings you Dynamic Island, a 48MP Main camera and USB-C — all in a durable colour-infused glass and aluminium design.'),
    (5, 'Get solar charging that provides extra-long GPS battery life to help you outlast your next ultrarace, plus power-saving positional accuracy and built-in mapping to help you find your way.'),
    (6, 'This amazing 4K Full Array LED TV powered by Cognitive Processor XR™ delivers intense contrast. A newly designed local dimming structure brings scenes vividly to life. Now available at Harvey Norman.'),
    (7, 'Please visit https://www.samsung.com/sg/tvs/oled-tv/s95b-65-inch-oled-4k-smart-tv-qa65s95bakxxs/ for more information'),
    (8, 'Sony Home Theatre featured with 360 Spatial Sound that adapts to your environment.Our revolutionary 360 Spatial Sound Mapping technology creates up to twelve phantom speakers from just four real speakers. '),
    (9, 'AirPods Pro feature up to 2x more Active Noise Cancellation,1 Transparency mode and now Adaptive Audio, 2 which automatically tailors the noise control for you to provide the best listening experience across different environments and interactions throughout the day.'),
    (10, 'Deep cleaning power. Now washes hard floors. All in one machine. Submarine™ wet roller head, Fluffy Optic™ cleaner head, Hair Screw Tool, Combination Tool, Crevice Tool, Charger, Wand clip, Wall dock'),
    (11, 'Standard Installation – Upon purchase made, our authorized installer will contact you to advise on earliest installation dates. (within 2 weeks) Express Installation – Installation within 7 days is available, subject to charges from $150 onwards.'),
    (12, 'Ozmo Tubro Mopping, Auto Hotwater Washing For Mopping Pad, Hot Air Drying, Auto 9mm Mop Lift up, 3D Mapping');
	
INSERT INTO product_specs (product_id, specs_1, specs_2, specs_3, specs_4, specs_5) VALUES
	(1, 'Processor Type: M2', 'Storage Capacity: 256GB', '15 Inch Display 2880x1864', '1.51kg, 1.15 x 34.04 x 23.76 (H x W x D cm) ', '12 Months Warranty'),
    (2, 'Processor Model: Intel® Core™ i5-1235U', 'Storage Capacity:512GB with 8GB RAM', '14 Inch Display 1920x1080', '1.4kg', '24 Months Warranty'),
    (3, 'Memory: 8GB RAM', 'Storage Capacity:8GB', '12 Months Warranty', 0, 0),
    (4, 'Color : Blue', 'Storage Capacity:512GB', 0, 0, 0),
    (5, 'Model: Enduro 2 (02754-13)', 0, 0, 0, 0),
    (6, 'Screen Size: 65" 4K Ultra HD', 'Bluetooth v4.2 + WiFi + Ethernet(LAN)', '4 Ticks Energy Efficiency', '25kg, 86.1 x 144.5 x 34.5 (H x W x D cm)', 0),
    (7, 'Screen Size: 65" 4K Ultra HD', 'WiFi + Ethernet(LAN)', '4 Ticks Energy Efficiency', '29kg, 89.44 x 144.35 x 26.79 (H x W x D cm)', '36 Months Warranty'),
    (8, 'HDMI 1/1(eARC/ARC)', 'USB Type A', 'Wireless Ready IEEE802.11 a/b/g/n/ac', 'Dolby Atmos', 0),
    (9, 0, 0, 0, 0, 0),
    (10, 'Color: Yellow/Nickel', '3.1 kg with 25.7cm length and 124.7cm height', 0, 0, 0),
    (11, 0, 0, 0, 0, 0),
    (12, 'Battery Life: 260 Mins', 'Suction Power: 6000', 'Power Consumption: 45W', 'Charge-up Time: 6.5 hours', 0);