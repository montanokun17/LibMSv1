CREATE DATABASE LibSys;

USE LibSys;

-----------------Table for Users Accounts---------------

CREATE TABLE users (
  'id_no' INT PRIMARY KEY AUTO_INCREMENT,
  'username' VARCHAR(50) NOT NULL,
  'email' VARCHAR (50) NOT NULL,
  'firstname' VARCHAR(50) NOT NULL,
  'lastname' VARCHAR(50) NOT NULL,
  'password' VARCHAR(50) NOT NULL,
  'acctype' ENUM('admin', 'staff', 'librarian', 'student') NOT NULL,
  'schlvl' ENUM('Elementary', 'Junior High School', 'Senior High School', 'College', 'Graduated'),
  'status' ENUM('Active','Disabled') NOT NULL
);

--------------------------------------------------------

INSERT INTO 'users'('id_no','username','email','firstname','lastname','password','acctype','schlvl','status')
VALUES ('100001','admin','libsys_01@outlook.com','Admin','Administrator','admin01','admin','','Active'),
       ('100002','librarian','libsys_01@outlook.com','Librarian','Librarian LibMS','librarian01','librarian','','Active'),
       ('100003','staff','libsys_01@outlook.com','Staff','Staff LibMS','staff01','staff','','Active');

----------------------Table for books-------------------

CREATE TABLE books (
  'book_id' INT PRIMARY KEY AUTO_INCREMENT,
  'section' VARCHAR(50) NOT NULL,
  'subject' VARCHAR(50) NOT NULL,
  'book_title' VARCHAR(100) NOT NULL,
  'volume' VARCHAR(50) NOT NULL,
  'year' INT NOT NULL,
  'availability' INT NOT NULL,
  'author' VARCHAR(100) NOT NULL,
  'isbn' VARCHAR(50) NOT NULL,
  'status' ENUM('GOOD', 'DAMAGED', 'LOST', 'DILAPITATED') NOT NULL
);

---------------------------------------------------------

-------------------Table for message---------------------

CREATE TABLE message (
  'msg_id' INT PRIMARY KEY AUTO_INCREMENT,
  'sender' VARCHAR(50) NOT NULL,
  'id_no' INT NOT NULL,
  'msg' TEXT NOT NULL,
  'Date' DATE NOT NULL,
  'time' TIME NOT NULL
);

CREATE TABLE ChatMessages (
  'msg_id' INT PRIMARY KEY AUTO_INCREMENT,
  'sender' VARCHAR(100) NOT NULL,
  'message' TEXT NOT NULL,
  'timestamp' DATETIME DEFAULT CURRENT_TIMESTAMP
);

SELECT DATE_FORMAT(date_column, '%m-%d-%Y') AS formatted_date,
       DATE_FORMAT(time_column, '%H:%i:%s') AS formatted_time
FROM ChatMessages;

----------------------------------------------------------

---------------------Table for borrower--------------------

CREATE TABLE 'borrower' (
`borrower_id` int PRIMARY KEY AUTO_INCREMENT,
'lastname' VARCHAR(50) NOT NULL,
'firstname' VARCHAR(50) NOT NULL,
'username' VARCHAR(50) NOT NULL
);

----------------------------------------------------------

---------------------Table for borrow--------------------

CREATE TABLE `borrow` (
  `borrow_id` INT PRIMARY KEY AUTO_INCREMENT,
  `id_no` VARCHAR(255) NOT NULL,
  `book_id` INT NOT NULL,
  `date_of_issue` DATE NOVARCHAR
  `due_date` DATE NOT NULL,
  `date_of_return` DATE NOT NULL
);

----------------------------------------------------------

-------------------Table for renew------------------------

CREATE TABLE 'renew' (
  'borrow_id' INT NOT NULL,
  'borrower_id' INT NOT NULL,
  `book_id` INT NOT NULL,
  'username' VARCHAR NOT NULL,

);

----------------------------------------------------------

-----------------------LOGS TABLE-------------------------

CREATE TABLE 'logs' (
  'log_id' INT PRIMARY KEY AUTO_INCREMENT,
  'id_no' INT NOT NULL,
  'username' VARCHAR NOT NULL,
  'action_description' VARCHAR(255) NOT NULL,
  'timestamp' DATETIME DEFAULT CURRENT_TIMESTAMP
);

----------------------------------------------------------