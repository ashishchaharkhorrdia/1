-- Create database
CREATE DATABASE ashishchahar;

-- Use the created database
USE ashishchahar;

-- Create a table for storing users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE DATABASE ashishchahar;

USE ashishchahar;

CREATE TABLE signup IF NOT EXISTE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    UNIQUE(username),
    UNIQUE(email)
);
