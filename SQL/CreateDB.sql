DROP DATABASE IF EXISTS novatech;
CREATE DATABASE IF NOT EXISTS novatech;

USE novatech;
DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_name CHAR(100) NOT NULL,
  product_price DOUBLE NOT NULL,
  product_category INT NOT NULL,
  product_subcat CHAR(15) NOT NULL,
  product_discount DOUBLE,
  product_stock INT
);

DROP TABLE IF EXISTS members;
CREATE TABLE IF NOT EXISTS members (
  member_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  member_name CHAR(50) NOT NULL,
  member_email CHAR(50) NOT NULL,
  member_contact INT NOT NULL,
  member_password CHAR(50) NOT NULL
);

DROP TABLE IF EXISTS orders;
CREATE TABLE IF NOT EXISTS orders (
  order_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  member_id INT UNSIGNED NOT NULL,
  product_id INT UNSIGNED NOT NULL,
  qty INT,
  FOREIGN KEY (product_id) REFERENCES products(product_id),
  FOREIGN KEY (member_id) REFERENCES members(member_id)
);

DROP TABLE IF EXISTS wishlist;
CREATE TABLE IF NOT EXISTS wishlist (
  member_id INT UNSIGNED NOT NULL,
  product_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (member_id) REFERENCES members(member_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

DROP TABLE IF EXISTS cart;
CREATE TABLE IF NOT EXISTS cart (
  member_id INT UNSIGNED NOT NULL,
  product_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (member_id) REFERENCES members(member_id),
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
  reviews_total INT,
  reviews_qty INT,
  reviews DECIMAL(2, 1) GENERATED ALWAYS AS (IF(reviews_qty > 0, reviews_total / reviews_qty, 0)) STORED,
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

