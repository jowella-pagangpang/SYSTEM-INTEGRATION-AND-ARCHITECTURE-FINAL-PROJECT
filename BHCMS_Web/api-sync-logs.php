<?php
include 'pages/dbcon.php';

$query = "SELECT * FROM api_sync_logs ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>API Sync Logs</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            padding:30px;
        }

        h2{
            color:#2c3e50;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th, td{
            padding:12px;
            border:1px solid #ddd;
            text-align:left;
            font-size:14px;
        }

        th{
            background:#2c3e50;
            color:white;
        }

        tr:nth-child(even){
            background:#f2f2f2;
        }

        .success{
            color:green;
            font-weight:bold;
        }

        .failed{
            color:red;
            font-weight:bold;
        }

    </style>

</head>

<body>

<h2>API Synchronization Logs</h2>

<table>

    <tr>
        <th>ID</th>
        <th>Resident Name</th>
        <th>Endpoint</th>
        <th>Request Type</th>
        <th>Status</th>
        <th>Response Text</th>
        <th>Date Created</th>
    </tr>

    <?php
    while($row = mysqli_fetch_assoc($result))
    {
    ?>

    <tr>

        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['resident_name']; ?></td>
        <td><?php echo $row['endpoint']; ?></td>
        <td><?php echo $row['request_type']; ?></td>
        <td class="<?php echo strtolower($row['status']); ?>">
        <?php echo $row['status']; ?>
        </td>
        <td><?php echo $row['response_text']; ?></td>
        <td><?php echo $row['created_at']; ?></td>

    </tr>

    <?php
    }
    ?>

</table>

</body>
</html>