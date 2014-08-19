<!DOCTYPE HTML>
<html>
<title><?=$title?></title>
<link type="text/css" rel="stylesheet" href="<?=base_url()?>style/style.css"/>
<body>
<h1>PACS SERVER</h1>
<div id="drag" draggable="true" ondragstart="drag(event)" style="cursor:pointer">Dragg me 1</div>
<code id="code1" ondrop="drop(event)" ondragover="allowDrop(event)">

</code>

<h1>PACS GATEWAY</h1>
<code id="code2" ondrop="drop(event)" ondragover="allowDrop(event)"></code>
</body>
</html>
<script>
function allowDrop(ev){
	ev.preventDefault();
}
function drag(ev){
	ev.dataTransfer.setData("drag",ev.target.id)
}
function drop(ev){
	var data = ev.dataTransfer.getData("drag");
	ev.target.appendChild(document.getElementById(data));
	ev.preventDefault();
}
</script>
