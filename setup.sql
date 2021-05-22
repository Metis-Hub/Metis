CREATE TABLE IF NOT EXISTS `student` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `password` VARCHAR(60) NOT NULL,
    `name` VARCHAR(45) NOT NULL,
    `surname` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `teacher` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `password` VARCHAR(60) NOT NULL,
    `firstname` VARCHAR(45) NULL,
    `salutation` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`grade` (
    `classId` INT NOT NULL AUTO_INCREMENT,
    `className` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`classId`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`teachersClass` (
    `teacherId` INT NOT NULL,
    `classId` INT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`studentsClass` (
    `studentId` INT NOT NULL,
    `classId` INT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`task` (
  `taskId` INT NOT NULL AUTO_INCREMENT,
  `classId` INT NOT NULL,
  `courseId` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `toDate` DATE NOT NULL,
  `createdDate` DATE NOT NULL,
  PRIMARY KEY (`taskId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`student_has_task` (
  `studentId` INT NOT NULL,
  `taskId` INT NOT NULL,
  `hasDone` TINYINT NULL)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`day` (
  `idDay` INT NOT NULL AUTO_INCREMENT,
  `dayIndex` TINYINT NOT NULL,
  `priority` TINYINT DEFAULT 0,
  PRIMARY KEY (`idDay`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`day_has_class` (
  `dayId` INT NOT NULL,
  `classId` INT NOT NULL,
  `validFrom` DATE NOT NULL,
  `validTo` DATE NULL,
  `createdAt` DATE NULL)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`subject` (
  `subjectId` INT NOT NULL AUTO_INCREMENT,
  `short` VARCHAR(4) NULL,
  `long` VARCHAR(45) NULL,
  PRIMARY KEY (`subjectId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`course` (
  `courseId` INT NOT NULL AUTO_INCREMENT,
  `teacherId` INT NOT NULL,
  `subjectId` INT NOT NULL,
  PRIMARY KEY (`courseId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`day_has_course` (
  `courseId` INT NOT NULL,
  `dayId` INT NOT NULL,
  `courseIndex` TINYINT NOT NULL,
  `isSubstiturte` TINYINT NULL DEFAULT 0)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`quizzes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subjectId` int(2) NOT NULL,
  `minClass` int(2) NOT NULL,
  `maxClass` int(2) NOT NULL,
  `questionCount` int(3) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`quiztags` (
  `tagId` int(5) NOT NULL AUTO_INCREMENT,
  `quizId` varchar(3) NOT NULL,
  `tag` varchar(64) NOT NULL,
  PRIMARY KEY (`tagId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`questions` (
  `questionId` int(5) NOT NULL AUTO_INCREMENT,
  `quizId` int(5) NOT NULL,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`questionId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`answers` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `questionId` int(5) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `isCorrect` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`vocabs` (
  `vId` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(4) NOT NULL,
  `vocab` varchar(255) NOT NULL,
  `transl` varchar(255) NOT NULL,
  `niveau` int(11) NOT NULL,
  PRIMARY KEY (`vId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Metis`.`langs` (
  `langId` int(4) NOT NULL AUTO_INCREMENT,
  `langShort` varchar(8) NOT NULL,
  `lang` varchar(32) NOT NULL,
  PRIMARY KEY (`langId`))
ENGINE = InnoDB;