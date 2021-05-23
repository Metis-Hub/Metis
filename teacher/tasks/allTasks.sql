SELECT taskId, `long` as `subject`, title, description, toDate
FROM task
JOIN course on task.courseId = course.courseId
	AND teacherId = ?
    AND toDate > ? AND toDate < ?
JOIN subject on course.subjectId = subject.subjectId
ORDER BY toDate ASC;