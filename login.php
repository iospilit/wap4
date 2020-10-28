{% use '_includes_forum' %}
{% import '_functions' as func %}
{% set url = get_uri_segments() %}
{% set signin = func.signin()|trim %}
{% set run = get_data('forum')[0].data|json_decode %}
{% set title = 'Đăng nhập | Cà Phê Đắng' %}
{% if signin %}
<script language="javascript" type="text/javascript"> 
window.location.href="/community"; 
</script> 
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=/community">
{% else %}
{{block('head')}}
{% set user=get_post('user') %}
{% set pass=get_post('pass') %}
<div class="phdr">Đăng nhập</div>
<div class="menu">
{% if request_method()|lower == "post" %} 
{% if user and pass %}
{% if get_data_count('user_'~func.rwurl(user))==0 %}
<p><font color="red">Tài khoản không tồn tại.</font></p>
{% else %}
{% if func.get('user_'~func.rwurl(user),'pass')!=func.ma_hoa(pass)|trim %}
<p><font color="red">Mật khẩu không đúng.</font></p>
{% else %}
<p><font color="green">Đăng nhập thành công.</fon></p>
{{ set_cookie('token',func.get('user_'~func.rwurl(user),'token')|trim) }} 
<script language="javascript" type="text/javascript"> 
window.location.href="/community"; 
</script> 
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=/community">
{% endif %}
{% endif %}
{% else %}
<p><font color="red">Vui lòng điền đầy đủ thông tin!</font></p>
   {% endif %}
{% endif %}
<form method="post" action="">
<p>Tài khoản:</p>
<input class="form-control" type="text" name="user" placeholder="Nhập tài khoản" autofocus>
<p>Mật khẩu:</p>
<input class="form-control" type="password"  name="pass" placeholder="Nhập mật khẩu" autofocus>
<p><b style="color:red">*</b> Sử dụng tài khoản CàFêĐắng để đăng nhập !</p>
<p><input class="btn btn-primary" type="submit" name="submit" value="Đăng nhập"></p>
</form>
</div>
{#{% set checkpass = func.get('bot','pass') %}#}
{{block('end')}}
{% endif %}