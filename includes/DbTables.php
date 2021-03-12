<?php
include "DbAccess.php";

$conn -> query("CREATE TABLE IF NOT EXISTS `student` (
                 `id` INT NOT NULL AUTO_INCREMENT,
                 `password` VARCHAR(60) NOT NULL,
                 `name` VARCHAR(45) NOT NULL,
                 `surname` VARCHAR(45) NOT NULL,
                 `email` VARCHAR(45) NOT NULL,
                 PRIMARY KEY (`id`))
                 ENGINE = InnoDB;");
            
$conn -> query("CREATE TABLE IF NOT EXISTS `teacher` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(45) NOT NULL,
              `password` VARCHAR(60) NOT NULL,
              `firstname` VARCHAR(45) NULL,
              `salutation` VARCHAR(45) NOT NULL,
              `email` VARCHAR(45) NOT NULL,
              PRIMARY KEY (`id`))
              ENGINE = InnoDB;");

$conn -> query("CREATE TABLE IF NOT EXISTS `messages` (
                       `id` int(11) NOT NULL AUTO_INCREMENT,
                       `class_id` int(11),
                       `person_id` int(11),
                       `message` varchar(700),
                       `time` smalldatetime,
                       PRIMARY KEY (`id`)");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`grade` (
                      `classId` INT NOT NULL AUTO_INCREMENT,
                      `className` VARCHAR(45) NOT NULL,
                      PRIMARY KEY (`classId`))
                      ENGINE = InnoDB");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`teachersClass` (
                      `teacherId` INT NOT NULL,
                      `classId` INT NOT NULL)
                      ENGINE = InnoDB");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`studentsClass` (
                      `studentId` INT NOT NULL,
                      `classId` INT NOT NULL)
                      ENGINE = InnoDB");

$conn -> close();
?>