DROP TABLE IF EXISTS `Module_Assignment`,
`Lecturers_Assignment`,
`Logins`,
`Student_Enrolment`,
`Student_Enrollment`,
`Roles`,
`Role_Assignment`,
`Student_Timetable`,
`User_Events`,
`Holidays`,
`Settings`,
`Users`,
`Requests`,
`Modules`,
`Deadlines`,
`Buildings`,
`Rooms`,
`Events`,
`Departments`,
`Programmes`,
`Semesters`,
`Student_Group`;
CREATE TABLE `Users` (
  `Id` VARCHAR(13),
  `First_Name` VARCHAR(50) NOT NULL,
  `Surname` VARCHAR(50) NOT NULL,
  `Title` VARCHAR(10),
  `Gender` VARCHAR(50),
  `Birth_Date` DATE NOT NULL,
  `Priv_Email` VARCHAR(50) NOT NULL,
  `Uni_Email` VARCHAR(50) NOT NULL,
  `Telephone` VARCHAR(50) NOT NULL,
  `Next_Of_Kin` VARCHAR(50),
  `Street_Number` VARCHAR(5) NOT NULL,
  `Street_Name` VARCHAR(50),
  `Postcode` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`Id`)
);
CREATE TABLE `Requests` (
  `Id` INT AUTO_INCREMENT,
  `User_Id` VARCHAR(13),
  `Type` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  `Status` TINYINT DEFAULT 0,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`User_Id`) REFERENCES `Users`(`Id`) ON DELETE CASCADE,
  INDEX (Type)
);
CREATE TABLE `Modules` (
  `Id` VARCHAR(10),
  `Name` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  `Moodle_Link` VARCHAR(200),
  PRIMARY KEY (`Id`)
);
CREATE TABLE `Deadlines` (
  `Id` INT AUTO_INCREMENT,
  `Module_Id` VARCHAR(10),
  `Name` VARCHAR(50) NOT NULL,
  `Date` DATETIME NOT NULL,
  `Weight` VARCHAR(5) NOT NULL,
  `Moodle_Link` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module_Id`) REFERENCES `Modules`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Buildings` (
  `Name` VARCHAR(50),
  `Street_Number` VARCHAR(5) NOT NULL,
  `Street_Name` VARCHAR(50),
  `Postcode` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`Name`)
);
CREATE TABLE `Rooms` (
  `Number` VARCHAR(10),
  `Building` VARCHAR(50),
  `Number_Of_Seats` CHAR(3),
  `Type` VARCHAR(50),
  `Equipment` VARCHAR(200),
  `Section` VARCHAR(50),
  PRIMARY KEY (`Number`, `Building`),
  FOREIGN KEY (`Building`) REFERENCES `Buildings`(`Name`) ON DELETE CASCADE
);
CREATE TABLE `Student_Group` (
  `Id` INT AUTO_INCREMENT,
  `Module` VARCHAR(10),
  `User` VARCHAR(13),
  `Group_Name` VARCHAR(100),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Events` (
  `Id` INT AUTO_INCREMENT,
  `Module` VARCHAR(10),
  `Room` VARCHAR(10),
  `Type` VARCHAR(50),
  `Date` DATE NOT NULL,
  `Time_From` TIME NOT NULL,
  `Time_To` TIME NOT NULL,
  `Description` VARCHAR(200),
  `Group` INT,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`Room`) REFERENCES `Rooms`(`Number`) ON DELETE CASCADE,
  FOREIGN KEY (`Group`) REFERENCES `Student_Group`(`Id`) ON DELETE CASCADE,
  INDEX (Module)
);
CREATE TABLE `Departments` (
  `Name` VARCHAR(50),
  `Code` VARCHAR(3),
  `Managed_By` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Name`)
);
CREATE TABLE `Programmes` (
  `Id` INT AUTO_INCREMENT,
  `Name` VARCHAR(50) NOT NULL,
  `Degree` VARCHAR(10) NOT NULL,
  `Department` VARCHAR(50),
  `Level` CHAR(1) NOT NULL,
  `Type` VARCHAR(10) NOT NULL,
  `Start_Date` DATE NOT NULL,
  `End_Date` DATE NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Department`) REFERENCES `Departments`(`Name`) ON DELETE CASCADE
);
CREATE TABLE `Semesters` (
  `Id` INT AUTO_INCREMENT,
  `Start_Date` DATE NOT NULL,
  `End_Date` DATE NOT NULL,
  `Year` VARCHAR(8),
  `Name` VARCHAR(50),
  PRIMARY KEY (`Id`)
);
CREATE TABLE `Module_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Programme` INT,
  `Module` VARCHAR(10),
  `Semester` INT,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`Semester`) REFERENCES `Semesters`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Lecturers_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Lecturer` VARCHAR(13),
  `Module` VARCHAR(10),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`Lecturer`) REFERENCES `Users`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Logins` (
  `Id` INT AUTO_INCREMENT,
  `Username` VARCHAR(13),
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Username`) REFERENCES `Users`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Student_Enrolment` (
  `Id` INT AUTO_INCREMENT,
  `Student` VARCHAR(13),
  `Programme` INT,
  `Date_Enrolled` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Date_Finished` DATE,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Student`) REFERENCES `Users`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Roles` (
  `Id` INT AUTO_INCREMENT,
  `Name` VARCHAR(50),
  `Access_Level` CHAR(1) NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
);
CREATE TABLE `Role_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Role` INT,
  `User` VARCHAR(13),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Role`) REFERENCES `Roles`(`Id`) ON DELETE CASCADE,
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`) ON DELETE CASCADE
);
CREATE TABLE `Holidays` (
  `Id` INT AUTO_INCREMENT,
  `Name` VARCHAR(50),
  `Date_From` DATE NOT NULL,
  `Date_To` DATE NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
);
CREATE TABLE `Settings` (
  `User` VARCHAR(13),
  `Color_Scheme` CHAR(1) DEFAULT 1,
  `Notifications` CHAR(1) DEFAULT 1,
  `Default_View` CHAR(1) DEFAULT 1,
  PRIMARY KEY (`User`)
);
CREATE TABLE `User_Events` (
  `Id` INT AUTO_INCREMENT,
  `User` VARCHAR(13),
  `Name` VARCHAR(100),
  `Date` DATE,
  `Time_From` TIME NOT NULL,
  `Time_To` TIME NOT NULL,
  `Description` VARCHAR(300),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`) ON DELETE CASCADE
);

INSERT INTO `users` (`Id`, `First_Name`, `Surname`, `Title`, `Gender`, `Birth_Date`, `Priv_Email`, `Uni_Email`, `Telephone`, `Next_Of_Kin`, `Street_Number`, `Street_Name`, `Postcode`) VALUES
('1084955013287', 'Terri', 'Davies', 'Mrs', 'Female', '1982-12-01', 'terri.d@gmail.com', 't.davies@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('1386523224287', 'Will', 'Rogers', 'Mr', 'Male', '1987-08-15', 'will.rogers@gmail.com', 'r.will@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('2384923019287', 'Mark', 'Lewis', 'Mr', 'Male', '1986-10-01', 'lewis.mark69@gmail.com', 'm.lewis@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('6549923016287', 'Neil', 'Pickles', 'Mr', 'Male', '1976-11-21', 'n.pickles@gmail.com', 'n.pickle@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('7384429399287', 'Regan', 'Williams', 'Mr', 'Male', '1988-10-24', 'reg.williams@gmail.com', 'r.williams@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('7789001019287', 'Susan', 'Liggett', 'Mrs', 'Female', '1990-03-31', 'susan.liggett@gmail.com', 's.liggett@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934832286', '55', 'Chester Road', 'CH13RM'),
('admin', 'admin', 'user', 'Mr', 'Male', '1991-11-21', 'dawidolesko@gmail.com', 'S19005373@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('root', 'Root', 'User', '', '', '1991-11-21', 'dawidolesko@gmail.com', 'root@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S18001921', 'Tammy', 'Jones', 'Mr', 'Male', '1981-09-22', 't.jones@gmail.com', 'S18001921@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S18002131', 'Celeste', 'Star', 'Mrs', 'Female', '1976-12-24', 'c.star@gmail.com', 'S18002131@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19001784', 'Misha', 'Cardenas', 'Mrs', 'Female', '1993-07-05', 'm.cardenas@gmail.com', 'S19001784@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002171', 'Johnathan', 'Haslsall', 'Mr', 'Male', '1989-10-20', 'j.halsall@gmail.com', 'S19002171@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002485', 'Jessica', 'Muirhead', 'Mrs', 'Female', '1978-02-08', 'j.muirhead@gmail.com', 'S19002485@mail.glyndwr.ac.uk', '+4407923426783', 'Husband, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002584', 'Matthew', 'Halliday', 'Mr', 'Male', '1995-11-17', 'm.halliday@gmail.com', 'S19002584@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19002861', 'Anthony', 'Goff', 'Mr', 'Male', '1981-01-21', 'a.goff@gmail.com', 'S19002861@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S19005373', 'Dawid', 'Olesko', 'Mr', 'Male', '1991-11-21', 'dawidolesko@gmail.com', 'S19005373@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S20000868', 'Huseyin', 'Ucur', 'Mr', 'Male', '2000-07-02', 'h.ucur@gmail.com', 'S20000868@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S20001713', 'Greig', 'Emmesis', 'Mr', 'Male', '2000-06-29', 'g.emmesis@gmail.com', 'S20001713@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM'),
('S20002863', 'Christopher', 'Thomas', 'Mr', 'Male', '2000-12-01', 'ch.thomas@gmail.com', 'S20002863@mail.glyndwr.ac.uk', '+4407923426783', 'Wife, +4407934532286', '55', 'Sealand Street', 'CH52HM');


INSERT INTO settings
VALUES (
    "S19005373",
    "1",
    "1",
    "1"
  );
INSERT INTO logins
VALUES (null, "2384923019287", "1234");
INSERT INTO logins
VALUES (null, "admin", "admin");
INSERT INTO logins
VALUES (null, "root", "mysql");
INSERT INTO logins
VALUES (null, "S19005373", "1234");
INSERT INTO roles
VALUES (
    NULL,
    "Root",
    0,
    "Root access, full control over servers and database"
  );
INSERT INTO roles
VALUES (
    NULL,
    "Admin",
    1,
    "Admin, access to database"
  );
INSERT INTO roles
VALUES (
    NULL,
    "Lecturer",
    3,
    "User, requests allowed"
  );
INSERT INTO roles
VALUES (
    NULL,
    "Undergraduate Student",
    4,
    "User, restricted access"
  );
INSERT INTO role_assignment
VALUES (NULL, 4, "S19005373");
INSERT INTO role_assignment
VALUES (NULL, 3, "2384923019287");
INSERT INTO role_assignment
VALUES (NULL, 1, "root");
INSERT INTO role_assignment
VALUES (NULL, 2, "admin");

INSERT INTO `lecturers_assignment` (`Id`, `Lecturer`, `Module`) VALUES
(1, '2384923019287', 'COM539'),
(2, '2384923019287', 'COM545'),
(3, '2384923019287', 'COM553');

INSERT INTO holidays
VALUES (
    NULL,
    "Easter Break",
    "2022-04-11",
    "2022-04-24",
    "Two weeks off for easter holidays in semester 2"
  );
INSERT INTO `departments` (`Name`, `Code`, `Managed_By`, `Description`) VALUES
('Business', 'BUS', 'Leszek Balcerowicz', ''),
('Computing', 'COM', 'John Doe', ''),
('Education', 'EDU', 'Alex Neill', ''),
('Media', 'MED', 'Merylin Coff', ''),
('Psychology', 'PSY', 'Alex Neill', ''),
('Science', 'SCI', 'Yin Bush', '');

INSERT INTO `programmes` (`Id`, `Name`, `Degree`, `Department`, `Level`, `Type`, `Start_Date`, `End_Date`, `Description`) VALUES
(1, 'Computer Science', 'BSc (Hons)', 'Computing', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(2, 'Computing', 'BSc (Hons)', 'Computing', '4', 'Full Time', '2021-09-20', '2022-07-01', ''),
(3, 'Computer Game Development', 'BSc (Hons)', 'Computing', '4', 'Full Time', '2021-09-20', '2022-07-01', ''),
(4, 'Computer Network & Security', 'BSc (Hons)', 'Computing', '6', 'Part Time', '2021-09-20', '2022-07-01', ''),
(5, 'Construction Management', 'BSc (Hons)', 'Computing', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(6, 'Cyber Security', 'BSc (Hons)', 'Computing', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(7, 'Game Art', 'BSc (Hons)', 'Computing', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(8, 'Forensic Science', 'BSc (Hons)', 'Science', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(9, 'Biochemistry', 'BSc (Hons)', 'Science', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(10, 'Media Production', 'BSc (Hons)', 'Media', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(11, 'Television Production', 'BSc (Hons)', 'Media', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(12, 'Law and Business', 'BSc (Hons)', 'Business', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(13, 'Marketing and Business', 'BSc (Hons)', 'Business', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(14, 'Education', 'BSc (Hons)', 'Education', '5', 'Full Time', '2021-09-20', '2022-07-01', ''),
(15, 'Primary Education with QTS', 'BSc (Hons)', 'Education', '5', 'Full Time', '2021-09-20', '2022-07-01', '');

INSERT INTO student_enrolment
VALUES (
    NULL,
    "S19005373",
    1,
    NOW(),
    NULL
  );
INSERT INTO `modules` (`Id`, `Name`, `Description`, `Moodle_Link`) VALUES
('COM537', 'Applied Programming', '  ', 'https://moodle.glyndwr.ac.uk/course/view.php?id=36930'),
('COM539', 'Data Structures and Algorithms', 'Maths module', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35178'),
('COM540', 'Databases and Web-based Information Systems', '', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35179'),
('COM545', 'Responsible Computing', '', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35184'),
('COM553', 'Group Project', '', 'https://moodle.glyndwr.ac.uk/course/view.php?id=39159'),
('COM556', 'User Experience Design', '  ', 'https://moodle.glyndwr.ac.uk/course/view.php?id=35195');

  INSERT INTO Lecturers_Assignment
  VALUES (
NULL,
"2384923019287",
"COM539"
  );
INSERT INTO buildings
VALUES (
    "Main Building",
    "1",
    "Mold Road",
    "LL11 2AW"
  );
INSERT INTO rooms
VALUES (
    "B119",
    "Main Building",
    25,
    "PC Room",
    "Projector, 20 pc's",
    "B"
  );
INSERT INTO rooms
VALUES (
    "B117",
    "Main Building",
    25,
    "PC Room",
    "Projector, 20 pc's",
    "B"
  );
  INSERT INTO rooms
VALUES (
    "B115",
    "Main Building",
    35,
    "Lecture Room",
    "",
    "B"
  );
  INSERT INTO rooms
VALUES (
    "A102",
    "Main Building",
    65,
    "Lecture Room",
    "",
    "A"
  );
INSERT INTO rooms
VALUES (
    "C124",
    "Main Building",
    60,
    "Lecture Room",
    "Projector",
    "C"
  );
INSERT INTO rooms
VALUES (
    "B118",
    "Main Building",
    60,
    "Lecture Room",
    "Projector",
    "B"
  );
INSERT INTO semesters
VALUES (
    NULL,
    "2021-09-20",
    "2022-01-28",
    "21/22",
    "Semester 1"
  );
INSERT INTO semesters
VALUES (
    NULL,
    "2022-01-31",
    "2022-05-15",
    "21/22",
    "Semester 2"
  );
  INSERT INTO semesters
VALUES (
    NULL,
    "2022-09-20",
    "2023-01-28",
    "22/23",
    "Semester 1"
  );
INSERT INTO semesters
VALUES (
    NULL,
    "2023-01-31",
    "2023-05-15",
    "22/23",
    "Semester 2"
  );
INSERT INTO `module_assignment` (`Id`, `Programme`, `Module`, `Semester`) VALUES
(1, 1, 'COM539', 1),
(2, 1, 'COM540', 2),
(3, 1, 'COM553', 2),
(4, 1, 'COM545', 2),
(5, 1, 'COM537', 1),
(6, 1, 'COM556', 1);

INSERT INTO `events` (`Id`, `Module`, `Room`, `Type`, `Date`, `Time_From`, `Time_To`, `Description`, `Group`) VALUES
(1, 'COM553', 'C124', 'Seminar', '2022-01-31', '13:00:00', '14:00:00', '  ', NULL),
(2, 'COM553', 'C124', 'Seminar', '2022-02-07', '13:00:00', '14:00:00', '  ', NULL),
(3, 'COM553', 'C124', 'Seminar', '2022-02-14', '13:00:00', '14:00:00', '  ', NULL),
(4, 'COM553', 'C124', 'Seminar', '2022-02-21', '13:00:00', '14:00:00', '  ', NULL),
(5, 'COM553', 'C124', 'Seminar', '2022-02-28', '13:00:00', '14:00:00', '  ', NULL),
(6, 'COM553', 'C124', 'Seminar', '2022-03-07', '13:00:00', '14:00:00', '  ', NULL),
(7, 'COM553', 'C124', 'Seminar', '2022-03-14', '13:00:00', '14:00:00', '  ', NULL),
(8, 'COM553', 'C124', 'Seminar', '2022-03-21', '13:00:00', '14:00:00', '  ', NULL),
(9, 'COM553', 'C124', 'Seminar', '2022-03-28', '13:00:00', '14:00:00', '  ', NULL),
(10, 'COM553', 'C124', 'Seminar', '2022-04-04', '13:00:00', '14:00:00', '  ', NULL),
(11, 'COM553', 'C124', 'Seminar', '2022-04-25', '13:00:00', '14:00:00', '  ', NULL),
(12, 'COM553', 'C124', 'Seminar', '2022-05-02', '13:00:00', '14:00:00', '  ', NULL),
(13, 'COM553', 'C124', 'Seminar', '2022-05-09', '13:00:00', '14:00:00', '  ', NULL),
(14, 'COM553', 'B117', 'Tutorials', '2022-01-31', '14:00:00', '16:00:00', '  ', NULL),
(15, 'COM553', 'B117', 'Tutorials', '2022-02-07', '14:00:00', '16:00:00', '  ', NULL),
(16, 'COM553', 'B117', 'Tutorials', '2022-02-14', '14:00:00', '16:00:00', '  ', NULL),
(17, 'COM553', 'B117', 'Tutorials', '2022-02-21', '14:00:00', '16:00:00', '  ', NULL),
(18, 'COM553', 'B117', 'Tutorials', '2022-02-28', '14:00:00', '16:00:00', '  ', NULL),
(19, 'COM553', 'B117', 'Tutorials', '2022-03-07', '14:00:00', '16:00:00', '  ', NULL),
(20, 'COM553', 'B117', 'Tutorials', '2022-03-14', '14:00:00', '16:00:00', '  ', NULL),
(21, 'COM553', 'B117', 'Tutorials', '2022-03-21', '14:00:00', '16:00:00', '  ', NULL),
(22, 'COM553', 'B117', 'Tutorials', '2022-03-28', '14:00:00', '16:00:00', '  ', NULL),
(23, 'COM553', 'B117', 'Tutorials', '2022-04-04', '14:00:00', '16:00:00', '  ', NULL),
(24, 'COM553', 'B117', 'Tutorials', '2022-04-25', '14:00:00', '16:00:00', '  ', NULL),
(25, 'COM553', 'B117', 'Tutorials', '2022-05-02', '14:00:00', '16:00:00', '  ', NULL),
(26, 'COM553', 'B117', 'Tutorials', '2022-05-09', '14:00:00', '16:00:00', '  ', NULL),
(27, 'COM545', 'B118', 'Seminar', '2022-02-01', '09:00:00', '11:00:00', '  ', NULL),
(28, 'COM545', 'B118', 'Seminar', '2022-02-08', '09:00:00', '11:00:00', '  ', NULL),
(29, 'COM545', 'B118', 'Seminar', '2022-02-15', '09:00:00', '11:00:00', '  ', NULL),
(30, 'COM545', 'B118', 'Seminar', '2022-02-22', '09:00:00', '11:00:00', '  ', NULL),
(31, 'COM545', 'B118', 'Seminar', '2022-03-01', '09:00:00', '11:00:00', '  ', NULL),
(32, 'COM545', 'B118', 'Seminar', '2022-03-08', '09:00:00', '11:00:00', '  ', NULL),
(33, 'COM545', 'B118', 'Seminar', '2022-03-15', '09:00:00', '11:00:00', '  ', NULL),
(34, 'COM545', 'B118', 'Seminar', '2022-03-22', '09:00:00', '11:00:00', '  ', NULL),
(35, 'COM545', 'B118', 'Seminar', '2022-03-29', '09:00:00', '11:00:00', '  ', NULL),
(36, 'COM545', 'B118', 'Seminar', '2022-04-05', '09:00:00', '11:00:00', '  ', NULL),
(37, 'COM545', 'B118', 'Seminar', '2022-04-26', '09:00:00', '11:00:00', '  ', NULL),
(38, 'COM545', 'B118', 'Seminar', '2022-05-03', '09:00:00', '11:00:00', '  ', NULL),
(39, 'COM545', 'B118', 'Seminar', '2022-05-10', '09:00:00', '11:00:00', '  ', NULL),
(40, 'COM545', 'B117', 'Practical', '2022-02-01', '11:00:00', '13:00:00', '  ', NULL),
(41, 'COM545', 'B117', 'Practical', '2022-02-08', '11:00:00', '13:00:00', '  ', NULL),
(42, 'COM545', 'B117', 'Practical', '2022-02-15', '11:00:00', '13:00:00', '  ', NULL),
(43, 'COM545', 'B117', 'Practical', '2022-02-22', '11:00:00', '13:00:00', '  ', NULL),
(44, 'COM545', 'B117', 'Practical', '2022-03-01', '11:00:00', '13:00:00', '  ', NULL),
(45, 'COM545', 'B117', 'Practical', '2022-03-08', '11:00:00', '13:00:00', '  ', NULL),
(46, 'COM545', 'B117', 'Practical', '2022-03-15', '11:00:00', '13:00:00', '  ', NULL),
(47, 'COM545', 'B117', 'Practical', '2022-03-22', '11:00:00', '13:00:00', '  ', NULL),
(48, 'COM545', 'B117', 'Practical', '2022-03-29', '11:00:00', '13:00:00', '  ', NULL),
(49, 'COM545', 'B117', 'Practical', '2022-04-05', '11:00:00', '13:00:00', '  ', NULL),
(50, 'COM545', 'B117', 'Practical', '2022-04-26', '11:00:00', '13:00:00', '  ', NULL),
(51, 'COM545', 'B117', 'Practical', '2022-05-03', '11:00:00', '13:00:00', '  ', NULL),
(52, 'COM545', 'B117', 'Practical', '2022-05-10', '11:00:00', '13:00:00', '  ', NULL),
(53, 'COM540', 'B119', 'Practical', '2022-02-01', '13:00:00', '16:00:00', '  ', NULL),
(54, 'COM540', 'B119', 'Practical', '2022-02-08', '13:00:00', '16:00:00', '  ', NULL),
(55, 'COM540', 'B119', 'Practical', '2022-02-15', '13:00:00', '16:00:00', '  ', NULL),
(56, 'COM540', 'B119', 'Practical', '2022-02-22', '13:00:00', '16:00:00', '  ', NULL),
(57, 'COM540', 'B119', 'Practical', '2022-03-01', '13:00:00', '16:00:00', '  ', NULL),
(58, 'COM540', 'B119', 'Practical', '2022-03-08', '13:00:00', '16:00:00', '  ', NULL),
(59, 'COM540', 'B119', 'Practical', '2022-03-15', '13:00:00', '16:00:00', '  ', NULL),
(60, 'COM540', 'B119', 'Practical', '2022-03-22', '13:00:00', '16:00:00', '  ', NULL),
(61, 'COM540', 'B119', 'Practical', '2022-03-29', '13:00:00', '16:00:00', '  ', NULL),
(62, 'COM540', 'B119', 'Practical', '2022-04-05', '13:00:00', '16:00:00', '  ', NULL),
(63, 'COM540', 'B119', 'Practical', '2022-04-26', '13:00:00', '16:00:00', '  ', NULL),
(64, 'COM540', 'B119', 'Practical', '2022-05-03', '13:00:00', '16:00:00', '  ', NULL),
(65, 'COM540', 'B119', 'Practical', '2022-05-10', '13:00:00', '16:00:00', '  ', NULL),
(66, 'COM540', 'B119', 'Self-Directed Study', '2022-02-01', '16:00:00', '17:00:00', '  ', NULL),
(67, 'COM540', 'B119', 'Self-Directed Study', '2022-02-08', '16:00:00', '17:00:00', '  ', NULL),
(68, 'COM540', 'B119', 'Self-Directed Study', '2022-02-15', '16:00:00', '17:00:00', '  ', NULL),
(69, 'COM540', 'B119', 'Self-Directed Study', '2022-02-22', '16:00:00', '17:00:00', '  ', NULL),
(70, 'COM540', 'B119', 'Self-Directed Study', '2022-03-01', '16:00:00', '17:00:00', '  ', NULL),
(71, 'COM540', 'B119', 'Self-Directed Study', '2022-03-08', '16:00:00', '17:00:00', '  ', NULL),
(72, 'COM540', 'B119', 'Self-Directed Study', '2022-03-15', '16:00:00', '17:00:00', '  ', NULL),
(73, 'COM540', 'B119', 'Self-Directed Study', '2022-03-22', '16:00:00', '17:00:00', '  ', NULL),
(74, 'COM540', 'B119', 'Self-Directed Study', '2022-03-29', '16:00:00', '17:00:00', '  ', NULL),
(75, 'COM540', 'B119', 'Self-Directed Study', '2022-04-05', '16:00:00', '17:00:00', '  ', NULL),
(76, 'COM540', 'B119', 'Self-Directed Study', '2022-04-26', '16:00:00', '17:00:00', '  ', NULL),
(77, 'COM540', 'B119', 'Self-Directed Study', '2022-05-03', '16:00:00', '17:00:00', '  ', NULL),
(78, 'COM540', 'B119', 'Self-Directed Study', '2022-05-10', '16:00:00', '17:00:00', '  ', NULL),
(92, 'COM545', 'B118', 'Seminar', '2022-02-02', '09:00:00', '11:00:00', '  ', NULL),
(93, 'COM545', 'B118', 'Seminar', '2022-02-09', '09:00:00', '11:00:00', '  ', NULL),
(94, 'COM545', 'B118', 'Seminar', '2022-02-16', '09:00:00', '11:00:00', '  ', NULL),
(95, 'COM545', 'B118', 'Seminar', '2022-02-23', '09:00:00', '11:00:00', '  ', NULL),
(96, 'COM545', 'B118', 'Seminar', '2022-03-02', '09:00:00', '11:00:00', '  ', NULL),
(97, 'COM545', 'B118', 'Seminar', '2022-03-09', '09:00:00', '11:00:00', '  ', NULL),
(98, 'COM545', 'B118', 'Seminar', '2022-03-16', '09:00:00', '11:00:00', '  ', NULL),
(99, 'COM545', 'B118', 'Seminar', '2022-03-23', '09:00:00', '11:00:00', '  ', NULL),
(100, 'COM545', 'B118', 'Seminar', '2022-03-30', '09:00:00', '11:00:00', '  ', NULL),
(101, 'COM545', 'B118', 'Seminar', '2022-04-06', '09:00:00', '11:00:00', '  ', NULL),
(102, 'COM545', 'B118', 'Seminar', '2022-04-27', '09:00:00', '11:00:00', '  ', NULL),
(103, 'COM545', 'B118', 'Seminar', '2022-05-04', '09:00:00', '11:00:00', '  ', NULL),
(104, 'COM545', 'B118', 'Seminar', '2022-05-11', '09:00:00', '11:00:00', '  ', NULL),
(105, 'COM553', 'C124', 'Exam', '2022-05-09', '09:00:00', '09:00:00', '  ', NULL);



