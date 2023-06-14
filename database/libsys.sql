CREATE DATABASE libsys;

USE libsys;

CREATE TABLE users (
    id_no INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(60) NOT NULL,
    con_num INT(20) NOT NULL,
    firstname VARCHAR(60) NOT NULL,
    lastname VARCHAR(60) NOT NULL,
    password VARCHAR(60) NOT NULL,
    acctype ENUM("admin", "staff", "librarian", "student") NOT NULL,
    schlvl ENUM("Elementary", "Junior High School", "Senior High School", "College","Graduated") NOT NULL,
    status ENUM("Active", "Disabled") NOT NULL
);

INSERT INTO users(id_no,username,email,firstname,lastname,password,acctype,schlvl,status)
VALUES ('100001','admin','libsys_01@outlook.com','Admin','Administrator','admin01','admin','','Active'),
       ('100002','librarian','libsys_01@outlook.com','Librarian','Librarian LibMS','librarian01','librarian','','Active'),
       ('100003','staff','libsys_01@outlook.com','Staff','Staff LibMS','staff01','staff','','Active');

---TABLE FOR BOOKS---

CREATE TABLE books (
    book_id INT PRIMARY KEY AUTO_INCREMENT,
    section VARCHAR(50) NOT NULL,
    subject VARCHAR(50) NOT NULL,
    book_title VARCHAR(100) NOT NULL,
    volume VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    stocks INT NOT NULL,
    author VARCHAR(100) NOT NULL,
    isbn VARCHAR(100) NOT NULL,
    status ENUM("GOOD","DAMAGED","LOST","DILAPITATED") NOT NULL
);

CREATE TABLE ChatMessages (
    msg_id INT PRIMARY KEY AUTO_INCREMENT,
    sender VARCHAR(100) NOT NULL,
    id_no INT FOREIGN KEY NOT NULL,
    message TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
)