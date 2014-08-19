<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_m extends Model{
    function Main_m(){
        parent::Model();	
    }
    
    function getStatus(){
        $sql="select s.*  from cot_pacs_status s order by s.server, s.sgroup";
        $qr = $this->db->query($sql);
        if($qr->num_rows()>0){
            $rs = $qr->result();
        }
        else $rs = null;
        return $rs;
    }
    function getPipStorage($sv){
        $sql="select * from cot_pacs_storage where server = '$sv' and sdate = trunc(sysdate)";
        //echo $sql;
        $qr= $this->db->query($sql);
        if($qr->num_rows()>0){
            return $qr->row();
        }
        else return null;
    }
    
}

/* end of file main_m.php
 * Location ./application/model/main_m.php
 */
