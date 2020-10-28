{# Huong dan su dung xep chu:
- Chat: xep chu @<bot>: bat dau choi #}
{% use '_includes_forum' %}
{% import '_functions' as func %}
{% import '_avatar' as avatar %}
{% set url = get_uri_segments() %}
{% set signin = func.signin()|trim %}
{% set bot = 'apple' %}
{% set user = get_data('user_'~signin)[0].data|json_decode %}
{% set total = user['smile']|trim|split('.')|length-1 %}
{% set ubot = get_data('user_apple')[0].data|json_decode %}
{% set xc = ubot['xc'] %}
{% set run = get_data('forum')[0].data|json_decode %}
{% set title = 'Xếp chữ online' %}
{% if signin %}
{{block('head')}}
{% set login = func.signin()|trim %}
{% if login %}
{% if get_data_count('xep_chu')==0 %}
{% for i in 1..20 %}
{% set save=save_data('xc_'~i,{"name" :login,"time":'now'|date('U'),"comment":"tôi yêu việt nam"}|json_encode) %}
{% endfor %}
{% set save=save_data('xep_chu',' 20 @  19 @  18 @  17 @  16 @  15 @  14 @  13 @  12 @  11 @  10 @  9 @  8 @  7 @  6 @  5 @  4 @  3 @  2 @  1 @ ') %}
{% endif %}
 <div class="phdr"><a href="/games"><b>Khu giải trí</b></a> » Xếp chữ</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.7.0/jquery.validate.min.js"></script>
<script type="text/javascript">var chatbox="../xc.php",loadcontent='<div class="menu">Đang tải dữ liệu <i class="fa fa-hourglass-half"></i></div>';$(document).ready(function(){$("#idChat").html(loadcontent),$.get(chatbox,function(t){$("#idChat").html(t).hide().slideDown("slow")}),reload_chat=setInterval(function(){$.get(chatbox,function(t){$("#idChat").html(t)})},4e3);var e=$("#form"),i=$("#submit"),o=$("#alert"),a=$("#postText");e.on("submit",function(t){if(t.preventDefault(),""==a)return o.show(),o.text("Bạn chưa nhập nội dung !!!"),$("#postText").focus(),!1;$.ajax({url:"../xc.php",type:"POST",timeout:4e3,dataType:"html",data:e.serialize(),beforeSend:function(){o.fadeOut(),i.html('Đang xử lí <i class="fa fa-hourglass-half"></i>')},success:function(t){$.get(chatbox,function(t){$("#idChat").html(t).hide().slideDown("slow")}),e.trigger("reset"),$("#postText").focus(),$("#postText").val(""),i.html('<i class="fa fa-check"></i> Chat')},error:function(t){console.log(t)}})})});</script>
{% set token = random(100000) %}
{% if user['ban']=='1' %}
<div class="room" align="center"><b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></b> Bố em hút rất nhiều thuốc =))</div>
{% else %}
<div class="room"><div class="menu-room"><table width="100%" border="0"><tr><td width="80%"> <form id="form" action="" method="POST" name="form"><textarea type= "text" id="postText" name="msg" placeholder="Chat lệnh: xep chu @{{bot}} để bắt đầu." rows="2"></textarea><a class="sub3" href="javascript:tag('xep chu @apple','')"><i class="fa fa-gamepad" aria-hidden="true"></i></a><a class="sub3" href="javascript:show_hide('sm');"><i class="fa fa-smile-o" aria-hidden="true"></i></a><a class="sub3" href="/xc"><i class="fa fa-refresh" aria-hidden="true"></i></a><button name="submit" type="submit" id="submit">Gửi</button><input type="hidden" name="token" value="{{token}}"/></form></div></td></tr></table></div><div id="sm" style="display:none">{% if user['smile']!='' and (user['smile']|trim|split('.')|length-1) >= 1 %}{% for i in 1..total %}{% set i = i|trim-1 %}<a href="javascript:tag(':{{user['smile']|trim|split('.')[i]}}', ':'); show_hide('sm');"><img src="https://moleys.github.io/assets/images/{{user['smile']|trim|split('.')[i]}}.png" width="50px" /></a>{% endfor %}<div><a href="/smile">[ Xem thêm Smile ]</a></div>{% else %}<a href="javascript:tag(':pepe{{i}}', ':'); show_hide('sm');">Bạn chưa có smile cá nhân. <a href="/smile">[ + Thêm mới ]</a>{% endif %}</div></div>
{% endif %}
<div id="alert"></div>
<div id="postText"></div>
<div id="idChat"></div>

{% endif %}
{{block('end')}}
{% else %}
{% include 'login.php' %}
{% endif %}
