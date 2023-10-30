DROP DATABASE IF EXISTS novatech;
CREATE DATABASE IF NOT EXISTS novatech;

USE novatech;
DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_name CHAR(50) NOT NULL,
  product_price DOUBLE NOT NULL,
  product_category INT NOT NULL,
  product_subcat CHAR(15) NOT NULL
);

DROP TABLE IF EXISTS orders;
CREATE TABLE IF NOT EXISTS orders (
  order_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  qty INT ,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

DROP TABLE IF EXISTS wishlist;
CREATE TABLE IF NOT EXISTS wishlist (
  wishlist_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  qty INT,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

DROP TABLE IF EXISTS cart;
CREATE TABLE IF NOT EXISTS cart (
  cart_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  qty INT,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

DROP TABLE IF EXISTS total_sales;
CREATE TABLE IF NOT EXISTS total_sales (
  product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  total_price DOUBLE,
  total_qty INT,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

DROP TABLE IF EXISTS reviews;
CREATE TABLE IF NOT EXISTS reviews (
  product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  reviews DECIMAL,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);



