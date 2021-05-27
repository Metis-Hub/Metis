INSERT INTO `answers` (`id`, `questionId`, `answer`, `isCorrect`) VALUES
(1, 1, 'ein Mensch', 1),
(2, 1, 'ein Gott', 0),
(3, 1, 'ein Schüler', 1),
(4, 2, 'Info 5', 0),
(5, 2, 'Info 2', 1),
(6, 2, ' Info 3', 0),
(7, 3, 'Metis', 1),
(8, 3, 'Google', 0),
(9, 3, 'PIM', 0),
(10, 3, 'Zitaeu', 0);

INSERT INTO `course` (`courseId`, `teacherId`, `subjectId`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 1, 5),
(6, 1, 3);

INSERT INTO `day` (`idDay`, `dayIndex`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 1);

INSERT INTO `day_has_class` (`dayId`, `classId`, `priority`, `validFrom`, `validTo`) VALUES
(1, 1, 0, '2020-01-01', '2022-01-01'),
(2, 1, 0, '2020-01-01', '2022-01-01'),
(3, 1, 0, '2020-01-01', '2022-01-01'),
(4, 1, 0, '2020-01-01', '2022-01-01'),
(5, 1, 0, '2020-01-01', '2022-01-01'),
(6, 2, 0, '2020-01-01', '2022-01-01');

INSERT INTO `day_has_course` (`courseId`, `dayId`, `courseIndex`, `isSubstitute`) VALUES
(1, 1, 1, 0),
(1, 1, 2, 0),
(3, 2, 1, 0),
(3, 2, 2, 0),
(4, 2, 3, 0),
(4, 2, 4, 0),
(5, 2, 5, 1),
(2, 3, 1, 0),
(2, 3, 2, 0),
(3, 3, 3, 0),
(4, 3, 4, 1),
(6, 4, 3, 0),
(6, 4, 4, 0),
(0, 6, 3, 0),
(5, 1, 5, 0),
(5, 1, 6, 0),
(0, 6, 3, 0),
(0, 6, 3, 0),
(0, 6, 3, 0),
(2, 6, 3, 0),
(2, 6, 4, 0),
(4, 5, 1, 0),
(4, 5, 2, 0),
(3, 5, 3, 0);

INSERT INTO `grade` (`classId`, `className`) VALUES
(1, 'Info 2'),
(2, 'Praxis 2a');

INSERT INTO `langs` (`langId`, `langShort`, `lang`) VALUES
(1, 'eng', 'Englisch'),
(2, 'frz', 'Französisch'),
(3, 'lat', 'Lateinisch');

INSERT INTO `questions` (`questionId`, `quizId`, `question`) VALUES
(1, 1, 'Wer ist Bruno'),
(2, 1, 'In welchen SRZ-Kurs geht Bruno?'),
(3, 1, 'Wie heißt das Jahresprojekt, an dem Bruno gearbeitet hat?');

INSERT INTO `quiztags` (`tagId`, `quizId`, `tag`) VALUES
(1, '1', 'bruno');

INSERT INTO `quizzes` (`id`, `name`, `subjectId`, `minClass`, `maxClass`, `questionCount`) VALUES
(1, 'Bruno', 4, 1, 13, 3);

INSERT INTO `student` (`id`, `password`, `name`, `surname`, `email`) VALUES
(1, '$2y$05$aDrssQfa9WN1kL87MTvF0.5J81lV/RWAJqHumbkR135YkeukfdfPS', 'Bruno', 'Hoffmann', 'bruhoff@metis.de'),
(2, '$2y$05$NO5zaTsiv9vRkzPya1oRkexfHzVlTjjNqLHl21sI8opf9DJkdIM9W', 'Karl', 'Jahn', 'karjahn@metis.de'),
(3, '$2y$05$B.x64AclHdZ05MY06wQuaOxKO4kdxEMTtJXRJemJLTEThJG0.Tmm6', 'Jakob', 'Paridon', 'jakpari@metis.de');

INSERT INTO `studentsclass` (`studentId`, `classId`) VALUES
(2, 2),
(3, 2),
(2, 1),
(3, 1),
(1, 1),
(1, 2);

INSERT INTO `subject` (`subjectId`, `short`, `long`) VALUES
(1, 'ma', 'Mathematik'),
(2, 'info', 'Informatik'),
(3, 'de', 'Deutsch'),
(4, 'ge', 'Geschichte'),
(5, 'sp', 'Sport');

INSERT INTO `teacher` (`id`, `name`, `password`, `salutation`, `email`, `seeAdmin`) VALUES
(1, 'Unger', '$2y$05$7JDrGVqzE1oDb1uXvxkJb.4BOB3dQudZxpJv3XGp8MZ6Xm7lKgsM6', 'Herr Dr.', 'unger@metis.de', 1),
(2, 'Stock', '$2y$05$4BEliZ5BxXxsE4y3LvUiGuDtHqht7EeCaFBzywE04dQEm8pI4Kj3K', 'Herr', 'stock@metis.de', 1),
(3, '1', '$2y$05$hVfJkg1F4LX7omPnOrg3leDNJsIB5sVNfK2uU5qgOjuzZy/hsOpm.', 'Lehrer', 'lehrer1@metis.de', 0),
(4, '2', '$2y$05$daN/xR1iANNBkMYN2MVvwO9r.HmrnvRJeYcF0fzGUyXJLsz18q6Vy', 'Lehrer', 'lehrer2@metis.de', 0);

INSERT INTO `vocabs` (`vId`, `lang`, `vocab`, `transl`, `niveau`) VALUES
(1, 1, 'Car', 'Auto', 6),
(2, 1, 'Plane', 'Flugzeug', 6),
(3, 1, 'Tree', 'Baum', 6),
(4, 1, 'School', 'Schule', 6),
(5, 2, 'Voiture', 'Auto', 6),
(6, 2, 'Velo', 'Fahrrad', 6);
