<?php
/* the alexa rank class */
class alexa
{
    /* initial vars */
    var $xml;
    var $values;
    var $alexa_address;

    /* the constructor */
    function alexa($alexa_address,$domain)
    {
        $this->alexa_address = $alexa_address;
        $this->xml = $this->get_data($domain);
        $this->set();
    }

    /* gets the xml data from Alexa */
    function get_data($domain)
    {
        $url = $this->alexa_address.'http://'.$domain;
        $xml = simplexml_load_file($url) or die('Cannot retrieve feed');
        return $xml;
    }

    /* set values in the XML that we want */
    function set()
    {
        $this->values['rank'] = ($this->xml->SD->POPULARITY['TEXT'] ? number_format($this->xml->SD->POPULARITY['TEXT']) : 0);
        $this->values['reach'] = ($this->xml->SD->REACH['RANK'] ? number_format($this->xml->SD->REACH['RANK']) : 0);
        $this->values['linksin'] = ($this->xml->SD->LINKSIN['NUM'] ? number_format($this->xml->SD->LINKSIN['NUM']) : 0);
    }

    /* returns the requested value */
    function get($value)
    {
        return (isset($this->values[$value]) ? $this->values[$value] : '"'.$value.'" does not exist.');
    }
}

/* retrieve & display rank */
function getalexa($diachi)
{
$alexa_connector = new alexa('http://data.alexa.com/data?cli=10&url=',$diachi); // domain only!
$al=$alexa_connector->get('rank'); // returns 118
return $al;
}
?>