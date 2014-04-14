<?php


$the_url = isset($_REQUEST['url']) ? htmlspecialchars($_REQUEST['url']) : '';
?>

<link href="../../css/default1.css" rel="stylesheet" type="text/css">
<form method="post">
<center>
  <h1 id="title">PHP Mail/Pass Parser 6/25</h1>
  <p>Please enter full URL of the page to parse (including http://):</p>
  <p> (Example: http://www.vefamily.com/checkmailpass/mail.htm )<br /><br>
    <input type="text" name="url" size="100" value="<?php echo $the_url;  ?>"/>
  </p>
  <p>
    Or enter text directly into Textarea below:</p>
  <p> ( Example: nothingve@gmail.com | quadeptrai )</p>
  <p>
    <textarea name="text" cols="100" rows="20"></textarea>
  </p>
  <p><br />
    <input type="submit" value=" Get Mail/Pass ! " />
  </p>
</center>
</form>

<?php
if (isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {
  // fetch data from specified url
  $text = file_get_contents($_REQUEST['url']);
}
elseif (isset($_REQUEST['text']) && !empty($_REQUEST['text'])) {
  // get text from text area
  $text = $_REQUEST['text'];
}

// parse emails
if (!empty($text)) {
  $res = preg_match_all(
    "/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4} \| [A-Z0-9._%+-]{6,25}/i",
    $text,
    $matches
  );
echo "<center><font color='PaleGreen'>";
  if ($res) {
	  
    foreach(array_unique($matches[0]) as $emailpass) {
      echo $emailpass . "<br />";
	  
    }
	
  }
  else {
    echo "No emails & passwords found.";
  }
echo "</font></center>";
}

?>