-- =============================================
-- 1. ENUM TYPES & SETUP
-- =============================================

CREATE TYPE ticket_status_type AS ENUM ('Open', 'In Progress', 'Resolved', 'Closed');
CREATE TYPE inventory_item_type AS ENUM ('Indoor', 'Outdoor');
CREATE TYPE invoice_status_type AS ENUM ('Proforma', 'Finalized');
CREATE TYPE order_status_type AS ENUM ('Pending', 'Confirmed', 'Technician Assigned', 'In Progress', 'Completed', 'Cancelled');
CREATE TYPE audit_action_type AS ENUM ('Clock-In Verified', 'Clock-Out Verified', 'Clock-In Rejected', 'Clock-Out Rejected');
CREATE TYPE forum_status_type AS ENUM ('Open', 'Closed');
CREATE TYPE adjustment_status_type AS ENUM ('Pending', 'Approved', 'Rejected');

-- =============================================
-- 2. USER MANAGEMENT (IAM)
-- =============================================

CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    role_name VARCHAR(50) UNIQUE NOT NULL,
    role_color VARCHAR(7) NOT NULL, -- Hex code
    role_description TEXT
);

INSERT INTO roles (role_name, role_color, role_description) VALUES
('Admin', '#FF0000', 'Administrator with full access to the system.'),
('User', '#7614b8', 'Regular user with standard access rights.'),
('Technician', '#00FF00', 'Technician responsible for service and maintenance.'),
('Staff', '#45a4cd', 'Staff whose role on the site just to clock in/out.');

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    fullname VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    profile_picture VARCHAR(255),
    password_hash VARCHAR(255) NOT NULL,
    role_id INT REFERENCES roles(id),
    is_active BOOLEAN DEFAULT TRUE,
    technician_rating_avg DECIMAL(2,1) DEFAULT 0.0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users_addresses (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    street VARCHAR(255) NOT NULL,
    sub_district VARCHAR(100) NOT NULL, -- Kelurahan
    district VARCHAR(100) NOT NULL, -- Kecamatan
    city VARCHAR(100) NOT NULL, -- Kota/Kabupaten
    province VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    latitude DECIMAL(9,6),
    longitude DECIMAL(9,6),
    is_primary BOOLEAN DEFAULT FALSE
);

CREATE TABLE user_room (
    id SERIAL PRIMARY KEY,
    address_id INT REFERENCES users_addresses(id) ON DELETE CASCADE,
    room_name VARCHAR(100) NOT NULL,
    room_subtitle VARCHAR(150)
);

CREATE TABLE user_notifications (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    notification_title VARCHAR(100) NOT NULL,
    notification_message TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    is_pushed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- 3. PRODUCT CATALOG (MASTER DATA)
-- =============================================

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    category_name VARCHAR(100) UNIQUE NOT NULL,
    category_description TEXT,
    icon VARCHAR(100) NOT NULL
);

INSERT INTO categories (category_name, category_description, icon) VALUES
('Accessories', 'Various accessories for air conditioning systems.', 'accessories_icon.png'),
('Central AC', 'Central air conditioning systems for large buildings.', 'central_ac_icon.png'),
('Inverter AC', 'Energy-efficient inverter air conditioning units.', 'inverter_ac_icon.png'),
('Non-Inverter AC', 'Standard non-inverter air conditioning units.', 'non_inverter_ac_icon.png'),
('Portable AC', 'Portable air conditioning units.', 'portable_ac_icon.png'),
('Split AC', 'Split air conditioning systems.', 'split_ac_icon.png'),
('Window AC', 'Window air conditioning units.', 'window_ac_icon.png');

CREATE TABLE types (
    id SERIAL PRIMARY KEY,
    type_name VARCHAR(100) UNIQUE NOT NULL,
    type_description TEXT,
    icon VARCHAR(100) NOT NULL
);

INSERT INTO types (type_name, type_description, icon) VALUES
('Wall Mounted Split', 'Wall-mounted split AC.', 'wall_mounted_split_icon.png'),
('Cassette', 'Cassette AC system.', 'cassette_icon.png'),
('Floor Standing Split', 'Floor-standing split AC.', 'floor_standing_split_icon.png'),
('Ceiling Suspended', 'Ceiling suspended AC.', 'ceiling_suspended_icon.png'),
('Ceiling Duct', 'Ceiling duct AC.', 'ceiling_duct_icon.png'),
('VRF/VRV', 'Variable refrigerant flow/volume.', 'vrf_vrv_icon.png'),
('Produk Lainnya', 'Other types.', 'other_products_icon.png');

CREATE TABLE brands (
    id SERIAL PRIMARY KEY,
    brand_name VARCHAR(100) UNIQUE NOT NULL,
    brand_description TEXT,
    logo VARCHAR(100) NOT NULL
);

INSERT INTO brands (brand_name, brand_description, logo) VALUES
('Daikin', 'Daikin AC.', 'daikin_logo.png'),
('LG', 'LG AC.', 'lg_logo.png'),
('Samsung', 'Samsung AC.', 'samsung_logo.png'),
('Sharp', 'Sharp AC.', 'sharp_logo.png'),
('Polytron', 'Polytron AC.', 'polytron_logo.png'),
('Aqua', 'Aqua AC.', 'aqua_logo.png'),
('FLIFE', 'FLIFE AC.', 'flife_logo.png'),
('Changhong', 'Changhong AC.', 'changhong_logo.png'),
('York', 'York AC.', 'york_logo.png'),
('Toshiba', 'Toshiba AC.', 'toshiba_logo.png'),
('Panasonic', 'Panasonic AC.', 'panasonic_logo.png'),
('Mitsubishi Electric', 'Mitsubishi AC.', 'mitsubishi_electric_logo.png'),
('Carrier', 'Carrier AC.', 'carrier_logo.png'),
('Midea', 'Midea AC.', 'midea_logo.png'),
('Gree', 'Gree AC.', 'gree_logo.png');

CREATE TABLE pk_categories (
    id SERIAL PRIMARY KEY,
    pk_category_name VARCHAR(100) UNIQUE NOT NULL,
    pk_category_description TEXT,
    icon VARCHAR(100) NOT NULL
);

INSERT INTO pk_categories (pk_category_name, pk_category_description, icon) VALUES
('1/2 PK', '0.5 PK', 'half_pk_icon.png'),
('3/4 PK', '0.75 PK', 'three_quarter_pk_icon.png'),
('1 PK', '1 PK', 'one_pk_icon.png'),
('1.5 PK', '1.5 PK', 'one_and_half_pk_icon.png'),
('2 PK', '2 PK', 'two_pk_icon.png'),
('2.5 PK', '2.5 PK', 'two_and_half_pk_icon.png'),
('3 PK', '3 PK', 'three_pk_icon.png'),
('4 PK', '4 PK', 'four_pk_icon.png'),
('5 PK', '5 PK', 'five_pk_icon.png'),
('6 PK', '6 PK', 'six_pk_icon.png'),
('8 PK', '8 PK', 'eight_pk_icon.png'),
('10 PK', '10 PK', 'ten_pk_icon.png'),
('12 PK', '12 PK', 'twelve_pk_icon.png'),
('15 PK', '15 PK', 'fifteen_pk_icon.png'),
('20 PK', '20 PK', 'twenty_pk_icon.png');

CREATE TABLE services (
    id SERIAL PRIMARY KEY,
    service_title VARCHAR(100) NOT NULL,
    service_description TEXT,
    base_price DECIMAL(10,2) NOT NULL
);

INSERT INTO services (service_title, service_description, base_price) VALUES
('Installation', 'Professional installation service.', 50000.00),
('Maintenance', 'Regular maintenance service.', 30000.00),
('Repair', 'Comprehensive repair service.', 75000.00);

CREATE TABLE service_prices (
    id SERIAL PRIMARY KEY,
    service_id INT REFERENCES services(id) ON DELETE CASCADE,
    type_id INT REFERENCES types(id) ON DELETE CASCADE,
    is_per_pk BOOLEAN DEFAULT FALSE,
    price DECIMAL(10,2) NOT NULL
);

INSERT INTO service_prices (service_id, type_id, is_per_pk, price) VALUES
(1, 1, TRUE, 100000.00),
(1, 2, TRUE, 150000.00),
(2, 1, FALSE, 50000.00),
(2, 2, FALSE, 80000.00),
(3, 1, FALSE, 200000.00),
(3, 2, FALSE, 250000.00);

CREATE TABLE addons (
    id SERIAL PRIMARY KEY,
    addon_name VARCHAR(100) NOT NULL,
    addon_description TEXT,
    addon_price DECIMAL(10,2) NOT NULL
);

INSERT INTO addons (addon_name, addon_description, addon_price) VALUES
('Apartment Installation', 'Special installation for apartments.', 75000.00),
('Old Unit Removal', 'Removal of old units.', 50000.00);

CREATE TABLE pipes (
    id SERIAL PRIMARY KEY,
    pipe_type VARCHAR(100) NOT NULL,
    pipe_description TEXT,
    price_per_meter DECIMAL(10,2) NOT NULL
);

INSERT INTO pipes (pipe_type, pipe_description, price_per_meter) VALUES
('Copper', 'High-quality copper pipes.', 20000.00),
('PVC', 'Durable PVC pipes.', 10000.00);

-- =============================================
-- 4. PRODUCTS & INVENTORY
-- =============================================

CREATE TABLE products (
    id SERIAL PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    product_description TEXT,
    slug VARCHAR(150) UNIQUE NOT NULL,
    base_price DECIMAL(10,2) NOT NULL,
    sale_price DECIMAL(10,2),
    category_id INT REFERENCES categories(id),
    type_id INT REFERENCES types(id),
    brand_id INT REFERENCES brands(id),
    pk_category_id INT REFERENCES pk_categories(id),
    main_image VARCHAR(255) NOT NULL,
    additional_images TEXT[], -- PostgreSQL Array
    extra_attributes JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE inventory (
    id SERIAL PRIMARY KEY,
    product_id INT REFERENCES products(id) ON DELETE CASCADE,
    item_type inventory_item_type,
    item_serial_number VARCHAR(100) UNIQUE NOT NULL,
    item_barcode VARCHAR(100) UNIQUE NOT NULL,
    item_notes TEXT,
    bound_to_user_id INT REFERENCES users(id) ON DELETE SET NULL,
    bound_to_user_address_id INT REFERENCES users_addresses(id) ON DELETE SET NULL
);

CREATE TABLE inventory_logs (
    id SERIAL PRIMARY KEY,
    inventory_id INT REFERENCES inventory(id) ON DELETE CASCADE,
    action_title VARCHAR(100) NOT NULL,
    action_description TEXT,
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    action_actor INT REFERENCES users(id)
);

CREATE TABLE product_ratings (
    id SERIAL PRIMARY KEY,
    product_id INT REFERENCES products(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE SET NULL,
    rating_score INT CHECK (rating_score >= 1 AND rating_score <= 5),
    rating_comments TEXT,
    price_at_purchase DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- 5. ORDERS & CART
-- =============================================

CREATE TABLE user_cart (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    faktur_requested BOOLEAN DEFAULT FALSE,
    scheduled_datetime TIMESTAMP
);

CREATE TABLE user_cart_items (
    id SERIAL PRIMARY KEY,
    cart_id INT REFERENCES user_cart(id) ON DELETE CASCADE,
    product_id INT REFERENCES products(id) ON DELETE SET NULL,
    service_id INT REFERENCES services(id) ON DELETE SET NULL,
    quantity INT NOT NULL
);

CREATE TABLE user_cart_item_addons (
    id SERIAL PRIMARY KEY,
    cart_item_id INT REFERENCES user_cart_items(id) ON DELETE CASCADE,
    pipe_id INT REFERENCES pipes(id) ON DELETE SET NULL,
    addon_id INT REFERENCES addons(id) ON DELETE SET NULL,
    extra_data_json JSONB,
    quantity INT NOT NULL
);

CREATE TABLE location_managers (
    id SERIAL PRIMARY KEY,
    manager_location_name VARCHAR(100) NOT NULL,
    manager_name VARCHAR(100) NOT NULL,
    manager_email VARCHAR(100) UNIQUE NOT NULL,
    manager_phone VARCHAR(20),
    kelurahan VARCHAR(100) NOT NULL,
    kecamatan VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    street VARCHAR(255) NOT NULL,
    qr_code VARCHAR(255) NOT NULL,
    latitude DECIMAL(9,6),
    longitude DECIMAL(9,6)
);

CREATE TABLE orders (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE SET NULL,
    payment_proof_url VARCHAR(255),
    require_technician BOOLEAN DEFAULT FALSE,
    technician_scheduled_at TIMESTAMP,
    technician_user_id INT REFERENCES users(id) ON DELETE SET NULL,
    location_manager_id INT REFERENCES location_managers(id) ON DELETE SET NULL,
    sub_district_snapshot VARCHAR(100) NOT NULL,
    district_snapshot VARCHAR(100) NOT NULL,
    city_snapshot VARCHAR(100) NOT NULL,
    province_snapshot VARCHAR(100) NOT NULL,
    postal_code_snapshot VARCHAR(20) NOT NULL,
    street_snapshot VARCHAR(255) NOT NULL,
    total_amount_snapshot DECIMAL(10,2) NOT NULL,
    order_status order_status_type NOT NULL,
    faktur_requested BOOLEAN DEFAULT FALSE,
    invoice_status invoice_status_type NOT NULL DEFAULT 'Proforma',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id SERIAL PRIMARY KEY,
    order_id INT REFERENCES orders(id) ON DELETE CASCADE,
    product_id INT REFERENCES products(id) ON DELETE SET NULL,
    quantity INT NOT NULL,
    base_price_snapshot DECIMAL(10,2) NOT NULL,
    sale_price_snapshot DECIMAL(10,2)
);

CREATE TABLE order_items_addons (
    id SERIAL PRIMARY KEY,
    order_item_id INT REFERENCES order_items(id) ON DELETE CASCADE,
    service_id INT REFERENCES services(id),
    pipe_id INT REFERENCES pipes(id) ON DELETE SET NULL,
    addon_id INT REFERENCES addons(id) ON DELETE SET NULL,
    extra_data_json JSONB,
    quantity INT NOT NULL,
    price_snapshot DECIMAL(10,2) NOT NULL
);

-- =============================================
-- 6. OPERATIONS & FULFILLMENT
-- =============================================

CREATE TABLE order_tech_work (
    id SERIAL PRIMARY KEY,
    order_id INT REFERENCES orders(id) ON DELETE CASCADE,
    technician_actor_id INT REFERENCES users(id) ON DELETE SET NULL,
    clockin_timestamp TIMESTAMP NOT NULL,
    clockin_latitude DECIMAL(9,6) NOT NULL,
    clockin_longitude DECIMAL(9,6) NOT NULL,
    clockin_selfie_url VARCHAR(255) NOT NULL,
    clockout_timestamp TIMESTAMP,
    clockout_latitude DECIMAL(9,6),
    clockout_longitude DECIMAL(9,6),
    clockout_selfie_url VARCHAR(255),
    completion_notes TEXT,
    proof_of_completion_urls TEXT[]
);

CREATE TABLE order_tech_adjustment (
    id SERIAL PRIMARY KEY,
    order_id INT REFERENCES orders(id) ON DELETE CASCADE,
    technician_actor_id INT REFERENCES users(id) ON DELETE SET NULL,
    adjustment_title VARCHAR(100) NOT NULL,
    adjustment_description TEXT,
    adjustment_amount DECIMAL(10,2) NOT NULL,
    admin_actor_id INT REFERENCES users(id) ON DELETE SET NULL,
    adjustment_status adjustment_status_type NOT NULL DEFAULT 'Pending',
    is_admin_adjustment BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_discussion (
    id SERIAL PRIMARY KEY,
    order_id INT REFERENCES orders(id) ON DELETE CASCADE,
    actor_user_id INT REFERENCES users(id) ON DELETE SET NULL,
    message_text TEXT NOT NULL,
    is_system_message BOOLEAN DEFAULT FALSE,
    message_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_files (
    id SERIAL PRIMARY KEY,
    order_discussion_id INT REFERENCES order_discussion(id) ON DELETE CASCADE,
    file_urls VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_technician_ratings (
    id SERIAL PRIMARY KEY,
    order_id INT REFERENCES orders(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE SET NULL,
    technician_user_id INT REFERENCES users(id) ON DELETE SET NULL,
    rating_score INT CHECK (rating_score >= 1 AND rating_score <= 5),
    rating_comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- 7. SUPPORT & COMMUNITY (FORUM/TICKETS)
-- =============================================

CREATE TABLE user_tickets (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    ticket_title VARCHAR(100) NOT NULL,
    ticket_description TEXT,
    ticket_status ticket_status_type NOT NULL DEFAULT 'Open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_ticket_responses (
    id SERIAL PRIMARY KEY,
    ticket_id INT REFERENCES user_tickets(id) ON DELETE CASCADE,
    responder_user_id INT REFERENCES users(id) ON DELETE SET NULL,
    response_message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE forum_flairs (
    id SERIAL PRIMARY KEY,
    flair_name VARCHAR(50) UNIQUE NOT NULL,
    flair_color VARCHAR(7) NOT NULL,
    flair_description TEXT
);

INSERT INTO forum_flairs (flair_name, flair_color, flair_description) VALUES
('Announcement', '#FF5733', 'Official announcements.'),
('Question', '#33C1FF', 'Questions from users.'),
('Discussion', '#75FF33', 'General discussions.'),
('Feedback', '#FF33A8', 'User feedback.'),
('Off-Topic', '#8E33FF', 'Casual conversations.');

CREATE TABLE forum (
    id SERIAL PRIMARY KEY,
    thread_poster_id INT REFERENCES users(id) ON DELETE SET NULL,
    thread_title VARCHAR(150) NOT NULL,
    flair_id INT REFERENCES forum_flairs(id) ON DELETE SET NULL,
    status forum_status_type NOT NULL DEFAULT 'Open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE forum_posts (
    id SERIAL PRIMARY KEY,
    thread_id INT REFERENCES forum(id) ON DELETE CASCADE,
    post_author_id INT REFERENCES users(id) ON DELETE SET NULL,
    post_content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE forum_post_files (
    id SERIAL PRIMARY KEY,
    forum_post_id INT REFERENCES forum_posts(id) ON DELETE CASCADE,
    file_urls VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE faqs_categories (
    id SERIAL PRIMARY KEY,
    category_name VARCHAR(100) UNIQUE NOT NULL,
    category_description TEXT
);

CREATE TABLE faqs (
    id SERIAL PRIMARY KEY,
    category_id INT REFERENCES faqs_categories(id) ON DELETE SET NULL,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE faqs_votes (
    id SERIAL PRIMARY KEY,
    faq_id INT REFERENCES faqs(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE SET NULL,
    is_helpful BOOLEAN NOT NULL,
    ip_address VARCHAR(45),
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- 8. SYSTEM, LOGS & STAFF ADMIN
-- =============================================

CREATE TABLE static_page_contents (
    id SERIAL PRIMARY KEY,
    page_name VARCHAR(100) UNIQUE NOT NULL,
    page_slug VARCHAR(150) UNIQUE NOT NULL,
    page_content TEXT NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE hvac_form_submissions (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    whatsapp_number VARCHAR(20),
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contact_us_form_submissions (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    whatsapp_number VARCHAR(20),
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE site_configurations (
    id SERIAL PRIMARY KEY,
    config_key VARCHAR(100) UNIQUE NOT NULL,
    config_value TEXT NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE staff_clock_logs (
    id SERIAL PRIMARY KEY,
    staff_user_id INT REFERENCES users(id) ON DELETE SET NULL,
    clockin_timestamp TIMESTAMP NOT NULL,
    clockin_latitude DECIMAL(9,6) NOT NULL,
    clockin_longitude DECIMAL(9,6) NOT NULL,
    clockin_selfie_url VARCHAR(255) NOT NULL,
    clockout_timestamp TIMESTAMP,
    clockout_latitude DECIMAL(9,6),
    clockout_longitude DECIMAL(9,6),
    clockout_selfie_url VARCHAR(255)
);

CREATE TABLE admin_clock_audit_staff (
    id SERIAL PRIMARY KEY,
    staff_clock_log_id INT REFERENCES staff_clock_logs(id) ON DELETE CASCADE,
    admin_actor_id INT REFERENCES users(id) ON DELETE SET NULL,
    audit_action audit_action_type NOT NULL,
    audit_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    audit_notes TEXT
);

CREATE TABLE admin_clock_audit_technician (
    id SERIAL PRIMARY KEY,
    tech_clock_log_id INT REFERENCES order_tech_work(id) ON DELETE CASCADE,
    admin_actor_id INT REFERENCES users(id) ON DELETE SET NULL,
    audit_action audit_action_type NOT NULL,
    audit_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    audit_notes TEXT
);

CREATE TABLE admin_dashboard_logs (
    id SERIAL PRIMARY KEY,
    admin_actor_id INT REFERENCES users(id) ON DELETE SET NULL,
    action_title VARCHAR(100) NOT NULL,
    action_description TEXT,
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin_dashboard_notifications (
    id SERIAL PRIMARY KEY,
    notification_title VARCHAR(100) NOT NULL,
    notification_message TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    is_pushed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE technician_dashboard_notifications (
    id SERIAL PRIMARY KEY,
    technician_user_id INT REFERENCES users(id) ON DELETE CASCADE,
    notification_title VARCHAR(100) NOT NULL,
    notification_message TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    is_pushed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);