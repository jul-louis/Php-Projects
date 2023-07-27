# Php-Projects
Php Projects by Louis Jul. Kano

See Design Artifacts at -->

  Readme Website: https://jul-louis.github.io/Php-Projects/readme.htm

## Instruction to Run

As Heroku cancelled the free-tier membership, the website is no longer available. But you can download the repo and run it locally.

## Mooc Learning: Introduction


## Mooc Learning: MySQL Database Design

        CREATE TABLE IF NOT EXISTS students(<br/>
          student_id int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT, student_uid VARCHAR(30) NOT NULL, pwd VARCHAR(100) NOT NULL)

        CREATE TABLE IF NOT EXISTS courses(<br/>
          course_id int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT, <br/>
          course_name VARCHAR(50) NOT NULL, course_description VARCHAR(2000),<br/>
          course_cover VARCHAR(500), course_notes TEXT NOT NULL, course_quiz TEXT NOT NULL);<br/>

        CREATE TABLE IF NOT EXISTS course_student(<br/>
          course_id int(10) NOT NULL, student_id int(10) NOT NULL,<br/>
          FOREIGN KEY (course_id) REFERENCES courses(course_id),<br/>
          FOREIGN KEY (student_id) REFERENCES students(student_id),<br/>
          UNIQUE (course_id, student_id) );<br/>
