-- ============================================================
-- LIRS Connect / TaxTrack — Database Schema (Auth foundation)
-- ============================================================
-- Import this in phpMyAdmin, or run:
--   mysql -u root -p < schema.sql

CREATE DATABASE IF NOT EXISTS lirs_connect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lirs_connect;

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

-- ---------------------------------------------------
-- Complaints (submitted by taxpayers)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS complaints (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    taxpayer_id       INT NOT NULL,
    category          VARCHAR(50) NOT NULL,                        -- e.g. 'assessment', 'payment', 'refund', 'other'
    subject           VARCHAR(200) NOT NULL,
    description       TEXT NOT NULL,
    attachment_path   VARCHAR(255) DEFAULT NULL,                   -- path to uploaded file (if any)
    status            ENUM('new','pending','under_review','resolved','rejected','closed') DEFAULT 'new',
    priority          ENUM('low','medium','high','critical') DEFAULT 'medium',
    assigned_to       INT DEFAULT NULL,                            -- admin/officer id
    created_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    resolved_at       TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (taxpayer_id) REFERENCES taxpayers(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES admins(id) ON DELETE SET NULL,
    INDEX idx_taxpayer (taxpayer_id),
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Complaint Responses (messages/notes on complaints)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS complaint_responses (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    complaint_id      INT NOT NULL,
    admin_id          INT NOT NULL,
    message           TEXT NOT NULL,
    is_internal       BOOLEAN DEFAULT FALSE,                       -- hidden from taxpayer if TRUE
    attachment_path   VARCHAR(255) DEFAULT NULL,
    created_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (complaint_id) REFERENCES complaints(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
    INDEX idx_complaint (complaint_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- ---------------------------------------------------
-- Notifications (system notifications for users)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS notifications (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    taxpayer_id       INT NOT NULL,
    complaint_id      INT DEFAULT NULL,
    type              VARCHAR(50) NOT NULL,                        -- e.g. 'status_change', 'new_response', 'assignment'
    title             VARCHAR(150) NOT NULL,
    message           TEXT NOT NULL,
    is_read           BOOLEAN DEFAULT FALSE,
    created_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (taxpayer_id) REFERENCES taxpayers(id) ON DELETE CASCADE,
    FOREIGN KEY (complaint_id) REFERENCES complaints(id) ON DELETE SET NULL,
    INDEX idx_taxpayer (taxpayer_id),
    INDEX idx_unread (is_read),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;
