<?php

declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function parseCsvFile(string $filePath): array
{
    $transactions = str_ends_with($filePath, "gegevens-1.csv") ? getParsedCsv($filePath, 'm-d-Y') : getParsedCsv($filePath, 'd-m-Y');
    return $transactions;
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

function getFileName($input): String {
    $input = str_replace('.csv','', $input);
    $lastSlashPos = strrpos($input, '\\');
    if ($lastSlashPos !== false) {
        return substr($input, $lastSlashPos + 1);
    }
    return $input;
}

$transactions = parseCsvFile($filePath);
$totals = calculateTotals($transactions);
$fileName = ucfirst(getFileName($filePath));

include VIEWS_PATH . 'transactions.php';