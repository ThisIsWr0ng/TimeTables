DROP TABLE IF EXISTS `Module_Assignment`,
`Lecturers_Assignment`,
`Logins`,
`Student_Enrollment`,
`Roles`,
`Role_Assignment`,
`Student_Timetable`,
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
`Semesters`;
CREATE TABLE `Users` (
  `Id` VARCHAR(10),
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
  `User_Id` VARCHAR(10),
  `Type` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`User_Id`) REFERENCES `Users`(`Id`),
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
  FOREIGN KEY (`Module_Id`) REFERENCES `Modules`(`Id`)
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
  FOREIGN KEY (`Building`) REFERENCES `Buildings`(`Name`)
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
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Room`) REFERENCES `Rooms`(`Number`),
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
  `Department` VARCHAR(50),
  `Level` CHAR(1) NOT NULL,
  `Start_Date` DATE NOT NULL,
  `End_Date` DATE NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Department`) REFERENCES `Departments`(`Name`)
);
CREATE TABLE `Semesters` (
  `Id` INT AUTO_INCREMENT,
  `Start_Date` DATE NOT NULL,
  `End_Date` DATE NOT NULL,
  `Name` VARCHAR(50),
  PRIMARY KEY (`Id`)
);
CREATE TABLE `Module_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Programme` INT,
  `Module` VARCHAR(10),
  `Semester` INT,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`),
  FOREIGN KEY (`Semester`) REFERENCES `Semesters`(`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`)
);
CREATE TABLE `Lecturers_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Lecturer` VARCHAR(10),
  `Module` VARCHAR(10),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Lecturer`) REFERENCES `Users`(`Id`)
);
CREATE TABLE `Logins` (
  `Username` VARCHAR(10),
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Username`)
);
CREATE TABLE `Student_Enrollment` (
  `Id` INT AUTO_INCREMENT,
  `Student` VARCHAR(10),
  `Programme` INT,
  `Date_Enrolled` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Date_Finished` DATE,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Student`) REFERENCES `Users`(`Id`),
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`)
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
  `User` VARCHAR(10),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Role`) REFERENCES `Roles`(`Id`),
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`)
);
CREATE TABLE `Student_Timetable` (
  `Id` INT AUTO_INCREMENT,
  `Student` VARCHAR(10),
  `Module_Assignment` INT,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module_Assignment`) REFERENCES `Module_Assignment`(`Id`),
  FOREIGN KEY (`Student`) REFERENCES `Users`(`Id`)
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
  `User` VARCHAR(10),
  `Color_Scheme` CHAR(1) DEFAULT 1,
  `Notifications` CHAR(1) DEFAULT 1,
  `Default_View` CHAR(1) DEFAULT 1,
  PRIMARY KEY (`User`)
);
INSERT INTO users
VALUES (
    "S19005373",
    "Dawid",
    "Olesko",
    "Mr",
    "Male",
    "1991-11-21",
    "dawidolesko@gmail.com",
    "S19005373@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
INSERT INTO settings
VALUES (
    "S19005373",
    "1",
    "1",
    "1"
  );
INSERT INTO logins
VALUES ("S19005373", "1234");
INSERT INTO logins
VALUES ("admin", "admin");
INSERT INTO logins
VALUES ("root", "mysql");
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
    "IT Technician",
    2,
    "Maintanance in networks and university computers"
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
VALUES (NULL, 5, "S19005373");
INSERT INTO holidays
VALUES (
    NULL,
    "Easter Break",
    "2022-04-11",
    "2022-04-24",
    "Two weeks off for easter holidays in semester 2"
  );
INSERT INTO departments
VALUES (
    "Computing",
    "COM",
    "John Doe",
    ""
  );
INSERT INTO programmes
Values (
    NULL,
    "BSc (Hons) Computer Science - Year 2 - Full Time",
    "Computing",
    5,
    "2021-09-20",
    "2022-07-01",
    "Computer Science"
  );
INSERT INTO programmes
Values (
    NULL,
    "BSc (Hons) Computing - Year 1 - Full Time",
    "Computing",
    4,
    "2021-09-20",
    "2022-07-01",
    "Computing Programme"
  );
INSERT INTO student_enrollment
VALUES (
    NULL,
    "S19005373",
    1,
    NOW(),
    NULL
  );
INSERT INTO modules
VALUES (
    "COM539",
    "Data Structures and Algorithms",
    "Maths module",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=35178"
  );
INSERT INTO modules
VALUES (
    "COM540",
    "Databases and Web-based Information Systems",
    "",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=35179"
  );
INSERT INTO modules
VALUES (
    "COM553",
    "Group Project",
    "",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=39159"
  );
INSERT INTO modules
VALUES (
    "COM545",
    "Responsible Computing",
    "",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=35184"
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
    "Semester One"
  );
INSERT INTO semesters
VALUES (
    NULL,
    "2022-01-31",
    "2022-07-01",
    "Semester two"
  );
INSERT INTO module_assignment
VALUES (NULL, 1, "COM539", 1);
INSERT INTO module_assignment
VALUES (NULL, 1, "COM540", 2);
INSERT INTO module_assignment
VALUES (NULL, 1, "COM553", 2);
INSERT INTO module_assignment
VALUES (NULL, 1, "COM545", 2);
INSERT INTO Student_Timetable
VALUES (NULL, "S19005373", 1);
INSERT INTO Student_Timetable
VALUES (NULL, "S19005373", 2);
INSERT INTO Student_Timetable
VALUES (NULL, "S19005373", 3);
INSERT INTO Student_Timetable
VALUES (NULL, "S19005373", 4);
INSERT INTO events
VALUES (
    NULL,
    "COM539",
    "B119",
    "Practical",
    "2022-04-10",
    "09:00:00",
    "12:00:00",
    NULL
  );
INSERT INTO events
VALUES (
    NULL,
    "COM540",
    "B117",
    "Practical",
    "2022-04-12",
    "09:00:00",
    "12:00:00",
    NULL
  );
INSERT INTO `events` (
    `Id`,
    `Module`,
    `Room`,
    `Type`,
    `Date`,
    `Time_From`,
    `Time_To`,
    `Description`
  )
VALUES (
    NULL,
    'COM545',
    'C124',
    'Lecture',
    '2022-04-12',
    '12:00:00',
    '16:00:00',
    NULL
  );