SELECT `dayId`, `classId`
	FROM `day_has_class`
		JOIN `day` ON day_has_class.dayId = day.idDay
		AND classId = ?
		AND dayIndex = ?
		AND (validFrom <= ? AND ((validTo IS NULL) OR validTo >= ?))
	ORDER BY validFrom DESC, day_has_class.priority DESC
	LIMIT 1;
