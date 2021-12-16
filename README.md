#Tutorial Booking System

Admin/Super User

1. Add Course to courses table
2. Edit Course from courses table
3. Delete Course from courses table
4. Assign User as Tutor to Tutors table
5. Delete Tutor Assignment from tutors table
6. Add Privileges to privileges table
7. Edit Privileges from privileges table
8. Add Academic year and semester to ays table
9. Edit Academic year and semester from ays table
10. Set Active academic year from ays table
11. Setup available courses with corresponding courses, academic year, tutor, date and time in available_courses table
12. Edit available courses

Student

1. login
2. make a request for tutorial booking
    - Select the department
    - select the course
    - select the teacher/tutor
    - select the timing
3. Dashboard should display the status of the current request depending on the currently active academic year
4. Can cancel the request if not yet accepted by tutor
5. Add comments to completed tutorial session

Tutor

1. Login
2. Display in the dashboard pending request
3. Open the request and select option accept or reject
    - if rejected reason should be encoded
4. Update request if completed
5. Add Comments about the tutorial session
