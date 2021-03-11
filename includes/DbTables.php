<?php
include "DbAccess.php";

$conn -> query("CREATE TABLE IF NOT EXISTS `student` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(45) NOT NULL,
                      `password` varchar(60) NOT NULL,
                      `email` varchar(45) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;");
            
$conn -> query("CREATE TABLE IF NOT EXISTS `teacher` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(45) NOT NULL,
                      `password` varchar(60) NOT NULL,
                      `email` varchar(45) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;");

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
                      `classId` INT NOT NULL,
                      PRIMARY KEY (`teacherId`, `classId`),
                      ENGINE = InnoDB");

$conn -> query("CREATE TABLE IF NOT EXISTS `Metis`.`studentsClass` (
                      `studentId` INT NOT NULL,
                      `classId` INT NOT NULL,
                      PRIMARY KEY (`studentId`, `classId`),
                      ENGINE = InnoDB");

$conn -> close();
?>