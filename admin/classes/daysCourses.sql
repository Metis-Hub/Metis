SELECT course.courseId, courseIndex, isSubstitute, teacherId, salutation, name as teacherName, email, `long` AS `subject`
FROM day_has_course
	JOIN course ON course.courseId = day_has_course.courseId AND dayId = ?
	JOIN teacher ON course.teacherId = teacher.id
	JOIN subject ON course.subjectId = subject.subjectId
ORDER BY courseIndex ASC;