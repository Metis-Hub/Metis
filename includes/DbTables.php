<?php
include "DbAccess.php";


## Accounts ##
$conn -> query(
"    CREATE TABLE IF NOT EXISTS `student` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `password` VARCHAR(60) NOT NULL,
        `name` VARCHAR(45) NOT NULL,
        `surname` VARCHAR(45) NOT NULL,
        `email` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
");
            
$conn -> query(
"    CREATE TABLE IF NOT EXISTS `teacher` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(45) NOT NULL,
        `password` VARCHAR(60) NOT NULL,
        `firstname` VARCHAR(45) NULL,
        `salutation` VARCHAR(45) NOT NULL,
        `email` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
");

## Grade System ##
$conn -> query(
"   CREATE TABLE IF NOT EXISTS `Metis`.`grade` (
        `classId` INT NOT NULL AUTO_INCREMENT,
        `className` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`classId`)
    ) ENGINE = InnoDB;
 ");

$conn -> query(
"   CREATE TABLE IF NOT EXISTS `Metis`.`teachersClass` (
        `teacherId` INT NOT NULL,
        `classId` INT NOT NULL
    ) ENGINE = InnoDB
");

$conn -> query(
"   CREATE TABLE IF NOT EXISTS `Metis`.`studentsClass` (
        `studentId` INT NOT NULL,
        `classId` INT NOT NULL
    ) ENGINE = InnoDB
");
## Tasks ##
$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`task` (
  `taskId` INT NOT NULL AUTO_INCREMENT,
  `classId` INT NOT NULL,
  `teacherId` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `toDate` DATE NULL,
  `createdDate` DATE NULL)
  PRIMARY KEY (`taskId`)
ENGINE = InnoDB;");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`student_done_task` (
  `studentId` INT NOT NULL,
  `taskId` INT NOT NULL)
ENGINE = InnoDB;");

## Time Table ##
# Days #
$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`day` (
  `idDay` INT NOT NULL AUTO_INCREMENT,
  `DayName` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`idDay`))
ENGINE = InnoDB;");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`day_has_class` (
  `dayId` INT NOT NULL,
  `classId` INT NOT NULL,
  `ValidFrom` DATE NOT NULL,
  `ValidTo` DATE NULL,
  `createdAt` DATE NULL,
ENGINE = InnoDB;");

# Time spans #
$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`timeSpan` (
  `spanId` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(255) NULL,
  `fromDate` DATE NOT NULL,
  `toDate` DATE NOT NULL,
  `noTask` TINYINT NULL,
  PRIMARY KEY (`spanId`))
ENGINE = InnoDB;");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`grade_has_timeSpan` (
  `classId` INT NOT NULL,
  `spanId` INT NOT NULL)
ENGINE = InnoDB;");

## Courses ##
$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`subject` (
  `subjectId` INT NOT NULL AUTO_INCREMENT,
  `short` VARCHAR(4) NULL,
  `long` VARCHAR(45) NULL,
  PRIMARY KEY (`subjectId`))
ENGINE = InnoDB;");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`course` (
  `courseId` INT NOT NULL AUTO_INCREMENT,
  `teacherId` INT NOT NULL,
  `subjectId` INT NOT NULL,
  PRIMARY KEY (`courseId`))
ENGINE = InnoDB;");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`day_has_course` (
  `courseId` INT NOT NULL,
  `dayId` INT NOT NULL,
  `isSubstiturte` TINYINT NULL DEFAULT 0)
ENGINE = InnoDB;");

## Messager ##
$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`message` (
  `messageId` INT NOT NULL AUTO_INCREMENT,
  `gradeId` INT NOT NULL,
  `teacherId` INT NULL,
  `studentId` INT NULL,
  `message` VARCHAR(700) NOT NULL,
  `time` DATETIME NOT NULL,
  PRIMARY KEY (`messageId`))
ENGINE = InnoDB;");




$conn -> close();
?>