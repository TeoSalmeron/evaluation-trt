CREATE TABLE users (
    id VARCHAR(23) NOT NULL PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(150) NOT NULL,
    verified BOOL NOT NULL DEFAULT 0
);

CREATE TABLE recruiter (
    user_id VARCHAR(23) NOT NULL PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE candidate (
    user_id VARCHAR(23) NOT NULL PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    cv_path VARCHAR(250),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE consulting (
    user_id VARCHAR(23) NOT NULL PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE administrator (
    user_id VARCHAR(23) NOT NULL PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE advertisement (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    posted_by VARCHAR(23) NOT NULL,
    verified_by VARCHAR(23) NULL,
    FOREIGN KEY (posted_by) REFERENCES recruiter(user_id),
    FOREIGN KEY (verified_by) REFERENCES consulting(user_id)
);

CREATE TABLE application (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    candidate_id VARCHAR(23) NOT NULL,
    advertisement_id INT NOT NULL,
    verified_by VARCHAR(23) NULL,
    FOREIGN KEY (candidate_id) REFERENCES candidate(user_id),
    FOREIGN KEY (advertisement_id) REFERENCES advertisement(id),
    FOREIGN KEY (verified_by) REFERENCES consulting(user_id)
);