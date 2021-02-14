create table folders_t (
    folder_id int (10) AUTO_INCREMENT,
    folder_name varchar(100) NOT NULL,
    folder_path varchar(200) NOT NULL,
    rem  varchar(250),
    PRIMARY KEY (folder_id)
);

create table files_t (
    file_id int (10) AUTO_INCREMENT,
    file_name varchar(100) NOT NULL,
    upload_datetime datetime,
    folder_id int(10) NOT NULL,
    rem  varchar(250),
    PRIMARY KEY (file_id),
    FOREIGN KEY (folder_id) REFERENCES folders_t (folder_id)
);
