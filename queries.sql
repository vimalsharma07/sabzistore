CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    mobile VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(255),
    gender ENUM('male', 'female', 'other'),
    status TINYINT(1) DEFAULT 0, -- 0 for inactive, 1 for active
    role ENUM('admin', 'vendor', 'user') DEFAULT 'user',
    password VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-incrementing ID as the primary key
    name VARCHAR(255) NOT NULL,        -- Name of the category, cannot be null
    description TEXT DEFAULT NULL,     -- Description, can be null
    status TINYINT(1) DEFAULT 0,       -- Status with a default value of 0 (0 or 1)
    slug VARCHAR(255) NOT NULL UNIQUE, -- Slug, must be unique
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Automatically set current timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Updates on row modification
);


CREATE TABLE subcategories (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-incrementing ID as the primary key
    category_id INT,
    name VARCHAR(255) NOT NULL,        -- Name of the category, cannot be null
    description TEXT DEFAULT NULL,     -- Description, can be null
    status TINYINT(1) DEFAULT 0,       -- Status with a default value of 0 (0 or 1)
    slug VARCHAR(255) NOT NULL UNIQUE, -- Slug, must be unique
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Automatically set current timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Updates on row modification
);


CREATE TABLE childcategories (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-incrementing ID as the primary key
    category_id INT,
    subcategory_id INT,
    name VARCHAR(255) NOT NULL,        -- Name of the category, cannot be null
    description TEXT DEFAULT NULL,     -- Description, can be null
    status TINYINT(1) DEFAULT 0,       -- Status with a default value of 0 (0 or 1)
    slug VARCHAR(255) NOT NULL UNIQUE, -- Slug, must be unique
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Automatically set current timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Updates on row modification
);



CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-incrementing ID as the primary key
    name VARCHAR(255) NOT NULL,        -- Name of the category, cannot be null
    description TEXT DEFAULT NULL,     -- Description, can be null
    status TINYINT(1) DEFAULT 0,       -- Status with a default value of 0 (0 or 1)
    slug VARCHAR(255) NOT NULL UNIQUE, -- Slug, must be unique
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Automatically set current timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Updates on row modification
);



CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,                -- Auto-incrementing ID
    name VARCHAR(255) NOT NULL,                       -- Product name, cannot be null
    category_id INT DEFAULT NULL,                     -- Reference to categories table
    subcategory_id INT DEFAULT NULL,                  -- Reference to subcategories (if applicable)
    childcategory_id INT DEFAULT NULL,                -- Reference to child categories (if applicable)
    description TEXT DEFAULT NULL,                    -- Description of the product
    meta_title VARCHAR(255) DEFAULT NULL,             -- SEO meta title
    meta_tags TEXT DEFAULT NULL,                      -- SEO meta tags
    meta_description TEXT DEFAULT NULL,               -- SEO meta description
    brand VARCHAR(255) DEFAULT NULL,                  -- Brand of the product
    tags TEXT DEFAULT NULL,                           -- Product tags
    health TEXT DEFAULT NULL,                         -- Health information
    status TINYINT(1) DEFAULT 0,                      -- Product status (0 = inactive, 1 = active)
    slug VARCHAR(255) NOT NULL UNIQUE,                -- Unique slug for the product
    image VARCHAR(255) NOT NULL,                      -- Main image for the product
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,   -- Timestamp for creation
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp for updates
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL -- Foreign key to categories
);
    ALTER TABLE `products` ADD `user_id` INT NULL DEFAULT NULL AFTER `id`;
    ALTER TABLE `products` ADD `attributes` TEXT NULL DEFAULT NULL AFTER `tags`;
    ALTER TABLE products AUTO_INCREMENT = 1;

ALTER TABLE `products` ADD `price` TEXT NULL DEFAULT NULL AFTER `description`;
ALTER TABLE `products` ADD `mrp` BIGINT NOT NULL DEFAULT '0' AFTER `price`;


CREATE TABLE product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,                -- Auto-incrementing ID
    product_id INT NOT NULL,                          -- Reference to products table
    image VARCHAR(255) DEFAULT NULL,                  -- Image path or URL
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,   -- Timestamp for creation
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp for updates
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE -- Foreign key to products
);


CREATE TABLE stores (
    id INT AUTO_INCREMENT PRIMARY KEY,                -- Auto-incrementing ID
    user_id INT NOT NULL,                             -- Reference to users table
    name VARCHAR(255) NOT NULL,                       -- Store name
    address TEXT NOT NULL,                            -- Store address
    latitude DECIMAL(10, 8) NOT NULL,                 -- Latitude of the store location
    longitude DECIMAL(11, 8) NOT NULL,                -- Longitude of the store location
    slug VARCHAR(255) DEFAULT NULL,                   -- Unique slug for the store
    status TINYINT(1) DEFAULT 0,                      -- Status (0 = inactive, 1 = active)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,   -- Timestamp for creation
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp for updates
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- Foreign key to users table
);


CREATE TABLE media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    logo VARCHAR(255) DEFAULT NULL,
    address VARCHAR(255) DEFAULT NULL,
    whatsapp VARCHAR(20) DEFAULT NULL,
    facebook VARCHAR(255) DEFAULT NULL,
    instagram VARCHAR(255) DEFAULT NULL,
    twitter VARCHAR(255) DEFAULT NULL,
    mobile VARCHAR(15) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,   
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
ALTER TABLE `media` ADD `linkedin` TEXT NULL DEFAULT NULL AFTER `twitter`;


CREATE TABLE coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) DEFAULT NULL,
    code VARCHAR(100) NOT NULL,
    slug VARCHAR(255) DEFAULT NULL,
    status TINYINT(1) DEFAULT 0,  -- 0 or 1 for active/inactive
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    type ENUM('p', 'r') NOT NULL,  -- 'p' for percentage, 'r' for fixed amount
    description TEXT DEFAULT NULL,
    brands VARCHAR(255) DEFAULT NULL,  -- Comma-separated list of brands
    products VARCHAR(255) DEFAULT NULL,  -- Comma-separated list of product IDs
    users VARCHAR(255) DEFAULT NULL,  -- Comma-separated list of user IDs
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
ALTER TABLE `coupons` ADD `value` BIGINT NOT NULL DEFAULT '0' AFTER `code`;
ALTER TABLE `coupons` ADD `min_value` BIGINT NOT NULL DEFAULT '0' AFTER `value`;



CREATE TABLE address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    houseno TEXT NOT NULL,
    appartment TEXT,
    lat DECIMAL(10, 8) DEFAULT NULL,
    lang DECIMAL(11, 8) DEFAULT NULL,
    landmark TEXT DEFAULT NULL,
    address TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    cart JSON NOT NULL,
    products JSON NOT NULL,
    order_products JSON NOT NULL,
    quantity INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    tip DECIMAL(10, 2) DEFAULT 0.00,
    delivery_fee DECIMAL(10, 2) DEFAULT 0.00,
    discounted_delivery_fee DECIMAL(10, 2) DEFAULT 0.00,
    handling_fee DECIMAL(10, 2) DEFAULT 0.00,
    discounted_handling_fee DECIMAL(10, 2) DEFAULT 0.00,
    small_cart_fee DECIMAL(10, 2) DEFAULT 0.00,
    discounted_small_cart_fee DECIMAL(10, 2) DEFAULT 0.00,
    savings DECIMAL(10, 2) DEFAULT 0.00,
    coupon VARCHAR(100) DEFAULT NULL,
    coupon_discounted DECIMAL(10, 2) DEFAULT 0.00,
    grand_total DECIMAL(10, 2) NOT NULL,
    total_pay DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


ALTER TABLE `address` ADD `default` INT NOT NULL DEFAULT '0' AFTER `address`;
ALTER TABLE `orders` ADD `order_number` TEXT NOT NULL AFTER `id`;
ALTER TABLE `orders` ADD `order_status` VARCHAR(200) NOT NULL DEFAULT 'pending' AFTER `total_pay`;
ALTER TABLE `users` ADD `photo` VARCHAR(200) NULL DEFAULT NULL AFTER `role`;
ALTER TABLE `products` 
ADD `popular` TINYINT(1) DEFAULT 0 AFTER `status`, 
ADD `trending` TINYINT(1) DEFAULT 0 AFTER `popular`;
ALTER TABLE `products` ADD `attributes_mrp` TEXT NULL DEFAULT NULL AFTER `attributes`;

CREATE TABLE stories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    type ENUM('video', 'image') NOT NULL,
    priority INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1,  -- 1 for active, 0 for inactive
    files TEXT NOT NULL,          -- To store file paths or URLs
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



