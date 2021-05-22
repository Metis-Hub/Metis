SELECT `student_has_task`.`taskId`, `task`.`courseId`, `student_has_task`.`hasDone`, `task`.`title`, `task`.`description`, `task`.`toDate`, `task`.`createdDate`
FROM `student_has_task`
JOIN `task` on 
	`student_has_task`.`taskId` = `task`.`taskId`
    AND `task`.`toDate` = ?
    AND `student_has_task`.`studentId` = ?
