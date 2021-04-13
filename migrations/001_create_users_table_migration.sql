/* =============== MIGRATE =============== */
CREATE TABLE users(
    id bigint NOT NUll AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

/* =============== ROLLBACK =============== */
DROP TABLE IF EXISTS users;