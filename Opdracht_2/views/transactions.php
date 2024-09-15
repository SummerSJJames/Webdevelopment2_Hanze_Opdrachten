<!DOCTYPE html>
<html>

<head>
    <title>Transacties</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }

        .positive {
            color: green;
        }

        .negative {
            color: red;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Datum</th>
                <th>Check #</th>
                <th>Beschrijving</th>
                <th>Bedrag</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['datum']) ?></td>
                    <td><?= htmlspecialchars($transaction['checksum']) ?></td>
                    <td><?= htmlspecialchars($transaction['beschrijving']) ?></td>
                    <td class="<?= $transaction['bedrag'] >= 0 ? 'positive' : 'negative' ?>">
                        €<?= number_format($transaction['bedrag'], 2, ',', '.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Totale Inkomsten:</th>
                <td class="positive">€<?= number_format($totals['income'], 2, ',', '.') ?></td>
            </tr>
            <tr>
                <th colspan="3">Totale Uitgaven:</th>
                <td class="negative">€<?= number_format(abs($totals['expenses']), 2, ',', '.') ?></td>
            </tr>
            <tr>
                <th colspan="3">Netto totaal:</th>
                <td class="<?= $totals['netto'] >= 0 ? 'positive' : 'negative' ?>">
                    €<?= number_format($totals['netto'], 2, ',', '.') ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>