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
CREATE TABLE `Student_Group` (
  `Id` INT AUTO_INCREMENT,
  `Module` VARCHAR(10),
  `User` VARCHAR(13),
  `Group_Name` VARCHAR(100),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`)
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
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Room`) REFERENCES `Rooms`(`Number`),
  FOREIGN KEY (`Group`) REFERENCES `Student_Group`(`Id`),
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
  FOREIGN KEY (`Department`) REFERENCES `Departments`(`Name`)
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
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`),
  FOREIGN KEY (`Semester`) REFERENCES `Semesters`(`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`)
);
CREATE TABLE `Lecturers_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Lecturer` VARCHAR(13),
  `Module` VARCHAR(10),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Lecturer`) REFERENCES `Users`(`Id`)
);
CREATE TABLE `Logins` (
  `Id` INT AUTO_INCREMENT,
  `Username` VARCHAR(13),
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Username`) REFERENCES `Users`(`Id`)
);
CREATE TABLE `Student_Enrolment` (
  `Id` INT AUTO_INCREMENT,
  `Student` VARCHAR(13),
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
  `User` VARCHAR(13),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Role`) REFERENCES `Roles`(`Id`),
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`)
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
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`)
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
  INSERT INTO users
VALUES (
    "S19002861",
    "Anthony",
    "Goff",
    "Mr",
    "Male",
    "1981-01-21",
    "a.goff@gmail.com",
    "S19002861@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S19001784",
    "Misha",
    "Cardenas",
    "Mrs",
    "Female",
    "1993-07-05",
    "m.cardenas@gmail.com",
    "S19001784@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Husband, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S19002171",
    "Johnathan",
    "Haslsall",
    "Mr",
    "Male",
    "1989-10-20",
    "j.halsall@gmail.com",
    "S19002171@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S19002485",
    "Jessica",
    "Muirhead",
    "Mrs",
    "Female",
    "1978-02-08",
    "j.muirhead@gmail.com",
    "S19002485@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Husband, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S20002863",
    "Christopher",
    "Thomas",
    "Mr",
    "Male",
    "2000-12-01",
    "ch.thomas@gmail.com",
    "S20002863@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S19002584",
    "Matthew",
    "Halliday",
    "Mr",
    "Male",
    "1995-11-17",
    "m.halliday@gmail.com",
    "S19002584@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S20001713",
    "Greig",
    "Emmesis",
    "Mr",
    "Male",
    "2000-06-29",
    "g.emmesis@gmail.com",
    "S20001713@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S18001921",
    "Tammy",
    "Jones",
    "Mr",
    "Male",
    "1981-09-22",
    "t.jones@gmail.com",
    "S18001921@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "S20000868",
    "Huseyin",
    "Ucur",
    "Mr",
    "Male",
    "2000-07-02",
    "h.ucur@gmail.com",
    "S20000868@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  
  INSERT INTO users
VALUES (
    "S18002131",
    "Celeste",
    "Star",
    "Mrs",
    "Female",
    "1976-12-24",
    "c.star@gmail.com",
    "S18002131@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Husband, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "2384923019287",
    "Mark",
    "Lewis",
    "Mr",
    "Male",
    "1986-10-01",
    "lewis.mark69@gmail.com",
    "m.lewis@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934832286",
    "55",
    "Chester Road",
    "CH13RM"
  );
  INSERT INTO users
VALUES (
    "6549923016287",
    "Neil",
    "Pickles",
    "Mr",
    "Male",
    "1976-11-21",
    "n.pickles@gmail.com",
    "n.pickle@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934832286",
    "55",
    "Chester Road",
    "CH13RM"
  );
  INSERT INTO users
VALUES (
    "1386523224287",
    "Will",
    "Rogers",
    "Mr",
    "Male",
    "1987-08-15",
    "will.rogers@gmail.com",
    "r.will@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934832286",
    "55",
    "Chester Road",
    "CH13RM"
  );
  INSERT INTO users
VALUES (
    "7384429399287",
    "Regan",
    "Williams",
    "Mr",
    "Male",
    "1988-10-24",
    "reg.williams@gmail.com",
    "r.williams@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934832286",
    "55",
    "Chester Road",
    "CH13RM"
  );
  INSERT INTO users
VALUES (
    "7789001019287",
    "Susan",
    "Liggett",
    "Mrs",
    "Female",
    "1990-03-31",
    "susan.liggett@gmail.com",
    "s.liggett@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Husband, +4407934832286",
    "55",
    "Chester Road",
    "CH13RM"
  );
  INSERT INTO users
VALUES (
    "1084955013287",
    "Terri",
    "Davies",
    "Mrs",
    "Female",
    "1982-12-01",
    "terri.d@gmail.com",
    "t.davies@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Husband, +4407934832286",
    "55",
    "Chester Road",
    "CH13RM"
  );
  INSERT INTO users
VALUES (
    "root",
    "Root",
    "User",
    "",
    "",
    "1991-11-21",
    "dawidolesko@gmail.com",
    "root@mail.glyndwr.ac.uk",
    "+4407923426783",
    "Wife, +4407934532286",
    "55",
    "Sealand Street",
    "CH52HM"
  );
  INSERT INTO users
VALUES (
    "admin",
    "admin",
    "user",
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
VALUES (null, "S19005373", "1234");
INSERT INTO logins
VALUES (null, "admin", "admin");
INSERT INTO logins
VALUES (null, "root", "mysql");
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
INSERT INTO role_assignment
VALUES (NULL, 1, "root");
INSERT INTO role_assignment
VALUES (NULL, 2, "admin");
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
  INSERT INTO departments
VALUES (
    "Science",
    "SCI",
    "Yin Bush",
    ""
  );
  INSERT INTO departments
VALUES (
    "Media",
    "MED",
    "Merylin Coff",
    ""
  );
  INSERT INTO departments
VALUES (
    "Business",
    "BUS",
    "Leszek Balcerowicz",
    ""
  );
  INSERT INTO departments
VALUES (
    "Education",
    "EDU",
    "Alex Neill",
    ""
  );
    INSERT INTO departments
VALUES (
    "Psychology",
    "PSY",
    "Alex Neill",
    ""
  );
INSERT INTO programmes
Values (
    NULL,
    "Computer Science",
    "BSc (Hons)",
    "Computing",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
INSERT INTO programmes
Values (
    NULL,
    "Computing",
    "BSc (Hons)",
    "Computing",
    4,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Computer Game Development",
    "BSc (Hons)",
    "Computing",
    4,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Computer Network & Security",
    "BSc (Hons)",
    "Computing",
    6,
    "Part Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Construction Management",
    "BSc (Hons)",
    "Computing",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Cyber Security",
    "BSc (Hons)",
    "Computing",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Game Art",
    "BSc (Hons)",
    "Computing",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Forensic Science",
    "BSc (Hons)",
    "Science",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Biochemistry",
    "BSc (Hons)",
    "Science",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Media Production",
    "BSc (Hons)",
    "Media",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Television Production",
    "BSc (Hons)",
    "Media",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Law and Business",
    "BSc (Hons)",
    "Business",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Marketing and Business",
    "BSc (Hons)",
    "Business",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Education",
    "BSc (Hons)",
    "Education",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
  INSERT INTO programmes
Values (
    NULL,
    "Primary Education with QTS",
    "BSc (Hons)",
    "Education",
    5,
    "Full Time",
    "2021-09-20",
    "2022-07-01",
    ""
  );
INSERT INTO student_enrolment
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
    "2022-07-01",
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
    "2023-07-01",
    "22/23",
    "Semester 2"
  );
INSERT INTO module_assignment
VALUES (NULL, 1, "COM539", 1);
INSERT INTO module_assignment
VALUES (NULL, 1, "COM540", 2);
INSERT INTO module_assignment
VALUES (NULL, 1, "COM553", 2);
INSERT INTO module_assignment
VALUES (NULL, 1, "COM545", 2);

INSERT INTO events
VALUES (
    NULL,
    "COM539",
    "B119",
    "Practical",
    "2022-04-10",
    "09:00:00",
    "12:00:00",
    NULL,
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
    NULL,
    NULL
  );
INSERT INTO `events`
VALUES (
    NULL,
    'COM545',
    'C124',
    'Lecture',
    '2022-04-12',
    '12:00:00',
    '16:00:00',
    NULL,
    NULL
  );
