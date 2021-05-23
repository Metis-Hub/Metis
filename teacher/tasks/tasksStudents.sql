SELECT studentId, hasDone, name, surname, email
FROM student_has_task
JOIN student on student_has_task.studentId = student.id
WHERE taskId = ?