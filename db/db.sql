-- @ Owner: hellomister
-- @ Creation Date: MAY-2025

-- @ Set Character Set
SET NAMES utf8mb4;

-- @ Set time zone
SET time_zone = '-05:00';
# Eastern Time (USA)

-- @ Create Database: blog_db
CREATE DATABASE IF NOT EXISTS `blog_db`;

-- @ Use Database: blog_db
USE `blog_db`;

-- @ Create Table: users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `pwd` VARCHAR(255) NOT NULL,
    `profile_picture` VARCHAR(255) DEFAULT 'default.png',
    `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `current_session_id` VARCHAR(255) NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- @ Create Table: sessions
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` VARCHAR(255) PRIMARY KEY,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_agent` TEXT NOT NULL,
    `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- @ Create Table: post_category
CREATE TABLE IF NOT EXISTS `post_category` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE
);

-- @ Create Table: posts
CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `cover_image` VARCHAR(255) NOT NULL,
    `content` LONGTEXT NOT NULL,
    `category_id` INT(11) UNSIGNED NOT NULL,
    `user_id` INT(11) UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    FOREIGN KEY (`category_id`) REFERENCES `post_category` (`id`) ON DELETE CASCADE
);

-- @ Create Table: post_comments
CREATE TABLE IF NOT EXISTS `post_comments` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT(11) UNSIGNED NOT NULL,
    `user_id` INT(11) UNSIGNED DEFAULT NULL,
    `comment` TEXT NOT NULL,
    `commented_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
);

-- @ Create Table: post_views
CREATE TABLE IF NOT EXISTS `post_views` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT(11) UNSIGNED NOT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `viewed_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
);

-- @ Create Table: post_likes with proper constraints for MariaDB
CREATE TABLE IF NOT EXISTS `post_likes` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT(11) UNSIGNED NOT NULL,
    `user_id` INT(11) UNSIGNED DEFAULT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `liked_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    CONSTRAINT `check_user_or_ip` CHECK (
        (user_id IS NOT NULL) OR (ip_address IS NOT NULL)
    ),
    CONSTRAINT `unique_user_like` UNIQUE (post_id, user_id),
    CONSTRAINT `unique_ip_like` UNIQUE (post_id, ip_address)
);

-- @ Create Table: contact_requests
CREATE TABLE IF NOT EXISTS `contact_requests` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `status` ENUM('new', 'in_progress', 'completed', 'spam') NOT NULL DEFAULT 'new',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status` (`status`),
    INDEX `idx_email` (`email`),
    INDEX `idx_created_at` (`created_at`)
);

-- Insert the deleted user with ID=1 (first record)
INSERT INTO
    users (
        id,
        first_name,
        last_name,
        username,
        pwd,
        role,
        status
    )
VALUES (
        1,
        'Deleted',
        'User',
        'deleted_user',
        'b8QqNgUxDg9c aqFeKmVW5baw dRKzM7kb6Rz6 9s323mkpehs4 V6U4zg9DMEvJ', -- Fixed pwd approach
        'user',
        'inactive'
    );

-- Create a trigger to protect the deleted user from being deleted
DELIMITER //

CREATE TRIGGER before_delete_protect_deleted_user
BEFORE DELETE ON users
FOR EACH ROW
BEGIN
    IF OLD.id = 1 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Cannot delete the system reserved deleted_user account';
    END IF;
END //

-- Create a trigger to transfer ownership when a user is deleted
CREATE TRIGGER before_user_delete
BEFORE DELETE ON users
FOR EACH ROW
BEGIN
    -- Using local variable properly
    DECLARE user_to_delete INT UNSIGNED;
    SET user_to_delete = OLD.id;
    
    -- Update posts to belong to the deleted user (ID=1)
    UPDATE posts SET user_id = 1 WHERE user_id = user_to_delete;
    
    -- Update comments to belong to the deleted user
    UPDATE post_comments SET user_id = 1 WHERE user_id = user_to_delete;
    
    -- Update likes to belong to the deleted user
    UPDATE post_likes SET user_id = 1 WHERE user_id = user_to_delete;
END //

DELIMITER ;