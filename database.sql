CREATE TABLE IF NOT EXISTS users(
    ID BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    age tinyint(3) UNSIGNED NOT NULL,
    country VARCHAR(255) NOT NULL,
    social_media_url VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(ID),
    UNIQUE KEY (email)
);

CREATE TABLE IF NOT EXISTS transactions(
    ID BIGINT(20) NOT NULL AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    date DATETIME NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_ID BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(user_ID) REFERENCES users(ID)
);