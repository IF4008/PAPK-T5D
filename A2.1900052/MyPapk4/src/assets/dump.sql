CREATE TABLE IF NOT EXISTS ${this.db_table} (
    user_id INTEGER PRIMARY KEY,
    name varchar(255),
    email varchar(255)
);

INSERT or IGNORE INTO userTable(user_id, name, email) VALUES (1, 'Dinda Tri', 'dindatri@gmail.com');
INSERT or IGNORE INTO userTable(user_id, name, email) VALUES (2, 'Siti Amalia', 'samalia@gmail.com');
INSERT or IGNORE INTO userTable(user_id, name, email) VALUES (3, 'Sahla', 'sahla@gmail.com');
INSERT or IGNORE INTO userTable(user_id, name, email) VALUES (4, 'Neng Rina', 'nengrina@gmail.com');
INSERT or IGNORE INTO userTable(user_id, name, email) VALUES (5, 'Rianetha Remandasari', 'rianessa@gmail.com');