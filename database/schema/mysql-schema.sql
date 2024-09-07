/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority_level` enum('low','medium','high') COLLATE utf8mb4_unicode_ci DEFAULT 'high',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_email_unique` (`email`),
  UNIQUE KEY `admin_users_mobile_unique` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

 create table `products` (`id` bigint unsigned not null auto_increment primary key, `product_id` varchar(20) not null, `mrp` double not null, `category_code` varchar(50) not null, `sub_category_code` varchar(50) not null, `product_code` varchar(50) not null, `brand_code` varchar(50) not null, `name` varchar(100) not null, `images` json not null, `image_base_path` varchar(225) not null, `variants` json not null, `attributes` json not null, `offer_value` int not null, `offer_type` enum('price', 'percentage') not null default 'price', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `products` add unique `products_uid_unique`(`product_id`)  

  ⇂ create table `master_mappings` (`id` bigint unsigned not null auto_increment primary key, `category_code` varchar(20) not null, `category` varchar(50) not null, `sub_category_code` varchar(50) not null, `sub_category` varchar(50) not null, `product_code` varchar(50) not null, `product` varchar(50) not null, `variants` json not null, `attributes` json not null, `created_by` varchar(100) not null, `updated_by` varchar(100) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
    
  ⇂ create table `master_brands` (`id` bigint unsigned not null auto_increment primary key, `brand_code` varchar(50) not null, `brand` varchar(50) not null, `created_by` varchar(100) not null, `updated_by` varchar(100) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  
  ⇂ create table `cart` (`id` bigint unsigned not null auto_increment primary key, `cart_id` varchar(50) not null, `customer_id` varchar(50) not null, `amount` double not null, `shipping_cost` double not null, `net_amount` double not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  

  ⇂ create table `cart_items` (`id` bigint unsigned not null auto_increment primary key, `cart_id` varchar(50) not null, `customer_id` varchar(50) not null, `product_id` varchar(20) not null, `mrp` double not null, `category_code` varchar(50) not null, `sub_category_code` varchar(50) not null, `product_code` varchar(50) not null, `brand_code` varchar(50) not null, `name` varchar(100) not null, `images` json not null, `image_base_path` varchar(225) not null, `variants` json not null, `attributes` json not null, `offer_value` int not null, `offer_type` enum('price', 'percentage') not null, `quantity` int not null, `product_amount` double not null, `total_amount` double not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `cart_items` add unique `cart_items_uid_unique`(`product_id`)  
  
  ⇂ create table `orders` (`id` bigint unsigned not null auto_increment primary key, `cart_id` varchar(50) not null, `order_id` varchar(50) not null, `customer_id` varchar(50) not null, `amount` double not null, `shipping_cost` double not null, `net_amount` double not null, `is_cod` enum('yes', 'no') not null default 'no', `payment_platform` varchar(100) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  
  ⇂ create table `orders_items` (`id` bigint unsigned not null auto_increment primary key, `cart_id` varchar(50) not null, `order_id` varchar(50) not null, `customer_id` varchar(50) not null, `product_id` varchar(20) not null, `mrp` double not null, `category_code` varchar(50) not null, `sub_category_code` varchar(50) not null, `product_code` varchar(50) not null, `brand_code` varchar(50) not null, `name` varchar(100) not null, `images` json not null, `image_base_path` varchar(225) not null, `variants` json not null, `attributes` json not null, `offer_value` int not null, `offer_type` enum('price', 'percentage') not null, `quantity` int not null, `product_amount` double not null, `total_amount` double not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `orders_items` add unique `orders_items_uid_unique`(`product_id`)  
  
  ⇂ create table `customers` (`id` bigint unsigned not null auto_increment primary key, `customer_id` varchar(50) not null, `mobile_no` varchar(15) not null, `email_id` varchar(50) not null, `password` varchar(225) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' 

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
