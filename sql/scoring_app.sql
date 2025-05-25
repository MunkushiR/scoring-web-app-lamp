CREATE DATABASE IF NOT EXISTS scoring_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE scoring_app;

-- Judges Table
CREATE TABLE IF NOT EXISTS judges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    display_name VARCHAR(100) NOT NULL
);

-- Participants Table
CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Scores Table
CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judge_id INT NOT NULL,
    participant_id INT NOT NULL,
    points INT NOT NULL CHECK (points BETWEEN 1 AND 100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (judge_id) REFERENCES judges(id) ON DELETE CASCADE,
    FOREIGN KEY (participant_id) REFERENCES participants(id) ON DELETE CASCADE
);

-- Sample participants with normal names
INSERT INTO participants (name) VALUES 
('Ruth Munkushi'),
('Brian Watai'),
('Cate Mwangi'),
('John Kamau'),
('Mary Wanjiku');

