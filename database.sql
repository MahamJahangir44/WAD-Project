-- MoodMart Database Setup
-- Run this in phpMyAdmin or MySQL

CREATE DATABASE IF NOT EXISTS mooodmart;
USE mooodmart;

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PRODUCTS TABLE
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    mood VARCHAR(50),
    category VARCHAR(100),
    stock INT DEFAULT 10,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CART TABLE
CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- ORDERS TABLE
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    address TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ORDER ITEMS TABLE
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Default Admin User
-- IMPORTANT: After importing this file, go to your browser and open:
-- http://localhost/Project/create_admin.php
-- That page will create the admin with a properly hashed password
-- Then delete create_admin.php after running it once

-- Sample Products
INSERT INTO products (name, description, price, image, mood, category) VALUES

-- Happy
('Sunshine Candle Set', 'Bright citrus scented candles to keep the good vibes going', 1200.00, 'images/sunshinecandleset.jpeg', 'happy', 'Home Decor'),
('Happy Face Mug', 'Start your mornings with a smile — cheerful yellow ceramic mug', 850.00, 'images/happyfacemug.jpg', 'happy', 'Kitchen'),
('Party Snack Box', 'Assorted fun snacks for your happy moments', 1500.00, 'images/partysnackbox.jpg', 'happy', 'Food'),
('Colorful Journal', 'Write down your happiest thoughts in this vibrant journal', 600.00, 'images/colorfuljournal.jpg', 'happy', 'Stationery'),

-- Calm
('Lavender Bath Bomb Set', 'Unwind with these soothing lavender bath bombs', 950.00, 'images/lavenderbathbombset.webp.jpeg', 'calm', 'Bath & Body'),
('Herbal Green Tea', 'Premium loose-leaf green tea for peaceful evenings', 750.00, 'images/herbalgreentea.jpeg', 'calm', 'Beverages'),
('Meditation Cushion', 'Comfortable floor cushion for your mindfulness practice', 2200.00, 'images/meditationcushion.jpg', 'calm', 'Wellness'),
('White Noise Machine', 'Sleep better with soothing nature sounds', 3500.00, 'images/whitenoisemachine.jpeg', 'calm', 'Electronics'),

-- Sad
('Comfort Blanket', 'Super soft fleece blanket for cozy sad days', 1800.00, 'images/comfortblanket.jpg', 'sad', 'Home Decor'),
('Dark Chocolate Box', 'Premium dark chocolates to lift your spirits', 1100.00, 'images/darkchocolatebox.jpg', 'sad', 'Food'),
('Feel Better Tea', 'Chamomile and honey blend for tough days', 650.00, 'images/feelbettertea.jpg', 'sad', 'Beverages'),
('Cozy Slippers', 'Plush slippers that hug your feet like a warm hug', 1400.00, 'images/cozyslippers.jpeg', 'sad', 'Clothing'),

-- Energetic
('Energy Booster Bottle', 'BPA-free motivational water bottle with time markers', 1600.00, 'images/energyboosterbottle.jpg', 'energetic', 'Fitness'),
('Jump Rope Pro', 'High-speed jump rope for your intense workouts', 900.00, 'images/jumpropepro.jpg', 'energetic', 'Fitness'),
('Protein Snack Pack', 'High-protein snacks to fuel your energy', 1300.00, 'images/proteinsnackpack.jpg', 'energetic', 'Food'),
('Sports Headband', 'Keep the sweat off with this performance headband', 450.00, 'images/sportsheadband.jpg', 'energetic', 'Fitness'),

-- Stressed
('Stress Relief Ball', 'Squeeze away the tension with this satisfying stress ball', 350.00, 'images/stressreliefball.jpg', 'stressed', 'Wellness'),
('Aromatherapy Diffuser', 'Fill your room with calming essential oil mist', 2800.00, 'images/aromatherapydiffuser.jpg', 'stressed', 'Wellness'),
('Adult Coloring Book', 'Mindful coloring to de-stress and relax your mind', 700.00, 'images/adultcoloringbook.jpg', 'stressed', 'Stationery'),
('Lavender Scented Candle', 'Lavender scented candle designed to reduce stress and create a calming environment', 3500.00, 'images/lavenderscentedcandle.jpg', 'stressed', 'Relaxation'),

-- Adventurous
('Travel Journal', 'Leather-bound journal to document your adventures', 1100.00, 'images/traveljournal.jpg', 'adventurous', 'Travel'),
('Compact Backpack', 'Foldable 20L backpack for spontaneous adventures', 2500.00, 'images/compactbackpack.jpg', 'adventurous', 'Travel'),
('Polaroid Camera', 'Capture adventure moments instantly', 6500.00, 'images/polaroidcamera.jpeg', 'adventurous', 'Electronics'),
('Trail Mix Pack', 'Energy-packed trail mix for your outdoor adventures', 800.00, 'images/trailmixpack.jpg', 'adventurous', 'Food'),

-- Focused
('Study Planner 2026', 'Daily planner to organize your goals and tasks', 750.00, 'images/studyplanner2026.jpg', 'focused', 'Stationery'),
('Blue Light Glasses', 'Protect your eyes during long study sessions', 1900.00, 'images/bluelightglasses.jpg', 'focused', 'Accessories'),
('Noise Cancel Headphones', 'Block distractions with premium foam earplugs', 4000.00, 'images/noisecancelheadphones.jpg', 'focused', 'Accessories');