<!DOCTYPE html>
<html>
<head>
    <title>Print Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }
        .company-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        .company-info .left {
            flex: 1;
        }
        .company-info .right {
            text-align: right;
        }
        .company-info h2 {
            margin: 0 0 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            background-color: #ffffff;
        }
        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .print-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        .status-0 {
            color: #007bff; /* Blue */
        }
        .status-1 {
            color: #ffc107; /* Yellow */
        }
        .status-2 {
            color: #28a745; /* Green */
        }
        .status-3 {
            color: #dc3545; /* Red */
        }
        .status-5 {
            color: #ffc107; /* Yellow */
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container" style="padding: 0 50px 0 50px;">
    <h1 style="text-align: center;"><?php echo $report_title; ?></h1>
    <div class="company-info">
        <div class="left">
            <p><strong><?php echo $company->company_name; ?></strong></p>
            <p><?php echo $company->company_address; ?></p>
        </div>
        <div class="right">
            <p>Fax: <?php echo $company->company_fax; ?></p>
            <p>Email: <?php echo $company->company_email; ?></p>
        </div>
    </div>
    <button class="print-button" onclick="printPage()" aria-label="Print Report">Print</button>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $total_grand_total = 0; ?>
            <?php foreach ($transactions as $transaction) { ?>
                <?php if ($transaction->status == '2') { ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $transaction->id_invoice ?></td>
                    <td><?php echo $transaction->created_date . ', ' . $transaction->created_time; ?></td>
                 
                    <td class="status-<?php echo $transaction->status; ?>">
                        <?php 
                        $status_text = '';
                        switch ($transaction->status) {
                            case '2':
                                $status_text = 'LUNAS';
                                $total_grand_total += $transaction->grand_total; // Sum only if status is '2'
                                break;
                        }
                        echo '<span class="status-2">' . $status_text . '</span>';
                        ?>
                    </td>
                    <td class="status-<?php echo $transaction->status; ?>">
                        <?php echo number_format($transaction->grand_total) ?>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Total</td>
                <td><?php echo number_format($total_grand_total) ?></td>
            </tr>
        </tfoot>
    </table>
    </div>
</body>
</html>
