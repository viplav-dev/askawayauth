<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends CI_Controller
{


    function __construct()
    {
        parent::__construct();;
        $this->load->model('AccountModel');
    }
    public function index()
    {
        if ($this->session->userdata('userDetails')) {
            $this->load->view('postlogin/common/header');
        } else {
            $this->load->view('prelogin/common/login_header');
        }
        $data['logs'] = $this->AccountModel->fetchAllLoginLogs();
        $this->load->view('display', $data);
    }
    public function download()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=loginLogs_".time().".csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        $headers[] = array('loginLogId', 'loginLogIpAddress', 'loginLogCity', 'loginLogState', 'loginLogCountry', 'loginLogLoc', 'LoginLogOrg', 'loginLogPinCode', 'loginLogTimeZone', 'loginLogBrowser', 'loginLogIsRobot', 'loginLogBrowserVersion', 'loginLogMobile', 'loginLogPlatform', 'loginLogReferrer', 'loginLogUserId', 'loginLogTimestamp','loginLogSessionDuration','loginLogTotalRequests','loginLogAvgRequests');
        $data = $this->AccountModel->fetchAllLoginLogs();
        $result=array_merge($headers, $data);
        $this->outputCSV( $result);
    }
    private function outputCSV( $data)
    {
        $fp = fopen('php://output', 'w');
        foreach ($data as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}
