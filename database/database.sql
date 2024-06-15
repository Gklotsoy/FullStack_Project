CREATE DATABASE forum_lab;


CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(254) NOT NULL,
    email VARCHAR(254),
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    password VARCHAR(100) NOT NULL,
    UNIQUE (username),
    PRIMARY KEY(id)
);

CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(254) NOT NULL,
    content TEXT NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE threads (
    id INT NOT NULL AUTO_INCREMENT,
    content TEXT NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE user_posts (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id)
    ON DELETE CASCADE,
    PRIMARY KEY(id)
);

CREATE TABLE user_threads (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    thread_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE,
    FOREIGN KEY (thread_id) REFERENCES threads(id)
    ON DELETE CASCADE,
    PRIMARY KEY(id)
);

CREATE TABLE post_threads (
    id INT NOT NULL AUTO_INCREMENT,
    post_id INT NOT NULL,
    thread_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id)
    ON DELETE CASCADE,
    FOREIGN KEY (thread_id) REFERENCES threads(id)
    ON DELETE CASCADE,
    PRIMARY KEY(id)
);

INSERT INTO users (username, password, email, role)
VALUES 
('admin', 'admin1234', 'admin@admin.com', 'admin');


INSERT INTO users (username, password, email, role)
VALUES 
('user', 'user1234', 'user1234@user.com', 'user');