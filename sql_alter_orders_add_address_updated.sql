ALTER TABLE orders
ADD COLUMN address_updated TINYINT(1) DEFAULT 0 AFTER address;
