SELECT `course`.`courseId`, `course`.`teacherId`, `course`.`subjectId`, `teacher`.`salutation`, `teacher`.`name` as "teacherName", `teacher`.`email` as "teacherEmail", `subject`.`long` as "subject"
FROM `course`
JOIN `teacher` ON `course`.`courseId` = ?
AND `course`.`teacherId` = `teacher`.`id`
JOIN `subject` ON `course`.`subjectId` = `subject`.`subjectId`;