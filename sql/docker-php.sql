
-- -------------------------------------------------------------
-- Database: docker-php
-- -------------------------------------------------------------

CREATE TABLE posts (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE images (
id INT AUTO_INCREMENT PRIMARY KEY,
post_id INT,
file_path VARCHAR(255) NOT NULL,
alt_text VARCHAR(255),
FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE videos (
id INT AUTO_INCREMENT PRIMARY KEY,
post_id INT,
file_path VARCHAR(255) NOT NULL,
FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE weblinks (
id INT AUTO_INCREMENT PRIMARY KEY,
post_id INT,
url VARCHAR(255) NOT NULL,
title VARCHAR(255) NOT NULL,
FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

-- Insert a new post
INSERT INTO posts (title, content) VALUES ('My First Post', 'This is the content of my first post.');

-- Get the last inserted post id
SET @post_id = LAST_INSERT_ID();

-- Insert associated images
INSERT INTO images (post_id, file_path, alt_text) VALUES (@post_id, 'images/photo1.jpg', 'Photo 1');
INSERT INTO images (post_id, file_path, alt_text) VALUES (@post_id, 'images/photo2.jpg', 'Photo 2');

-- Insert associated videos
INSERT INTO videos (post_id, file_path) VALUES (@post_id, 'videos/video1.mp4');

-- Insert associated weblinks
INSERT INTO weblinks (post_id, url, title) VALUES (@post_id, 'https://example.com', 'Example Website');

