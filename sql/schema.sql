CREATE DATABASE IF NOT EXISTS festus_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE festus_portfolio;

-- Site configuration
CREATE TABLE site_config (
    id INT PRIMARY KEY AUTO_INCREMENT,
    site_title VARCHAR(200) NOT NULL DEFAULT 'Prof. Festus Uwakhemen Asikhia',
    site_subtitle TEXT,
    favicon VARCHAR(255),
    logo_text VARCHAR(100),
    contact_email VARCHAR(100),
    contact_phone VARCHAR(50),
    contact_address TEXT,
    social_facebook VARCHAR(255),
    social_twitter VARCHAR(255),
    social_linkedin VARCHAR(255),
    social_instagram VARCHAR(255),
    footer_text TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Hero section
CREATE TABLE hero_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    greeting VARCHAR(100) DEFAULT 'Welcome',
    name_title VARCHAR(200) DEFAULT 'Prof. Festus Uwakhemen Asikhia',
    roles TEXT DEFAULT '["Academic","Real Estate Developer","Politician","Entrepreneur"]',
    description TEXT,
    cta_text VARCHAR(100) DEFAULT 'Explore My Journey',
    cta_link VARCHAR(255) DEFAULT '#about',
    background_image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE
);

-- About section
CREATE TABLE about_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) DEFAULT 'About Me',
    biography TEXT,
    image VARCHAR(255),
    years_experience INT DEFAULT 30,
    projects_completed INT DEFAULT 150,
    awards_won INT DEFAULT 25,
    books_published INT DEFAULT 12,
    quote_text TEXT,
    quote_author VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE
);

-- Academic history
CREATE TABLE academics (
    id INT PRIMARY KEY AUTO_INCREMENT,
    degree VARCHAR(200) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    field VARCHAR(200),
    year_from YEAR,
    year_to YEAR,
    description TEXT,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Books
CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    description TEXT,
    isbn VARCHAR(50),
    cover_image VARCHAR(255),
    publication_year YEAR,
    publisher VARCHAR(255),
    pages INT,
    category VARCHAR(100),
    amazon_link VARCHAR(255),
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Awards
CREATE TABLE awards (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(255) NOT NULL,
    year YEAR,
    description TEXT,
    icon VARCHAR(50) DEFAULT 'fa-trophy',
    category ENUM('academic','professional','political','community','business') DEFAULT 'professional',
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Certificates
CREATE TABLE certificates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    year YEAR,
    description TEXT,
    certificate_image VARCHAR(255),
    credential_url VARCHAR(255),
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Real estate properties
CREATE TABLE real_estate (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    company_name VARCHAR(255) DEFAULT 'Festus Asikhia Realty',
    location VARCHAR(255),
    property_type VARCHAR(100),
    description TEXT,
    image VARCHAR(255),
    status VARCHAR(50) DEFAULT 'completed',
    completion_year YEAR,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Political career
CREATE TABLE political_career (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    party VARCHAR(100),
    location VARCHAR(255),
    year_from YEAR,
    year_to YEAR,
    description TEXT,
    icon VARCHAR(50) DEFAULT 'fa-landmark',
    achievements TEXT,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Business ventures
CREATE TABLE businesses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    industry VARCHAR(100),
    role VARCHAR(200),
    description TEXT,
    logo VARCHAR(255),
    website VARCHAR(255),
    year_established YEAR,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Timeline
CREATE TABLE timeline (
    id INT PRIMARY KEY AUTO_INCREMENT,
    year YEAR NOT NULL,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    description TEXT,
    category ENUM('academic','career','political','business','personal') DEFAULT 'career',
    icon VARCHAR(50) DEFAULT 'fa-star',
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Testimonials
CREATE TABLE testimonials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    title VARCHAR(200),
    organization VARCHAR(255),
    testimonial TEXT NOT NULL,
    image VARCHAR(255),
    rating INT DEFAULT 5,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE
);

-- Contact messages
CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    phone VARCHAR(50),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data

INSERT INTO site_config (site_title, site_subtitle, logo_text, contact_email, contact_phone, contact_address, footer_text)
VALUES (
    'Prof. Festus Uwakhemen Asikhia',
    'Academic | Real Estate Developer | Politician | Entrepreneur',
    'Prof. Festus A.',
    'contact@professorfestusasikhia.com',
    '+234 XXX XXX XXXX',
    'Nigeria',
    '© 2026 Prof. Festus Uwakhemen Asikhia. All Rights Reserved.'
);

INSERT INTO hero_section (greeting, name_title, description, cta_text, cta_link)
VALUES (
    'Welcome to the World of',
    'Prof. Festus Uwakhemen Asikhia',
    'A distinguished academic, visionary real estate developer, seasoned politician, and serial entrepreneur committed to excellence, leadership, and transformative impact across multiple sectors.',
    'Explore My Journey',
    '#about'
);

INSERT INTO about_section (title, years_experience, projects_completed, awards_won, books_published, quote_text, quote_author)
VALUES (
    'The Man Behind the Legacy',
    30, 150, 25, 12,
    'Excellence is not a destination; it is a continuous journey of growth, impact, and unwavering commitment to positive change.',
    'Prof. Festus Uwakhemen Asikhia'
);

INSERT INTO testimonials (name, title, organization, testimonial, rating)
VALUES
('Dr. Adeyemi Ola', 'Vice Chancellor', 'University of Lagos', 'Prof. Festus Asikhia is a rare gem in academia. His dedication to research and mentorship has shaped countless careers.', 5),
('Chief Emeka Nwosu', 'Managing Director', 'Nigerian Investment Group', 'Working with Prof. Asikhia on real estate projects has been exceptional. His vision and integrity set him apart.', 5),
('Hon. Sarah Bello', 'Senator', 'National Assembly', 'Prof. Asikhia brings the same rigor and excellence to politics that he brought to academia. A true leader.', 5);
