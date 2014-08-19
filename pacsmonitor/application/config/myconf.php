<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['gw_ip'] = '192.168.1.24';
$config['gw_name'] = 'Gateway Server';

$config['sv_ip'] = '192.168.1.25';
$config['sv_name'] = 'PACS Server';

$config['svpr']="SV_PING_RUN";
$config['svps']="SV_PING_STATUS";
$config['svdr']="SV_DICOM_RUN";
$config['svds']="SV_DICOM_STATUS";
$config['svchr']="SV_CHECKDIR_RUN";
$config['svtp']="SV_TOTAL_SPACE";
$config['svfp']="SV_FREESPACE";

$config['gwpr']="GW_PING_RUN";
$config['gwps']="GW_PING_STATUS";
$config['gwdr']="GW_DICOM_RUN";
$config['gwdss']="GW_DICOM_SND";
$config['gwdrs']="GW_DICOM_RCV";
$config['gwchr']="GW_CHECKDIR_RUN";
$config['gwned']="GW_NUMERRORDIR";
$config['gwfp']="GW_FREESPACE";
$config['gwqts']="GW_QT_STATUS";
$config['gwqtr']="GW_QT_RUN";

$config['sv_dcm_start'] = "sudo /opt/lampp/lampp start";
$config['sv_dcm_stop'] = "sudo /opt/lampp/lampp stop";
?>
