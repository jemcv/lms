
SET GLOBAL FOREIGN_KEY_CHECKS=0;

CREATE TABLE `student` (
  `student_id`    int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username`      varchar(100) NOT NULL,
  `email` varchar(100) NULL,
  `password`      varchar(100) NOT NULL,
  `student_fname` varchar(100) NOT NULL,
  `student_mname` varchar(100) NOT NULL,
  `student_lname` varchar(100) NOT NULL,
  `student_age` varchar(100) NOT NULL,
  `student_addrs` varchar(100) NOT NULL,
  `student_gendr` varchar(100) NOT NULL,
  `student_birth` varchar(100) NOT NULL,
  `student_contn` varchar(100) NOT NULL,
  `student_elem`  varchar(100) NOT NULL,
  `student_sec`   varchar(100) NOT NULL,
  `student_ter`   varchar(100) NOT NULL,
  `student_honor` varchar(100) NOT NULL,
  `student_cert`  varchar(100) NOT NULL,
  `student_guard`   varchar(100) NOT NULL,
  `student_guardno`  varchar(100) NOT NULL,
  `student_guardaddr`  varchar(100) NOT NULL,
  `usertype`      varchar(100) DEFAULT 'student'
)

CREATE TABLE `staff` (
  `staff_id`    int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `staff_no`    varchar(100) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `username`    varchar(100) NOT NULL,
  `password`    varchar(100) NOT NULL,
  `usertype`    varchar(100) DEFAULT 'staff'
)

CREATE TABLE `admin` (
  `admin_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(100) DEFAULT 'admin'
)

CREATE TABLE `task` (
  `task_id`  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `staff_id` int,
  `task_name` varchar(100) NOT NULL,
  `task_desc` varchar(100) NOT NULL,
  `task_req` varchar(100) NOT NULL,
  `task_date` varchar(100) NOT NULL,
  `file_data` longblob  NOT NULL,
  `username` varchar(100),
  `email` varchar(100),
  FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
)

CREATE TABLE  `status` (
  `status_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status_text` varchar(100) DEFAULT 'assigned',
  `file_data` longblob,
  `student_fname` varchar(100),
  `student_lname` varchar(100),
  `task_output` longblob,
  `task_name` varchar(100),
  `task_desc` varchar(100),
  `task_req` varchar(100),
  `grade` varchar(100),
  `task_id` int, 
  `student_id` int,
  `staff_id` int,
  FOREIGN KEY (task_id) REFERENCES task(task_id),
  FOREIGN KEY (student_id) REFERENCES student(student_id),
  FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
)  

