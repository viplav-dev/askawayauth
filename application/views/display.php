<body style="background-color: white;padding-bottom:50px;">
    <button style="cursor:pointer;background-color:white!important;padding:10px!important;margin:1px solid black!important;border-radius:20px!important;margin:20px!important;" onclick="window.location.replace('<?php echo base_url('logs/download') ?>')">Download Logs as CSV</button>
    <?php
    //create a html table , fetch column name from key of array and then fetch value from value of array
    echo "<table id='logs' class='display' border='1px'>";
    echo "<thead><tr><th>ID</th><th>IP Address</th><th>City</th><th>State</th><th>Country</th><th>Latitude, Longitude</th><th>ISP</th><th>Pincode</th><th>Timezone</th><th>Browser</th><th>Is Robot</th><th>Browser Version</th><th>Device</th><th>Operating System</th><th>Referrer</th><th>User ID</th><th>Timestamp</th><th>Session Total Requests </th><th>Session Duration</th><th>Session Average Requests</th></tr></thead><tbody>";
    foreach ($logs as $key => $value) {

        echo "<tr>";
        foreach ($value as $k => $v) {
            echo "<td>" . $v . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";




    ?>
    <script>
        $(document).ready(function() {
            $('#logs').DataTable();
        });
    </script>
    <style>
        table{
            font-size: 9px;
        }
        tr:hover {
            background-color: #0d6efd11;
        }
        th{
            background-color: #f2f2f2;
        }
        th,td{
            padding: 10px;
        }
    </style>