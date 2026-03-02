-- SQL script for phpMyAdmin import
-- Database Sistem Perpustakaan

-- 1. Create database
CREATE DATABASE IF NOT EXISTS perpus_app
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE perpus_app;

-- 2. Users table (Admin & Staff)
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_verified_at` TIMESTAMP NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'staff') DEFAULT 'staff',
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Members table (Anggota Perpustakaan)
CREATE TABLE `members` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `member_code` VARCHAR(50) NOT NULL UNIQUE,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NULL,
  `phone` VARCHAR(20) NULL,
  `address` TEXT NULL,
  `join_date` DATE NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 4. Categories table (Kategori Buku)
CREATE TABLE `categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 5. Books table (Buku)
CREATE TABLE `books` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `isbn` VARCHAR(50) NULL UNIQUE,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `publisher` VARCHAR(255) NULL,
  `publish_year` YEAR NULL,
  `category_id` BIGINT UNSIGNED NULL,
  `stock` INT DEFAULT 0,
  `available` INT DEFAULT 0,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 6. Borrowings table (Peminjaman)
CREATE TABLE `borrowings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `member_id` BIGINT UNSIGNED NOT NULL,
  `book_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NULL,
  `borrow_date` DATE NOT NULL,
  `due_date` DATE NOT NULL,
  `return_date` DATE NULL,
  `status` ENUM('borrowed', 'returned', 'overdue') DEFAULT 'borrowed',
  `fine` DECIMAL(10,2) DEFAULT 0,
  `notes` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`member_id`) REFERENCES `members`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 7. Insert dummy data - Users
-- Password untuk semua user: password
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
  ('Admin Perpustakaan', 'admin@perpus.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
  ('Staff Perpustakaan', 'staff@perpus.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'staff');

-- 8. Insert dummy data - Categories
INSERT INTO `categories` (`name`, `description`) VALUES
  ('Fiksi', 'Novel dan cerita fiksi'),
  ('Non-Fiksi', 'Buku pengetahuan umum'),
  ('Teknologi', 'Buku tentang teknologi dan komputer'),
  ('Sejarah', 'Buku sejarah dan biografi'),
  ('Sains', 'Buku sains dan penelitian');

-- 9. Insert dummy data - Members
INSERT INTO `members` (`member_code`, `name`, `email`, `phone`, `address`, `join_date`, `status`) VALUES
  ('M001', 'Budi Santoso', 'budi@email.com', '081234567890', 'Jl. Merdeka No. 10', '2024-01-15', 'active'),
  ('M002', 'Siti Nurhaliza', 'siti@email.com', '081234567891', 'Jl. Sudirman No. 20', '2024-02-20', 'active'),
  ('M003', 'Ahmad Rizki', 'ahmad@email.com', '081234567892', 'Jl. Gatot Subroto No. 30', '2024-03-10', 'active');

-- 10. Insert dummy data - Books
INSERT INTO `books` (`isbn`, `title`, `author`, `publisher`, `publish_year`, `category_id`, `stock`, `available`) VALUES
  ('978-602-1234-01-1', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 1, 5, 5),
  ('978-602-1234-02-2', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 1, 3, 3),
  ('978-602-1234-03-3', 'Pemrograman Web dengan PHP', 'John Doe', 'Informatika', 2020, 3, 4, 4),
  ('978-602-1234-04-4', 'Sejarah Indonesia Modern', 'M.C. Ricklefs', 'Gadjah Mada University Press', 2008, 4, 2, 2),
  ('978-602-1234-05-5', 'Fisika Dasar', 'Halliday & Resnick', 'Erlangga', 2015, 5, 6, 6);

-- 11. Insert dummy data - Borrowings
INSERT INTO `borrowings` (`member_id`, `book_id`, `user_id`, `borrow_date`, `due_date`, `status`) VALUES
  (1, 1, 1, '2024-03-01', '2024-03-15', 'borrowed'),
  (2, 3, 1, '2024-02-25', '2024-03-10', 'borrowed'),
  (3, 5, 2, '2024-02-20', '2024-03-05', 'returned');
