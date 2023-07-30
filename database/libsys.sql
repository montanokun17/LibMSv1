CREATE DATABASE libsys;

USE libsys;

CREATE TABLE users (
    id_no INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(60) NOT NULL,
    con_num VARCHAR(20) NOT NULL,
    firstname VARCHAR(60) NOT NULL,
    lastname VARCHAR(60) NOT NULL,
    password VARCHAR(60) NOT NULL,
    acctype ENUM("admin", "librarian", "student", "guest") NOT NULL,
    schlvl ENUM("Elementary", "Junior High School", "Senior High School", "College","Graduated","Guest") NOT NULL,
    brgy ENUM("Bagong Ilog","Bagong Katipunan","Bambang","Buting","Caniogan","Dela Paz","Kalawaan","Kapasigan","Kapitolyo"
    ,"Malinao","Manggahan","Maybunga","Orando","Palatiw","Pinagbuhatan","Pineda","Rosario","Sagad","San Antonio","San Joaquin",
    "San Jose","San Miguel","San Nicolas","Santa Cruz","Santa Lucia","Santa Rosa","Santo Tomas","Santolan","Sumilang","Ugong") NOT NULL,
    status ENUM("Active", "Disabled") NOT NULL,
    token_pin INT NOT NULL,
    pin_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users(id_no,username,email,con_num,firstname,lastname,password,acctype,schlvl,brgy, status)
VALUES ('100001','admin','mylibrolibrarymanagementsystem@gmail.com','09154985773','MyLibro','Administrator','admin01','admin','','','Active'),
       ('100002','librarian','','09154985773','Librarian','Librarian LibMS','librarian01','librarian','','','Active');


CREATE TABLE id_card (
    id_no INT PRIMARY KEY,
    picture BLOB, -- BLOB data type can be used to store binary data like images
    qr BLOB
);

CREATE TABLE qr_table (
    id_no INT PRIMARY KEY,
    qr_code BLOB
);
    
INSERT INTO qr_table(id_no, qr_code)
VALUES ('100001','\LibMSv1\users\admin\qrbin\admin.png'),
       ('100002','\LibMSv1\users\admin\qrbin\librarian.png');

/*

ALTER TABLE id_card
    ADD FOREIGN KEY (id_no) REFERENCES users (id_no);


ALTER TABLE qr_table
    ADD FOREIGN KEY (id_no) REFERENCES users (id_no);

*/




-------------------TABLE-FOR-BOOKS-----------------------

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

CREATE TABLE borrower (
    borrower_id INT PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL
);

CREATE TABLE book_borrow_records (
    record_id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT NOT NULL,
    borrower_name VARCHAR(100) NOT NULL,
    borrowing_date DATE NOT NULL,
    return_date DATE,
    is_lost BOOL NOT NULL DEFAULT 0,
    is_damaged BOOL NOT NULL DEFAULT 0,
    is_never_returned BOOL NOT NULL DEFAULT 0,
    borrowing_brgy VARCHAR(50),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

CREATE TABLE borrow (
    borrow_id INT PRIMARY KEY AUTO_INCREMENT,
    id_no INT NOT NULL,
    book_id INT NOT NULL,
    date_of_issue DATE NOT NULL,
    due_date DATE NOT NULL,
    date_of_return DATE NOT NULL,
);

CREATE TABLE renew (
    borrow_id INT NOT NULL,
    borrower_id INT NOT NULL,
    book_id INT NOT NULL,
    book_title VARCHAR NOT NULL,
    username INT NOT NULL,
);


/*

SELECT book_id, COUNT(*) AS borrow_count
FROM book_borrow_records
GROUP BY book_id
ORDER BY borrow_count DESC
LIMIT 10; -- You can adjust the LIMIT to get more or fewer results


SELECT borrowing_brgy, COUNT(*) AS borrow_count
FROM book_borrow_records
GROUP BY borrowing_brgy
ORDER BY borrow_count DESC
LIMIT 1; -- This will give you the barangay with the most borrowings, you can change the LIMIT if you need more results

*/

-------------------------MESSAGES-------------------------

CREATE TABLE ChatMessages (
    msg_id INT PRIMARY KEY AUTO_INCREMENT,
    sender VARCHAR(100) NOT NULL,
    id_no INT FOREIGN KEY NOT NULL,
    message TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
)

/*

CREATE TABLE logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    id_no INT NOT NULL,
    username VARCHAR NOT NULL,
    action_description VARCHAR(255) NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE phpmailer_pins (
    pin_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(60) NOT NULL,
    token_pin INT NOT NULL,
    pin_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

*?