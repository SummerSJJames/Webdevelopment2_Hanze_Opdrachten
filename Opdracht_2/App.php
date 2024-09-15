<?php

declare(strict_types=1);

function parseCsvFile(string $filePath): array
{
    $transactions = [];
    $file = fopen($filePath, 'r');
    fgetcsv($file, 1000, ',');

    while (($data = fgetcsv($file, 1000, ',')) !== false) {
        if (count($data) >= 4) {
            $transactions[] = [
                'datum' => formatDate($data[0]) ?? '',
                'checksum' => $data[1] ?? '',
                'beschrijving' => $data[2] ?? '',
                'bedrag' => floatval($data[3]) ?? ''
            ];
        }
    }

    fclose($file);
    return $transactions;
}

function formatDate(string $date): string
{
    $timestamp = str_replace("/", "-", $date);
    return date('j F Y',  strtotime($timestamp));
}
function calculateTotals(array $transactions): array
{
    $totals = ['income' => 0, 'expenses' => 0];

    foreach ($transactions as $transaction) {
        if ($transaction['bedrag'] >= 0) {
            $totals['income'] += $transaction['bedrag'];
        } else {
            $totals['expenses'] += $transaction['bedrag'];
        }
    }

    $totals['netto'] = $totals['income'] + $totals['expenses'];
    return $totals;
}
$transactions = parseCsvFile($filePath);
$totals = calculateTotals($transactions);

include VIEWS_PATH . 'transactions.php';