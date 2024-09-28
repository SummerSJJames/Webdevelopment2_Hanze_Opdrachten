<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transacties</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Transacties</h1>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
