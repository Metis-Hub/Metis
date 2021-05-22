SELECT `task`.`courseId`, `subject`.`long` as `subject`, `student_has_task`.`hasDone`, `task`.`title`, `task`.`description`, `task`.`toDate`, `task`.`createdDate`
	FROM `student_has_task`
	JOIN `task` ON `student_has_task`.`taskId` = ?
	AND `student_has_task`.`studentId` = ?
	JOIN `course` ON
		`task`.`courseId` = `course`.`courseId`
	JOIN `subject` ON `course`.`subjectId` = `subject`.`subjectId`