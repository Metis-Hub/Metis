SELECT `day_has_course`.`courseId`, `teacher`.`id` AS `teacherId`, `subject`.`subjectId`, `day_has_course`.`courseIndex`, `subject`.`long` as `subject`, `day_has_course`.`isSubstiturte`, `teacher`.`salutation`, `teacher`.`name`
FROM `day_has_course`
JOIN `course` ON
	`day_has_course`.`courseId` = `course`.`courseId`
JOIN `teacher` ON `course`.`teacherId` = `teacher`.`id`
JOIN `subject` ON `course`.`subjectId` = `subject`.`subjectId`
WHERE `dayId` = ?
ORDER BY courseIndex ASC;
