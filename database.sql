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

CREATE TABLE IF NOT EXISTS receipts(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    original_filename varchar(255) NOT NULL,
    storage_filename varchar(255) NOT NULL,
    media_type varchar(255) NOT NULL,
    transaction_id bigint(20) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY(transaction_id) REFERENCES transactions (id) ON DELETE CASCADE
);