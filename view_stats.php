<?php
$data = json_decode(file_get_contents('click_data.json'), true);
if (!$data) $data = [];
$total_clicks = count($data);
?>

<!DOCTYPE html>
<html>
<head><title>Click Report</title></head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Total Unique Clicks: <?php echo $total_clicks; ?></h2>
    
    <table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
        <tr style="background: #f0f0f0; text-align: left;">
            <th>IP Address</th>
            <th>Country</th>
            <th>Time Clicked</th>
        </tr>
        <?php foreach (array_reverse($data) as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['ip']); ?></td>
            <td><?php echo htmlspecialchars($row['country']); ?></td>
            <td><?php echo htmlspecialchars($row['time']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>