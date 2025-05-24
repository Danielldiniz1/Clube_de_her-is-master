CREATE DATABASE hero_club;
USE hero_club;

-- Users: content creators, store owners, admins
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('creator', 'store', 'admin') DEFAULT 'creator',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Clubs: personalized subscription clubs
CREATE TABLE clubs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    club_name VARCHAR(100) NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Product categories (optional table)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

-- Products: collectibles sold or sent via subscription
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    club_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    category_id INT,
    fandom VARCHAR(100), -- e.g., Marvel, Star Wars
    rarity ENUM('common', 'rare', 'exclusive') DEFAULT 'common',
    sku VARCHAR(50) UNIQUE,
    is_physical BOOLEAN DEFAULT TRUE,
    subscription_only BOOLEAN DEFAULT FALSE,
    weight_grams INT,
    dimensions_cm VARCHAR(50), -- format: "10x20x5"
    image_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (club_id) REFERENCES clubs(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Coupons: discounts by code
CREATE TABLE coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    club_id INT NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL,
    discount_percent DECIMAL(5,2),
    discount_amount DECIMAL(10,2),
    valid_until DATETIME,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (club_id) REFERENCES clubs(id)
);

-- Subscriptions: user subscriptions to clubs
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    club_id INT NOT NULL,
    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'canceled', 'suspended') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (club_id) REFERENCES clubs(id)
);

-- Payments: records of subscription transactions
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subscription_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('paid', 'pending', 'failed') DEFAULT 'pending',
    payment_gateway VARCHAR(50), -- e.g., Stripe, PayPal
    FOREIGN KEY (subscription_id) REFERENCES subscriptions(id)
);

-- Reports: club-level data aggregation
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    club_id INT NOT NULL,
    generated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_subscribers INT,
    total_revenue DECIMAL(10,2),
    products_sold INT,
    FOREIGN KEY (club_id) REFERENCES clubs(id)
);

INSERT INTO users (name, email, password, role) 
VALUES ('João Silva', 'joao@exemplo.com', '$2y$10$abcdefghijklmnopqrstuv', 'creator');