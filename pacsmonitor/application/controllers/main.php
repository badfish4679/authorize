<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Controller
{

    function Main()
    {
        parent::Controller();
        //   $this->load->model('main_m');
    }

    function index()
    {
        $data['title'] = 'PACS Monitor';
        $data['body'] = $this->loadMain();
        $this->load->view('container_v', $data);
    }

    function loadMain()
    {
//        $status = $this->main_m->getStatus();
//        var_dump($status);
        $data = array();
        $data['gw_ip'] = $this->config->item('gw_ip');
        $data['sv_ip'] = $this->config->item('sv_ip');
        $data['gw_name'] = $this->config->item('gw_name');
        $data['sv_name'] = $this->config->item('sv_name');
        $data['gw_ping'] = 'ping';
        $data['gw_dicom'] = 'dicom';
        $data['gw_process'] = 'process';
        $data['gw_disk'] = 'disk';
        $data['sv_ping'] = 'ping';
        $data['sv_dicom'] = 'dicom';
        $data['sv_disk'] = 'disk';
        //$data['chart'] = $this->pieChart($this->config->item('sv_ip'));
        $str = $this->load->view("main_v", $data, true);
        return $str;
    }

    function jloadstatus()
    {
        if (($server = $this->loadstatus()) != null) {
            $this->load->plugin('json');
            $JS = JSON();
          //  $resp['status'] = $server;
            header('Content-type: application/json;charset=UTF-8');
            echo $server;
           // echo $JS->encode($resp);
        }
    }

    function loadstatus()
    {
        //$status = $this->main_m->getStatus();

        $status= '{"status":{"SV_PING_RUN":{"job":"SV_PING_RUN","server":"192.168.1.25","content":null,"status":"2014\/08\/18 23:28:20","group":"1","crrtime":1408437971},"SV_PING_STATUS":{"job":"SV_PING_STATUS","server":"192.168.1.25","content":"192.168.1.24","status":"0","group":"1","crrtime":1408437971},"SV_DICOM_RUN":{"job":"SV_DICOM_RUN","server":"192.168.1.25","content":null,"status":"2014\/08\/18 23:30:34","group":"2","crrtime":1408437971},"SV_DICOM_STATUS":{"job":"SV_DICOM_STATUS","server":"192.168.1.25","content":null,"status":"1","group":"2","crrtime":1408437971},"SV_CHECKDIR_RUN":{"job":"SV_CHECKDIR_RUN","server":"192.168.1.25","content":null,"status":"2014\/08\/18 23:29:36","group":"3","crrtime":1408437971},"SV_FREESPACE":{"job":"SV_FREESPACE","server":"192.168.1.25","content":"6539760","status":null,"group":"3","crrtime":1408437971},"SV_TOTAL_SPACE":{"job":"SV_TOTAL_SPACE","server":"192.168.1.25","content":"0","status":null,"group":"3","crrtime":1408437971}}}';
        return $status;

        $server = array();
        if ($status != null) {
            foreach ($status as $row) {
                $server[$row->JOB] = array(
                    "job" => $row->JOB,
                    "server" => $row->SERVER,
                    "content" => $row->CONTENT,
                    "status" => $row->STATUS,
                    "group" => $row->SGROUP,
                    "crrtime" => time());
            }
            return $server;
        }
        else {
            return null;
        }

    }

    function barChart($sv, $datefrom = "", $dateto = "")
    {
        $datediff = date_diff(new DateTime($datefrom), new DateTime($dateto));
        $diffday = $datediff->format("%d");
        //return $diffday;
        $sql = "select * from cot_pacs_storage where server = '$sv' and to_char(sdate,'mm/dd/yy') >=  '" . $datefrom . "' and to_char(sdate,'mm/dd/yy') <= '" . $dateto . "'";
        $qr = $this->db->query($sql);
        $num = $qr->num_rows();
        if ($num > 0) {
            $rs = $qr->result();
            $sql = "select c.* from ( select b.*,rownum r from (select a.* from cot_pacs_storage a where to_char(a.sdate,'mm/dd/yyyy') < '" . $datefrom . "' order by sdate desc) b) c where c.r<2";
            $qr2 = $this->db->query($sql);
            if ($qr2->num_rows() > 0) {
                $rt = $qr2->row();
                $firstfp = $rt->FREE; // lay du lieu ban dau de tinh dung luong su dung
            }
            else {
                $firstfp = -1;
            }
            if ($num <= 7) { // ve theo ngay neu khoang cach duoi 7 ngay
                $i = 0;
                foreach ($rs as $row) {
                    if ($firstfp >= 0) {
                        $arrData[$i][0] = $row->SDATE;
                        $arrData[$i][1] = ($firstfp - $row->FREE) * 1000; //dung luong da dung trong khoang thoi gian,tinh theo byte
                        $firstfp = $row->FREE;
                        $i++;
                    }
                    else {
                        $firstfp = $row->FREE;
                        continue;
                    } //neu truoc do chua co du lieu thi ngay dau tien trong kq se bo qua de lay du lieu ban dau
                }
            }
            else if ($num > 7 && $num < 90 && ($num / 7) < 12) { //ve theo tuan neu khoang cach duoi 3 thang
                $i = 0;
                $week = 0;
                $j = 0;
                foreach ($rs as $row) {
                    if ($firstfp >= 0) {
                        if ($week == 0 || $week == 7 || $j == (count($rs) - 1)) { //neu la dau tuan hoac sang tuan tiep theo hoac la row cuoi cung
                            $week = 1; //bat dau dem lai
                            $arrData[$i][0] = $row->SDATE;
                            $arrData[$i][1] = ($firstfp - $row->FREE) * 1000; //dung luong da dung trong khoang thoi gian
                            $firstfp = $row->FREE;
                            $i++;
                        }
                        else {
                            $week++;
                            continue;
                        }
                    }
                    else {
                        $firstfp = $row->FREE;
                        continue;
                    }
                    $j++; //dem row trong rs
                }
            }
            else { // tren 3 thang thi ve theo thang
                $i = 0;
                $month = 0;
                $j = 0;
                foreach ($rs as $row) {
                    if ($firstfp >= 0) {
                        if ($month == 0 || $month == 30 || $j == (count($rs) - 1)) { //neu la dau thang hoac sang thang tiep theo hoac la row cuoi cung
                            $month = 1; //bat dau dem lai
                            $arrData[$i][0] = $row->SDATE;
                            $arrData[$i][1] = ($firstfp - $row->FREE) * 1000; //dung luong da dung trong khoang thoi gian
                            $firstfp = $row->FREE;
                            $i++;
                        }
                        else {
                            $month++;
                            continue;
                        }
                    }
                    else {
                        $firstfp = $row->FREE;
                        continue;
                    }
                    $j++; //dem row trong rs
                }
            }

//        $arrData[0][0] = 'Dung luong trong';
//        $arrData[1][0] = 'Dung luong da dung';
//        $arrData[0][1] = $rsdata->FREE*1000;
//        $arrData[1][1] = ($rsdata->TOTAL - $rsdata->FREE)*1000;
            $FC = FusionCharts("Column3D", "500", "300");
            $FC->addChartDataFromArray($arrData);
            $strParam = "caption=THONG KE SU DUNG O CUNG SERVER " . $sv . ";decimalPrecision=0;animation=1";
            $FC->setChartParams($strParam);
            $FC->setChartMessage("ChartNoDataText=Chart Data not provided; PBarLoadingText=Please Wait.The chart is loading...");
            return $FC->renderChart(false, false);
        }
        else return "Khong co du lieu do thi";


    }

    function pieChart($sv)
    {
        $rsdata = $this->main_m->getPipStorage($sv);
        if ($rsdata != null) {
            $arrData[0][0] = 'Dung luong trong';
            $arrData[1][0] = 'Dung luong da dung';
            $arrData[0][1] = $rsdata->FREE * 1000;
            $arrData[1][1] = ($rsdata->TOTAL - $rsdata->FREE) * 1000;
            $FC = FusionCharts("Pie2D", "300", "200");
            $FC->addChartDataFromArray($arrData);
            $strParam = "caption=THONG KE DUNG LUONG O CUNG SERVER " . $sv . ";decimalPrecision=0;animation=1";
            $FC->setChartParams($strParam);
            $FC->setChartMessage("ChartNoDataText=Chart Data not provided; PBarLoadingText=Please Wait.The chart is loading...");
            return $FC->renderChart(false, false);
        }
        else return "Khong co du lieu do thi";
    }

    function drawchart()
    {
        $type = $this->input->post('type');
        $sv = $this->config->item('sv_ip');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        switch ($type) {
            case 'pie':
                echo $this->pieChart($sv);
                break;
            case 'bar':
                echo $this->barChart($sv, $datefrom, $dateto);
                break;
            default:
                echo "Khong co kieu bieu do nay.";
                break;
        }
    }

    function savecmd()
    {
        $cmd = $this->input->post("cmd");
        $sv = $this->input->post("sv");
        $scmd = "";
        switch ($cmd) {
            case "start_sv_dcm":
                $scmd = $this->config->item("sv_dcm_start");
                break;
            case "stop_sv_dcm":
                $scmd = $this->config->item("sv_dcm_stop");
                break;
            default:
                $scmd = "";
                break;
        }
        if ($scmd != "") {
            $sql = "insert into cot_pacs_cmd (cmd,server,stime,cstatus) values (" . $this->db->escape($scmd) . "," . $this->db->escape($sv) . ",sysdate,0)";
            if ($this->db->query($sql)) echo 'Gui lenh thanh cong, xin doi giay lat';
            else echo 'Gui lenh that bai';
        }
        else echo 'Lenh khong dung';
    }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
