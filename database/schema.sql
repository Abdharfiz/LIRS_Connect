-- ============================================================
-- LIRS Connect / TaxTrack — Database Schema (Auth foundation)
-- ============================================================
-- Import this in phpMyAdmin, or run:
--   mysql -u root -p < schema.sql

CREATE DATABASE IF NOT EXISTS lirs_connect_v2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lirs_connect_v2;

-- ---------------------------------------------------
-- Taxpayers (regular users who log in via login.html)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS taxpayers (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    first_name    VARCHAR(100)  NOT NULL,
    last_name     VARCHAR(100)  NOT NULL,
    pay_id        VARCHAR(20)   NOT NULL UNIQUE,   -- e.g. N-123456
    email         VARCHAR(150)  NOT NULL UNIQUE,
    phone         VARCHAR(30)   NOT NULL,
    tin           VARCHAR(14)   NOT NULL,
    lga           VARCHAR(50)   DEFAULT NULL,
    address       VARCHAR(255)  DEFAULT NULL,
    password_hash VARCHAR(255)  NOT NULL,
    status        ENUM('active','deactivated') NOT NULL DEFAULT 'active',
    created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Admins / Officers (log in via admin-login.html)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS admins (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100)  NOT NULL,
    email         VARCHAR(150)  NOT NULL UNIQUE,
    password_hash VARCHAR(255)  NOT NULL,
    role          ENUM('super_admin','officer') NOT NULL DEFAULT 'officer',
    created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- NOTE: The admin account that was hardcoded in the old frontend JS
-- (admin@example.com) is NOT inserted here, because passwords must be
-- hashed with PHP's password_hash(), not typed as SQL.
-- After importing this schema, run database/seed_admins.php ONCE in the
-- browser (or `php seed_admins.php` in a terminal) to create it safely.
