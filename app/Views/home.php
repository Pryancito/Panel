<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel for ZeusiRCd</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/css/style.css">
    <script>
function togglePassword() {
  var passwordInput = document.getElementById("password");
  var showPasswordButton = document.getElementById("show-password-btn");
  
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    showPasswordButton.textContent = "Hide";
  } else {
    passwordInput.type = "password";
    showPasswordButton.textContent = "Show";
  }
}
</script>
</head>
<body>
<div class="contenedor">
    <div class="contenido">
    <div class="circle">
        <img width="190px" height="114px" src="/logo.png" />
    </div>
    <div class="data">
        <form action="/user/login" method="post" enctype="multipart/form-data"><center>
        <table><tr style="height: 50px;"><td>NickName:</td><td><input type="text" name="nickname" placeholder="Enter your nickname." /></td></tr>
        <tr style="height: 50px;"><td>Password:</td><td><input type="password" id="password" name="password" placeholder="Enter your password." /><button type="button" class="small-btn" onclick="togglePassword()">Show</button></td></tr></table>
        <br /><button class="btn">Enter to panel</button>
        <br /><br /><a class="sub" href="/register">Sign up ( Registration ) here</a></center>
        </form>
    </div>
    </div>
</div>
</body>
</html>
