SELECT course.courseId, courseIndex, isSubstitute, firstname, name, salutation, email, `long` as `subject`
FROM day_has_course
	JOIN course ON  day_has_course.courseId = course.courseID
	JOIN teacher on course.teacherId = teacher.id
	JOIN subject on course.subjectId = `subject`.subjectId
WHERE dayId = ?
ORDER BY courseIndex ASC;