DROP DATABASE if exists mycompany;
CREATE DATABASE mycompany;
    use mycompany;

    create table employee
    (
        id int auto_increment PRIMARY KEY,
        fname varchar(255),
        lname varchar(255)
           );

    INSERT INTO employee (fname, lname)
    values ('padme', 'Amidala'),
           ('ayano', 'kimura'),
           ('donald', 'Duck'),
           ('george', 'lucas'),
           ('shezleen', 'ahmed'),
           ('fikret', 'kocatürk'),
           ('bastian', 'hagedorn'),
           ('patrick', 'bowinkelmann'),
           ('server', 'purtov'),
           ('vullnet', 'ajvazi'),
           ('moritz', 'müller'),
           ('kilian', 'ludwig'),
           ('christian', 'bock');


CREATE TABLE department (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            department_name VARCHAR(255)
);

INSERT INTO department (department_name)
VALUES
    ('Accounting'),
    ('Human Resources'),
    ('IT'),
    ('Research and Development'),
    ('Design');

