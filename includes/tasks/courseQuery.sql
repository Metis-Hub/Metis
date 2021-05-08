SELECT `day_has_course`.`courseId`, `teacher`.`id` AS `teacherId`, `subject`.`subjectId`, `subject`.`long` as `subject`, `day_has_course`.`isSubstiturte`, `teacher`.`salutation`, `teacher`.`name`
FROM `day_has_course`
JOIN `course` ON
	`day_has_course`.`courseId` = `course`.`courseId`
    AND `dayId` = ?
JOIN `teacher` ON `course`.`teacherId` = `teacher`.`id`
JOIN `subject` ON `course`.`subjectId` = `subject`.`subjectId`
ORDER BY courseIndex ASC;
