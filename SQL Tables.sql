--SQL Tables
--No constrains implemented yet!
--ER Version 1.5.4
CREATE TABLE `Users` (
  `Id` VARCHAR(50),
  `First_Name` VARCHAR(50) NOT NULL,
  `Surname` VARCHAR(50) NOT NULL,
  `Title` VARCHAR(10),
  `Email` VARCHAR(50) NOT NULL,
  `Telephone` VARCHAR(50) NOT NULL,
  `Next_Of_Kin` VARCHAR(50),
  `Street_Number` VARCHAR(5) NOT NULL,
  `Street_Name` VARCHAR(50),
  `Postcode` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`Id`)
);

CREATE TABLE `Requests` (
  `Id` INT AUTO_INCREMENT,
  `User_Id` VARCHAR(50),
  `Type` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`User_Id`) REFERENCES `Users`(`Id`),
  INDEX (Type)
);

CREATE TABLE `Modules` (
  `Id` VARCHAR(50),
  `Name` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
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
  PRIMARY KEY (`Number`),
  FOREIGN KEY (`Building`) REFERENCES `Buildings`(`Name`)
);

CREATE TABLE `Events` (
  `Id` INT AUTO_INCREMENT,
  `Module` VARCHAR(50),
  `Room` VARCHAR(10),
  `Type` VARCHAR(50),
  `Day_Of_Week` CHAR(1) NOT NULL,
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
  `Managed_By` VARCHAR(50) NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Name`)
);

CREATE TABLE `Programmes` (
  `Id` VARCHAR(50),
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
  `Programme` VARCHAR(50),
  `Module` VARCHAR(50),
  `Semester` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`),
  FOREIGN KEY (`Semester`) REFERENCES `Semesters`(`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`)
);

CREATE TABLE `Lecturers_Assignment` (
  `Id` INT AUTO_INCREMENT,
  `Lecturer` VARCHAR(50),
  `Module` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Lecturer`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Logins` (
  `Username` VARCHAR(30),
  `Password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Username`)
);

CREATE TABLE `Student_Enrollment` (
  `Id` INT AUTO_INCREMENT,
  `Student` VARCHAR(50),
  `Programme` VARCHAR(50),
  `Level` CHAR(1) NOT NULL,
  `Date_Enrolled` DATE,
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
  `Role` VARCHAR(50),
  `User` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Role`) REFERENCES `Roles`(`Id`),
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Student_Timetable` (
  `Id` INT AUTO_INCREMENT,
  `Student` VARCHAR(50),
  `Module` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Module_Assignment`(`Id`),
  FOREIGN KEY (`Student`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Holidays` (
  `Id` INT AUTO_INCREMENT,
  `Date_From` DATE NOT NULL,
  `Date_To` DATE NOT NULL,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
);

CREATE TABLE `Settings` (
  `User` VARCHAR(50),
  `Color_Scheme` CHAR(1) DEFAULT 1,
  `Notifications` CHAR(1) DEFAULT 1,
  `Default_View` CHAR(1) DEFAULT 1,
  PRIMARY KEY (`User`)
);

