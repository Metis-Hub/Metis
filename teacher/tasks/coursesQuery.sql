SELECT course.`courseId`, `long`
FROM course
JOIN subject on teacherId = ? AND course.subjectId = subject.subjectId