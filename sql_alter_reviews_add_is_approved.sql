ALTER TABLE reviews
ADD COLUMN is_approved TINYINT(1) DEFAULT 0 AFTER created_at;
