<?php

$filePath;
$preprocessedFilePath;

function getParsedCsv($filePath, $format): array
{
    $transactions = [];
    $file = fopen(preProcessCSV($filePath), 'r');
    fgetcsv($file, 1000, ',');

    while (($data = fgetcsv($file, 1000, ',')) !== false) {
        if (count($data) >= 4) {
            $transactions[] = [
                'datum' => formatDate($data[0], $format) ?? '',
                'checksum' => $data[1] ?? '',
                'beschrijving' => $data[2] ?? '',
                'bedrag' => floatval($data[3]) ?? ''
            ];
        }
    }
    fclose($file);
    return $transactions;
}

function preProcessCSV($filePath): string
{
    $fileContent = file_get_contents($filePath);

    $fileContent = str_replace('"', '', $fileContent);
    $fileContent = str_replace("'", '', $fileContent);
    $fileContent = preg_replace('/;{2,}/', '', $fileContent);
    $fileContent = preg_replace('/(?<!\d)(\d+),(\d{1,2})(?!\d)/', '$1.$2', $fileContent);

    $fileContent = preg_replace_callback('/(\d{1,3}(?:,\d{3})*)(\.\d+)/', function ($matches) {
        $numberWithCommas = $matches[1];
        $decimalPart = $matches[2];
        return str_replace(',', '', $numberWithCommas) . $decimalPart;
    }, $fileContent);
    $fileContent = str_replace("\t", ",", $fileContent);
    $fileContent = preg_replace('/[^,]\s*$/m', '$0,', $fileContent);
    $tempFilePath = tempnam(sys_get_temp_dir(), 'preprocessed_csv');
    file_put_contents($tempFilePath, $fileContent);
    return $tempFilePath;
}

function formatDate($date, $format): string
{
    global $dutchMonths;

    $timestamp = str_replace("/", "-", $date);
    $date = DateTime::createFromFormat($format, $timestamp);

    if ($date) {
        $day = $date->format('j');
        $month = $date->format('m');
        $year = $date->format('Y');
        $monthName = strtolower($dutchMonths[$month]) ?? 'Onbekende maand';
        return "$day $monthName $year";
    } else {
        return "Invalid date format!";
    }
}
