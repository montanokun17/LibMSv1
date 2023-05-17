CREATE DATABASE LibSys;

USE LibSys;

-----------------Table for Users Accounts---------------

CREATE TABLE users (
  'id_no' INT PRIMARY KEY AUTO_INCREMENT,
  'username' VARCHAR(50) NOT NULL,
  'firstname' VARCHAR(50) NOT NULL,
  'lastname' VARCHAR(50) NOT NULL,
  'password' VARCHAR(50) NOT NULL,
  'acctype' ENUM('admin', 'staff', 'librarian', 'student') NOT NULL,
  'schlvl' ENUM('Elementary', 'Junior High School', 'Senior High School', 'College', 'Graduated') NOT NULL
  'status' ENUM('Active','Disabled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

---------------------------------------------------------

-------------------Table for message---------------------

CREATE TABLE message (
  'msg_id' INT PRIMARY KEY AUTO_INCREMENT,
  'sender' VARCHAR(50) NOT NULL,
  'id_no' INT NOT NULL,
  'msg' TEXT NOT NULL,
  'Date' Date DATE NOT NULL,
  'Time' Time TIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

----------------------------------------------------------

---------------------Table for records--------------------

CREATE TABLE `issue` (
  `record_id` int(11) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `book_id` int(255) NOT NULL,
  `date_of_issue` date NOT NULL,
  `due_date` date NOT NULL,
  `date_of_return` date NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

----------------------------------------------------------

-------------------Table for renew------------------------

CREATE TABLE 'renew' (
  'id_no' INT NOT NULL,
  `book_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

----------------------------------------------------------