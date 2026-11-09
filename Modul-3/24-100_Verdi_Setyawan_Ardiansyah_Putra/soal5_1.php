<?php
$students = array(
    array("name" => "Alex", "nim" => "220401", "mobile" => "0812345678"),
    array("name" => "Bianca", "nim" => "220402", "mobile" => "0812345687"),
    array("name" => "Candice", "nim" => "220403", "mobile" => "0812345665"),
    array("name" => "Daniel", "nim" => "220404", "mobile" => "0812345611"),
    array("name" => "Elena", "nim" => "220405", "mobile" => "0812345622"),
    array("name" => "Fiona", "nim" => "220406", "mobile" => "0812345633"),
    array("name" => "Gabe", "nim" => "220407", "mobile" => "0812345644"),
    array("name" => "Hannah", "nim" => "220408", "mobile" => "0812345655")
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        table { border-collapse: collapse; min-width: 520px; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
<table>
    <thead>
        <tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student["name"]) ?></td>
                <td><?= htmlspecialchars($student["nim"]) ?></td>
                <td><?= htmlspecialchars($student["mobile"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
