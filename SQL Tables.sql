--SQL Tables
--No constrains implemented yet!
CREATE TABLE `Users` (
  `Id` VARCHAR(50),
  `FirstName` VARCHAR(50),
  `Surname` VARCHAR(50),
  `Title` VARCHAR(10),
  `Email` VARCHAR(50),
  `Telephone` VARCHAR(50),
  `NextOfKin` VARCHAR(50),
  `Settings` VARCHAR(50),
  `ColourScheme` CHAR(1),
  PRIMARY KEY (`Id`)
);

CREATE TABLE `Requests` (
  `Id` VARCHAR(50),
  `UserId` VARCHAR(50),
  `Type` VARCHAR(50),
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`UserId`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Modules` (
  `Id` VARCHAR(50),
  `Name` VARCHAR(50),
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
);

CREATE TABLE `Rooms` (
  `Number` VARCHAR(10),
  `NumberOfSeats` CHAR(3),
  `Type` VARCHAR(50),
  `Equipment` VARCHAR(200),
  PRIMARY KEY (`Number`)
);

CREATE TABLE `Events` (
  `Id` VARCHAR(50),
  `Type` VARCHAR(50),
  `Module` VARCHAR(50),
  `Room` VARCHAR(10),
  `DayOfWeek` CHAR(1),
  `TimeFrom` TIME,
  `TimeTo` TIME,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Room`) REFERENCES `Rooms`(`Number`)
);

CREATE TABLE `Departments` (
  `Name` VARCHAR(50),
  `ManagedBy` VARCHAR(50),
  `Description` VARCHAR(200),
  PRIMARY KEY (`Name`)
);

CREATE TABLE `Programmes` (
  `Id` VARCHAR(50),
  `Name` VARCHAR(50),
  `Department` VARCHAR(50),
  `Level` CHAR(1),
  `StartDate` DATE,
  `EndDate` DATE,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Department`) REFERENCES `Departments`(`Name`)
);

CREATE TABLE `Semesters` (
  `Id` VARCHAR(50),
  `StartDate` DATE,
  `EndDate` DATE,
  `Name` VARCHAR(50),
  PRIMARY KEY (`Id`)
);

CREATE TABLE `Module_Assignment` (
  `Id` VARCHAR(50),
  `Programme` VARCHAR(50),
  `Module` VARCHAR(50),
  `Semester` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`),
  FOREIGN KEY (`Semester`) REFERENCES `Semesters`(`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`)
);

CREATE TABLE `Lecturers_Assignment` (
  `Id` VARCHAR(50),
  `Lecturer` VARCHAR(50),
  `Module` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Modules`(`Id`),
  FOREIGN KEY (`Lecturer`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Logins` (
  `Username` VARCHAR(30),
  `Password` VARCHAR(50),
  PRIMARY KEY (`Username`),
  FOREIGN KEY (`Username`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Student_Enrollment` (
  `Id` VARCHAR(50),
  `Student` VARCHAR(50),
  `Programme` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Student`) REFERENCES `Users`(`Id`),
  FOREIGN KEY (`Programme`) REFERENCES `Programmes`(`Id`)
);

CREATE TABLE `Roles` (
  `Id` VARCHAR(50),
  `Name` VARCHAR(50),
  `AccessLevel` CHAR(1),
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
);

CREATE TABLE `Role_Assignment` (
  `Id` VARCHAR(50),
  `Role` VARCHAR(50),
  `User` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Role`) REFERENCES `Roles`(`Id`),
  FOREIGN KEY (`User`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Student_Timetable` (
  `Id` VARCHAR(50),
  `Student` VARCHAR(50),
  `Module` VARCHAR(50),
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Module`) REFERENCES `Module_Assignment`(`Id`),
  FOREIGN KEY (`Student`) REFERENCES `Users`(`Id`)
);

CREATE TABLE `Holidays` (
  `Id` VARCHAR(50),
  `DateFrom` DATE,
  `DateTo` DATE,
  `Description` VARCHAR(200),
  PRIMARY KEY (`Id`)
);

