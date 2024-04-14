CREATE TABLE tasks(
    id int NOT NULL,
    title varchar(128) not NULL,
    completed tinyint(1) NOT NULL
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_general_ci;

CREATE UNIQUE INDEX tasks_id USING BTREE ON tasks (id);