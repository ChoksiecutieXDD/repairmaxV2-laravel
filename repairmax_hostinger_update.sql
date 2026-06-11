-- Repairmax Database Update

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `category` varchar(255) DEFAULT 'general',
  `type` varchar(255) DEFAULT 'string',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'active',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `device_models` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `fault_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `max_price` decimal(10,2) DEFAULT NULL,
  `estimated_time` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `is_active` tinyint(1) DEFAULT 1,
  `image_path` varchar(255) DEFAULT NULL,
  `gallery_paths` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fault_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ensure columns exist in case tables were already created by migrations
-- (Some MySQL/MariaDB environments support 'ADD COLUMN IF NOT EXISTS'. If yours does not, these statements can be skipped if tables were created above)
ALTER TABLE `brands` ADD COLUMN IF NOT EXISTS `status` varchar(255) NULL;
ALTER TABLE `device_models` ADD COLUMN IF NOT EXISTS `device_type` varchar(255) NULL, ADD COLUMN IF NOT EXISTS `status` varchar(255) NULL;
ALTER TABLE `fault_types` ADD COLUMN IF NOT EXISTS `max_price` decimal(10,2) NULL, ADD COLUMN IF NOT EXISTS `estimated_time` varchar(255) NULL, ADD COLUMN IF NOT EXISTS `status` varchar(255) NULL;

TRUNCATE TABLE `settings`;
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessName', '\"Repairmax\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessEmail', '\"repairmaxsample@gmail.com\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessPhone', '\"+63 912 345 6789\"', '2026-05-17 15:05:13', '2026-06-10 16:59:41');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessAddress', '\"Commonwealth Ave. Cor. IBP Road (Litex Junction), Brgy. Payatas, Quezon City, 1119\"', '2026-05-17 15:05:13', '2026-06-10 16:59:41');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessCity', '\"Manila\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessState', '\"NCR\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessZipCode', '\"1000\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessWebsite', '\"https:\\/\\/repairmax.online\\/\"', '2026-05-17 15:05:13', '2026-06-10 16:59:41');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('smtpHost', '\"smtp-relay.brevo.com\"', '2026-05-17 15:05:13', '2026-06-10 16:59:41');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('smtpPort', '\"587\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('emailFromAddress', '\"repairmaxsample@gmail.com\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('emailFromName', '\"Repairmax\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('emailNotificationsEnabled', 'true', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('appointmentReminders', 'true', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('appointmentReminderTime', '\"24\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('statusUpdateNotifications', 'true', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('adminAlerts', 'true', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('paymentGateway', '\"stripe\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('currencyCode', '\"PHP\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('taxPercentage', '\"0\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('businessHours', '\"{\\\"monday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"tuesday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"wednesday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"thursday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"friday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"saturday\\\":{\\\"open\\\":\\\"09:00\\\",\\\"close\\\":\\\"16:00\\\"},\\\"sunday\\\":{\\\"open\\\":\\\"\\\",\\\"close\\\":\\\"\\\"}}\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('passwordMinLength', '\"8\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('passwordRequireNumbers', 'true', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('passwordRequireSpecialChars', 'true', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('passwordExpireDays', '\"90\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('twoFactorAuthRequired', 'false', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('sessionTimeout', '\"60\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('maxLoginAttempts', '\"5\"', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('n8nWebhookUrl', '\"http:\\/\\/localhost:5678\\/webhook-test\\/chatbot\"', '2026-05-22 14:12:37', '2026-05-22 14:12:37');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('n8nWebhookSecret', '\"repairmax_secret_123\"', '2026-05-22 14:12:37', '2026-05-22 14:12:37');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('autoBackupTime', '\"02:00\"', '2026-05-22 14:12:37', '2026-05-22 14:12:37');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('maintenanceMode', 'true', '2026-05-22 14:17:48', '2026-06-10 16:46:37');
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES ('smtpUsername', '\"adddb0001@smtp-brevo.com\"', '2026-06-10 16:59:41', '2026-06-10 16:59:41');

TRUNCATE TABLE `brands`;
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (1, 'Apple', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (2, 'Samsung', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (3, 'Xiaomi', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (4, 'OPPO', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (5, 'vivo', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (6, 'realme', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (7, 'Huawei', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (8, 'Infinix', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (9, 'TECNO', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (10, 'Nothing', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (11, 'Google Pixel', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (12, 'OnePlus', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (13, 'ASUS', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (14, 'Sony', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (15, 'Motorola', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (16, 'Nokia', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (17, 'Lenovo', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (18, 'Honor', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (19, 'ZTE', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (20, 'RedMagic', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (21, 'LG', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (22, 'HTC', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (23, 'Meizu', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (24, 'Black Shark', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (25, 'POCO', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (26, 'HP', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (27, 'Dell', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (28, 'Acer', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (29, 'MSI', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (30, 'Gigabyte', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (31, 'Razer', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (32, 'Nintendo', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (33, 'PlayStation', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');
INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (34, 'Xbox', 'active', '2026-05-17 15:05:13', '2026-05-17 15:05:13');

TRUNCATE TABLE `device_models`;
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (1, 1, 'iPhone XS', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (2, 1, 'iPhone 11', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (3, 1, 'iPhone 12', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (4, 1, 'iPhone 13', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (5, 1, 'iPhone 14', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (6, 1, 'iPhone 15', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (7, 1, 'iPhone 15 Pro Max', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (8, 2, 'Galaxy S21', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (9, 2, 'Galaxy S22', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (10, 2, 'Galaxy S23', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (11, 2, 'Galaxy S24 Ultra', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (12, 2, 'Galaxy A54', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (13, 3, 'Redmi Note 12', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (14, 3, 'Redmi Note 13 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (15, 3, 'Xiaomi 13', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (16, 3, 'Xiaomi 14 Ultra', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (17, 4, 'Reno 10', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (18, 4, 'Reno 11 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (19, 4, 'Find X6', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (20, 5, 'V27', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (21, 5, 'V29 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (22, 5, 'Y17s', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (23, 6, 'realme 11 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (24, 6, 'realme C55', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (25, 6, 'realme GT Neo 5', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (26, 7, 'Mate 50 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (27, 7, 'Mate 60 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (28, 7, 'P60 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (29, 8, 'Note 30', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (30, 8, 'Zero 30', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (31, 8, 'Hot 30i', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (32, 9, 'Camon 20', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (33, 9, 'Pova 5', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (34, 9, 'Spark 10 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (35, 10, 'Phone (1)', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (36, 10, 'Phone (2)', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (37, 11, 'Pixel 6a', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (38, 11, 'Pixel 7 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (39, 11, 'Pixel 8 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (40, 12, 'OnePlus 10 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (41, 12, 'OnePlus 11', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (42, 12, 'OnePlus 12', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (43, 13, 'ROG Phone 7', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (44, 13, 'Zenfone 10', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (45, 14, 'Xperia 1 V', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (46, 14, 'Xperia 5 V', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (47, 15, 'Edge 40', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (48, 15, 'Razr 40 Ultra', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (49, 16, 'Nokia G42', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (50, 16, 'Nokia X30', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (51, 17, 'Legion Y70', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (52, 18, 'Honor 90', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (53, 18, 'Honor Magic5 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (54, 19, 'Blade V50', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (55, 19, 'Axon 50 Ultra', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (56, 20, 'RedMagic 8S Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');
INSERT INTO `device_models` (`id`, `brand_id`, `name`, `device_type`, `status`, `created_at`, `updated_at`) VALUES (57, 20, 'RedMagic 9 Pro', '', 'active', '2026-05-17 15:11:02', '2026-05-17 15:11:02');

TRUNCATE TABLE `fault_types`;
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (1, 'Audio Jack Repair', 'audio', 'Repairs loose, damaged, or non-functional audio jacks to restore proper headphone and earphone connectivity.', 500.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:38:55');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (2, 'LCD/Screen Replacement', 'screen', 'Replaces cracked, flickering, unresponsive, or damaged screens with a new LCD/display assembly.', 2500.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:39:56');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (3, 'Battery Replacement', 'power', 'Installs a new battery for devices experiencing fast battery drain, overheating, or unexpected shutdowns.', 1200.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:39:07');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (4, 'Charging Port Repair', 'power', 'Fixes charging issues caused by damaged, loose, or dirty charging ports to restore proper power connection.', 800.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:40:03');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (5, 'Speaker Repair', 'audio', 'Repairs distorted, low-volume, or non-working speakers to improve device audio output quality.', 700.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:41:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (6, 'Microphone Repair', 'audio', 'Resolves microphone issues affecting voice calls, recordings, or voice command functionality.', 700.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:45:03');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (7, 'Camera Repair', 'hardware', 'Repairs blurry, malfunctioning, or damaged front and rear cameras for proper photo and video performance.', 1500.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:45:12');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (8, 'Power Button Repair', 'power', 'Fixes stuck, loose, or unresponsive power buttons to restore device power control functions.', 600.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:46:35');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (9, 'Volume Button Repair', 'hardware', 'Repairs faulty volume buttons that no longer adjust sound levels properly.', 600.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:46:50');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (10, 'Water Damage Repair', 'hardware', 'Performs cleaning, diagnostics, and component repair for devices exposed to water or liquid damage.', 1500.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:46:58');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (11, 'Back Glass Replacement', 'screen', 'Replaces cracked or damaged back glass panels to restore device appearance and protection.', 1800.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:47:06');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (16, 'Face ID / Fingerprint Sensor Repair', 'hardware', 'Repairs biometric authentication features that are not detecting fingerprints or facial recognition properly.', 2000.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:51:35');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (17, 'Motherboard Repair', 'hardware', 'Diagnoses and repairs damaged motherboard components affecting overall device functionality.', 3500.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:51:29');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (18, 'Overheating Issue Repair', 'hardware', 'Identifies and resolves hardware or software causes of excessive device heating.', 1000.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:51:22');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (19, 'Wi-Fi / Bluetooth Repair', 'hardware', 'Repairs wireless connectivity issues affecting Wi-Fi and Bluetooth performance.', 1200.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:51:15');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (20, 'Data Recovery Service', 'software', 'Attempts to recover lost, deleted, or inaccessible files, photos, videos, and documents from damaged devices.', 2500.00, NULL, '', 'active', '2026-06-05 16:25:26', '2026-06-06 14:47:24');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (21, 'Software Troubleshooting', 'software', 'Diagnoses and resolves software-related problems such as lagging, freezing, crashes, and app errors.', 500.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (22, 'Operating System Reinstallation', 'software', 'Reinstalls the device operating system to fix severe software corruption or system failures.', 800.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (23, 'Boot Loop Fix', 'software', 'Repairs devices stuck on startup logos or continuously restarting during boot.', 900.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (24, 'Tablet Screen Repair', 'screen', 'Professional glass and LCD replacement services for iPads and Android tablets.', 3000.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (25, 'MacBook Display Repair', 'screen', 'Premium screen and backlight assembly replacement for MacBook Air and MacBook Pro models.', 8500.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (26, 'Wireless Charging Repair', 'power', 'Fixes issues with wireless charging coils and motherboard power management chips.', 1500.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (27, 'Earpiece Speaker Repair', 'audio', 'Resolves low-volume, crackling, or non-functional ear speakers during voice calls.', 600.00, NULL, '', 'active', '2026-06-10 12:12:53', '2026-06-10 12:12:53');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (28, 'Apple Watch Screen Repair', 'screen', 'Repair and replacement of damaged, cracked, or unresponsive Apple Watch screens.', 2500.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (29, 'Apple Watch Glass Replacement', 'screen', 'Replacement of cracked front glass on Apple Watches while retaining original LCD/OLED panel.', 1800.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (30, 'Smartwatch Display Repair', 'screen', 'Professional repair for cracked, bleeding, or faulty smartwatch screens.', 1500.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (31, 'Apple Watch Battery Replacement', 'power', 'Replacement of degraded or swollen Apple Watch batteries to restore original battery life.', 1200.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (32, 'Apple Watch Charger Port Repair', 'power', 'Repair or replacement of the induction charging sensor and charging contacts.', 1000.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (33, 'Smartwatch Charging Issue Fix', 'power', 'Diagnostics and repair of charging connectivity issues for various smartwatch models.', 800.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (34, 'Apple Watch Speaker Repair', 'audio', 'Replacement of blown or muffled speakers on Apple Watches to restore clear audio.', 900.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (35, 'Apple Watch Microphone Repair', 'audio', 'Repair of Siri and call microphone connectivity issues on Apple Watch.', 900.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (36, 'Smartwatch Audio Troubleshooting', 'audio', 'Fixing muffled sound, speaker static, or microphone failure on smartwatches.', 600.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (37, 'Apple Watch Software Restore', 'software', 'Restoring Apple Watch software or updating watchOS when stuck on logo or boot loops.', 800.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (38, 'Apple Watch OS Diagnostics', 'software', 'Complete diagnostic run of watchOS software to identify connectivity and system errors.', 500.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');
INSERT INTO `fault_types` (`id`, `name`, `category`, `description`, `base_price`, `max_price`, `estimated_time`, `status`, `created_at`, `updated_at`) VALUES (39, 'Smartwatch Firmware Reinstallation', 'software', 'Reinstalling firmware or flashing operating system to resolve boot errors on smartwatches.', 700.00, NULL, '', 'active', '2026-06-10 12:30:43', '2026-06-10 12:30:43');

SET FOREIGN_KEY_CHECKS=1;
