-- ------------------------------------------------------
-- Database: `user_db`
-- PHP Login & Registration System
-- ------------------------------------------------------

-- Create Database
CREATE DATABASE IF NOT EXISTS `user_db`;
USE `user_db`;

-- ------------------------------------------------------
-- Table structure for `users`
-- ------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------
-- Insert Example User (optional, you can remove this)
-- Default password = "123456" (hashed)
-- ------------------------------------------------------
INSERT INTO `users` (`name`, `email`, `password`) VALUES
('Demo User', 'demo@example.com', '$2y$10$6Y1d4dK3vHLeYy3vL8RfeuX2bZSBqVz2y4wZfGQnX9uQxRkKk5PGG');
