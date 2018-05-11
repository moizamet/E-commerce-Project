<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
	function reply_check()
	{
		// alert('hello');
		v=document.getElementById("quantity").value;
		id=document.getElementById('idc').value;
		// alert('id is'+id+' and quantity is'+v);
		window.location="multivalue.php?id="+id+"&q="+v;
		// window.location="multivalue.php";

	}
	</script>
</head>
<body>
<input type="number" id="quantity"  onblur="reply_check()">
<input type="hidden" value="12" id="idc">
</body>
</html>