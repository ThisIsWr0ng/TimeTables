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
    2022-04-11,
    2022-04-24,
    "Two weeks off for easter holidays in semester 2"
);

INSERT INTO departments VALUES (
    "Computing",
    "John Doe",
    ""
);

INSERT INTO programmes Values (
    NULL,
    "BSc (Hons) Computer Science - Year 2 - Full Time",
    "Computing",
    5,
    2021-09-20,
    2022-07-01,
    "Computer Science"
);
INSERT INTO programmes Values (
    NULL,
    "BSc (Hons) Computing - Year 1 - Full Time",
    "Computing",
    4,
    2021-09-20,
    2022-07-01,
    "Computing Programme"
);

INSERT INTO student_enrollment VALUES (
    NULL,
    "S19005373",
    1,
    NOW(),
    "",
);

