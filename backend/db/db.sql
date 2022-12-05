DROP TABLE tb_todo;
DROP TABLE tb_user;

CREATE TABLE tb_user (
    id BIGINT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(128) NOT NULL,
    created_at DATETIME  DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    photo LONGBLOB,
    PRIMARY KEY (id),
    UNIQUE(email)
);

CREATE TABLE tb_todo (
    id BIGINT NOT NULL AUTO_INCREMENT,
    title VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    deadline DATETIME,
    status VARCHAR(1) NOT NULL default 'A',
    created_at DATETIME  DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    fk_user BIGINT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_todoXuser
        FOREIGN KEY (fk_user) REFERENCES tb_user (id)
);

/* Add 3 Users tb_user */
INSERT INTO tb_user (name, email,  password)
    VALUES ('Juca da Silva', 'juca1@gmail.com', 1234);

INSERT INTO tb_user (name, email,  password)
    VALUES ('Juca da Silva', 'juca2@gmail.com', 1234);

INSERT INTO tb_user (name, email,  password)
    VALUES ('Juca da Silva', 'juca3@gmail.com', 1234);

/* Add 3 ToDos tb_todo user 1 */
INSERT INTO tb_todo (title, description, deadline, fk_user)
    VALUES ('Teste', NULL, '2022-12-07 14:34:05', 'A', 1);

INSERT INTO tb_todo (title, description, deadline, status, fk_user)
    VALUES ('Teste2', NULL, '2022-12-08 14:34:05', 'D', 1);

INSERT INTO tb_todo (title, description, deadline, fk_user)
    VALUES ('Teste3', NULL, '2022-12-09 14:34:05', 'A', 1);

/* Add 2 ToDos tb_todo user 2 */
INSERT INTO tb_todo (title, description, deadline, fk_user)
    VALUES ('Teste', NULL, '2022-12-07 14:34:05', 'A', 2);

INSERT INTO tb_todo (title, description, deadline, fk_user)
    VALUES ('Teste2', NULL, '2022-12-08 14:34:05', 'A', 2);