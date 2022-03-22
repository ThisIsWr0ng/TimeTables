/*
 Data for TimeTables
 User id has to be generated in php
 Remove my details before submitting!!!!
 */
INSERT INTO users
VALUES (
        "S19005373",
        "Dawid",
        "Olesko",
        "Mr",
        "dawidolesko@gmail.com",
        "S19005373@mail.glyndwr.ac.uk",
        "+4407923426783",
        "Wife, +4407934532286",
        "55",
        "Sealand Street",
        "CH52HM"
    );

INSERT INTO settings VALUES (
    "S19005373",
    "1",
    "1",
    "1"
     );
INSERT INTO logins VALUES (
    "S19005373",
    "1234"
);

INSERT INTO roles VALUES (
    NULL,
    "Root",
    0,
    "Root access, full control over servers and database"
);
INSERT INTO roles VALUES (
    NULL,
    "Admin",
    1,
    "Admin, access to database"
);
INSERT INTO roles VALUES (
    NULL,
    "IT Technician",
    2,
    "Maintanance in networks and university computers"
);
INSERT INTO roles VALUES (
    NULL,
    "Lecturer",
    3,
    "User, requests allowed"
);
INSERT INTO roles VALUES (
    NULL,
    "Undergraduate Student",
    4,
    "User, restricted access"
);

INSERT INTO role_assignment VALUES (
    NULL,
    5,
    "S19005373"
);

INSERT INTO holidays VALUES (
    NULL,
    "Easter Break",
    "2022-04-11",
    "2022-04-24",
    "Two weeks off for easter holidays in semester 2"
);

INSERT INTO departments VALUES (
    "Computing",
    "COM",
    "John Doe",
    ""
);

INSERT INTO programmes Values (
    NULL,
    "BSc (Hons) Computer Science - Year 2 - Full Time",
    "Computing",
    5,
    "2021-09-20",
    "2022-07-01",
    "Computer Science"
);
INSERT INTO programmes Values (
    NULL,
    "BSc (Hons) Computing - Year 1 - Full Time",
    "Computing",
    4,
    "2021-09-20",
    "2022-07-01",
    "Computing Programme"
);

INSERT INTO student_enrollment VALUES (
    NULL,
    "S19005373",
    1,
    NOW(),
    NULL
);

INSERT INTO modules VALUES (
    "COM539",
    "Data Structures and Algorithms",
    "Maths module",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=35178"
);
INSERT INTO modules VALUES (
    "COM540",
    "Databases and Web-based Information Systems",
    "",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=35179"
);
INSERT INTO modules VALUES (
    "COM553 ",
    "Group Project",
    "",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=39159"
);
INSERT INTO modules VALUES (
    "COM545",
    "Responsible Computing",
    "",
    "https://moodle.glyndwr.ac.uk/course/view.php?id=35184"
);

INSERT INTO buildings VALUES (
    "Main Building",
    "1",
    "Mold Road",
    "LL11 2AW"
);

INSERT INTO rooms VALUES (
    "B119",
    "Main Building",
    25,
    "PC Room",
    "Projector, 20 pc's",
    "B"
);
INSERT INTO rooms VALUES (
    "B117",
    "Main Building",
    25,
    "PC Room",
    "Projector, 20 pc's",
    "B"
);
INSERT INTO rooms VALUES (
    "C124",
    "Main Building",
    60,
    "Lecture Room",
    "Projector",
    "C"
);
INSERT INTO rooms VALUES (
    "B118",
    "Main Building",
    60,
    "Lecture Room",
    "Projector",
    "B"
);

INSERT INTO semesters VALUES (
    NULL,
    "2021-09-20",
    "2022-01-28",
    "Semester One"
);
INSERT INTO semesters VALUES (
    NULL,
    "2022-01-31",
    "2022-07-01",
    "Semester two"
);
