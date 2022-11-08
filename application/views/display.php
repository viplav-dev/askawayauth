<body style="background-color: white;padding-bottom:50px;" >
<button style="cursor:pointer;background-color:white!important;padding:10px!important;margin:1px solid black!important;border-radius:20px!important;margin:20px!important;" onclick="window.location.replace('<?php echo base_url('logs/download') ?>')">Download Logs as CSV</button>
<?php
//create a html table , fetch column name from key of array and then fetch value from value of array
echo "<table border='1'>";
echo "<tr><th>loginLogId</th><th>loginLogIpAddress</th><th>loginLogCity</th><th>loginLogState</th><th>loginLogCountry</th><th>loginLogLoc</th><th>LoginLogOrg</th><th>loginLogPinCode</th><th>loginLogTimeZone</th><th>loginLogBrowser</th><th>loginLogIsRobot</th><th>loginLogBrowserVersion</th><th>loginLogMobile</th><th>loginLogRobot</th><th>loginLogPlatform</th><th>loginLogReferrer</th><th>loginLogUserId</th><th>loginLogTimestamp</th></tr>";   
foreach($logs as $key=>$value){
    
    echo "<tr>";
    foreach($value as $k=>$v){
        echo "<td>".$v."</td>";
    }
    echo "</tr>";
    
}
echo "</table>";

 


?>