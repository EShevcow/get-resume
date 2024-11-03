<?php

require_once 'config/connect.php';
include_once 'objects/experience.php';

$database = new Connect;
$db = $database->getConnect();

$exp = new Experience($db);


function calculateInterval($startDate, $endDate = null) {
    // Разбираем начальную дату
    $startParts = explode('-', $startDate);
    if (count($startParts) !== 3) {
        throw new Exception("Неверный формат начальной даты");
    }
    
    $startYear = (int)$startParts[0];
    $startMonth = (int)$startParts[1];
    $startDay = (int)$startParts[2];

    // Проверяем, если дата конца отсутствует, используем текущую дату
    if ($endDate === null) {
        $endDate = date('Y-m-d');
    }

    // Разбираем конечную дату
    $endParts = explode('-', $endDate);
    if (count($endParts) !== 3) {
        throw new Exception("Неверный формат конечной даты");
    }

    $endYear = (int)$endParts[0];
    $endMonth = (int)$endParts[1];
    $endDay = (int)$endParts[2];

    // Проверяем, не является ли год окончания меньше года начала
    if ($endYear < $startYear || ($endYear == $startYear && $endMonth < $startMonth) || ($endYear == $startYear && $endMonth == $startMonth && $endDay < $startDay)) {
        throw new Exception("Вы не можете возвращаться в прошлое!");
    }

    // Создаем объекты DateTime для начальной и конечной даты
    $start = DateTime::createFromFormat('Y-m-d', "$startYear-$startMonth-$startDay");
    $end = DateTime::createFromFormat('Y-m-d', "$endYear-$endMonth-$endDay");

    // Вычисляем разницу между датами
    $interval = $start->diff($end);

    // Если прошло меньше года, возвращаем количество месяцев
    if ($interval->y === 0) {
        return "{$interval->m} месяцев";
    }

    // Если прошло год или больше, возвращаем годы и месяцы
    return "{$interval->y} лет и {$interval->m} месяцев";
}

// Пример использования
try {
    echo calculateInterval('2024-06-30') . PHP_EOL;          // Использует текущую дату как конечную
    echo calculateInterval('2022-11-30', '2025-02-28') . PHP_EOL; // Пример с заданной конечной датой
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}

$experinces = $exp->readExperience();

while($exp = $experinces->fetch(PDO::FETCH_ASSOC)){
    $podate = $exp['period'];
    $endate = $exp['period_end'];

    echo calculateInterval($podate, $endate) . PHP_EOL;

}
