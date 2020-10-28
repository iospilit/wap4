{% use '_includes_forum' %}
{% import '_functions' as func %}
{% set signin = func.signin()|trim %}
{% set title = 'Đăng xuất | Cà Phê Đắng' %}
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="vi" />
<script type="text/javascript">if(navigator.userAgent.match(/iPhone/i)||navigator.userAgent.match(/iPad/i)){var viewportmeta=document.querySelector('meta[name="viewport"]');viewportmeta&&(viewportmeta.content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0",document.body.addEventListener("gesturestart",function(){viewportmeta.content="width=device-width, minimum-scale=0.25, maximum-scale=1.6"},!1))}; </script>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=yes">
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="width" />
<title>{{title}}</title>
</head>
<body>
{% if signin %}
{{delete_cookie('token')}}
Đăng xuất tài khoản thành công!
<script language="javascript" type="text/javascript"> 
window.location.href="/community"; 
</script> 
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=/community">
{% endif %}
</body>
</html>
