SELECT task.taskId, task.courseId, `long` as `subject`, title, `description`, toDate, createdDate
FROM metis.task
JOIN course on task.courseId = course.courseId
    AND taskId = ?
	AND teacherId = ?
JOIN `subject` on course.subjectId = `subject`.subjectId;