<?php
//require_once('PHPCap/autoloader.php');
use IU\PHPCap\RedCapProject;

$apiUrl = 'https://magcap.phc.ox.ac.uk/demo/api/';
$apiToken  = 'C39A8CEBFE10FC650BC413372883F209';

$project = new RedCapProject($apiUrl, $apiToken);

# Print the project title
$projectInfo = $project->exportProjectInfo();
print "project title: ".$projectInfo['project_title']."\n";

# Print the consent dates for all records
$records = $project->exportRecords();

$time_span = 5;

foreach ($records as $record) {
    $date = date('Y-m-d');

    $date_to_check = $record['consdat_cf'];

//    if(($date - $date_to_check) > $time_span){
    if($date > $date_to_check){
        print ("Send SMS for record " . $record['record_id'] . " <br>");
    }

}
?>
