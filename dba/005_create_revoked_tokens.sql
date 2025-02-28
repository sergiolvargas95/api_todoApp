--- 005_create_revoked_tokens.sql
CREATE TABLE revoked_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(500) NOT NULL,
    revoked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
