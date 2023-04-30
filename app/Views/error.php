<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel for ZeusiRCd</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="contenedor">
    <div class="contenido">
    <div class="circle">
        <img width="190px" height="114px" src="/logo.png" />
    </div>
    <div class="data">
        <center><font style="color: <?php if ($error != "") echo "red"; else echo "green"; ?>;"><?php echo $error; ?></font></center>
    </div>
    </div>
</div>
</body>
</html>
