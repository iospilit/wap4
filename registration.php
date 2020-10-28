{% use '_includes_forum' %}
{% import '_functions' as func %}
{% from 'function.twig' import mi_add %}
{% from 'func.twig' import get,mi_get,html_decode %}
{% set url = get_uri_segments() %}
{% set signin = func.signin()|trim %}
{% set run = get_data('forum')[0].data|json_decode %}
{% if get_get('act')=='faq' %}
{% set title = 'Quy định sử dụng' %}
{% else %}
{% set title = 'Đăng ký tài khoản | Cà Phê Đắng' %}
{% endif %}
{% if signin %}
<script language="javascript" type="text/javascript"> 
window.location.href="/community"; 
</script> 
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=/community">
{% else %}
{{block('head')}}
{% if get_get('act')=='faq' %}
<div class="phdr"><b>Giới thiệu</b></div>
<div class="menuItem" style="background-color:#e9ccd2;">
<b>CàFêĐắng</b> là web chat giải trí dành cho các thành viên, tại đây bạn thoải mái giao lưu, kết bạn, nhắn tin và đăng chủ đề, mua bán và nhiều tiện ích khác!
</div>
<div class="phdr"><b>Quy Định Sử Dụng</b></div>
<div class="list-login"><p><b>1) CẤM:</b><br/><br/><b>1.1</b> Đăng tin quảng cáo.<br/><b>1.2</b> Đăng nội dung liên quan đến vấn đề phân biệt sắc tộc, tôn giáo, quốc gia.<br/><b>1.3</b> Không đăng nội dung thô tục, khiêu dâm, quấy rối tình dục, vu khống, đe dọa người khác.<br/><b>1.4</b> Không được đăng nội dung xúc phạm một chủ thể cụ thể, đặc biệt là thành viên trong diễn đàn.<br/><b>1.5</b> Cố tình giả mạo thành viên khác với bất kỳ mục đích nào.<br/><b>1.6</b> Đăng bài cùng một nội dung nhiều lần trong một hay nhiều chủ đề khác nhau.<br/><b>1.7</b> Đăng lại bài viết hoặc tạo lại chủ đề đã bị xóa bởi Ban quản trị.<br/><b>1.8</b> Đăng bài có nội dung không liên quan đến tiêu đề.<br/><br/><b>2) TUYỆT ĐỐI CẤM:</b><br/><br/><b>2.1</b> Tạo chủ đề than phiền về thành viên hoặc cách hoạt động của điều hành viên. Hãy sử dụng tin nhắn riêng cho vấn đề này<br/><b>2.2</b> Đăng ký nick chứa ký tự gây khó chịu cho người khác<br/><br/><b>3) KHÔNG CHẤP NHẬN:</b><br/><br/><b>3.1</b> Trích dẫn nội dung quá dài hoặc trích dẫn lại một bài đăng chứa một trích dẫn khác.<br/><b>3.2</b> Bài viết tin chỉ chứa liên kết đến các trang web khác. <br/><b>3.3</b> Đăng bài bằng ngôn ngữ không sử dụng chữ cái latin (a-z).<br/><b>3.4</b> Đăng bài không có mục đích: chỉ có biểu tượng vui hoặc bài như "Ok", "Có ai không?",... <br/><br/>Quy định trên đây có thể thay đổi bất kỳ lúc nào.<br />Quy định này áp dụng cho tất cả các thành viên và Ban quản trị, thành viên vi phạm nhiều lần sẽ bị ban, vi phạm nặng có thể dẫn đến xóa bỏ tài khoản vĩnh viễn.</p></div>
<div class="menuItem" align="center">
Click <a href="/{{url[0]}}">đăng ký</a> nếu bạn đã đọc, hiểu rõ và sẽ chấp hành những quy định trên của cộng đồng !</div>
{% else %}
<div class="phdr">Đăng ký</div>
{% if run.account <= '500' %}
<div class="gmenu">
{# kiểm tra và lưu tài khoản #}
{% set user = get_post('user') %}
{% set pass = get_post('pass') %} 
{% set repass = get_post('repass') %} 
{% set mbv = get_post('captcha') %}
{% set captcha = get_cookie('captcha')|lower %}
{% set token=func.token()|trim %}
{% set registration %}
<p>{{block('mem')}}</p>
<form method="post" action="">
<p>Tài khoản:</p>
<input class="form-control" type="text" name="user" value="" required>
<p><div class="rmenu"><b style="color:red">*</b> Tên tài khoản khi đăng ký không vượt quá 15 kí tự và tối tiểu phải đặt 3 kí tự, mật khẩu dài tùy ý.</div></p>
<p>Mật khẩu:</p>
<input class="form-control" type="password"  name="pass" value="" required>
<p>Nhập lại mật khẩu:</p>
<input class="form-control" type="password" name="repass" value="" required>
<p>Mã xác nhận: [ <b>{{captcha}}</b> ]</p>
<input class="form-control" type="number" name="captcha" value="" required>
<p>{{captcha()|raw}}</p>
<p><input class="btn btn-primary" type="submit" name="submit" value="Đăng ký"></p></form>
{% endset %}
{% if request_method()|lower == "post" %}
{% if user and pass and repass and mbv %} 
{% if ("now"|date("U") < run.time_reg )%}   
<p><font color="red">Xin lỗi vì sự cố này, bạn có thể tiếp tục đăng ký tài khoản sau {{run.time_reg - "now"|date("U")}} giây</font></p>
{% elseif pass!=repass %}
<p><font color="red">Mật khẩu xác nhận không đúng.</font></p>
{% elseif captcha!=mbv %}
<p><font color="red">Mã xác nhận không đúng.</font></p>
{% else %}
{% if get_data_count('user_'~func.rwurl(user))>0 %} 
<p><font color="red">Tài khoản đã tồn tại.</font></p>
{{registration}}
{% elseif user|length<3 or user|length>15 %}
<p><font color="red">Tài khoản không dài quá 15 kí tự, tối thiểu 3 kí tự</font></p>
{{registration}}
{% elseif user=='admin' %}
<p><font color="red">Bạn không thể đăng ký sử dụng tài khoản này !</font></p>
{{registration}}
{% else %} 
{% if user matches '/^[a-zA-Z0-9\\-\\_]+[a-zA-Z0-9\\-\\_]$/' %} 
{# xác minh người máy #}
{% set data={"id":run.account|trim+1,"name":user,"nick":user,"pass":func.ma_hoa(pass)|trim,"right":"0","xu":"5000","luong":"10","avatar":"0.0.0.0.0.0.0.0.0.0.0.0.0","avt":"x1","abia":1,"token":token,"reg":"now"|date("U"),"cb":"autoload","chest":{"ao":"0.","quan":"0.","canh":"0.","docamtay":"0.","khac":"0.","khuonmat":"0.","kinh":"0.","mat":"0.","matna":"0.","non":"0.","nen":"0.","thucung":"0.","toc":"0."},"hp":{"min":"50","max":"50"},"sm":"100"} %}
{% set status = save_data_captcha("user_"~func.rwurl(user),data|json_encode) %}
{% if status == 'CAPTCHA_ERR' %}
<p><font color="red">Vui lòng xác minh Tôi không phải là người máy!</font></p>
{{registration}}
{% else %}
<div class="f">
<p><b><big>Dữ liệu thông tin:</big></b></p>
<p><b>Tài khoản:</b> {{user}} </p>
<p><b>Mật khẩu:</b> {{pass}} </p>
<p><a href="/login.php"><button class="btn btn-primary">Đăng nhập</button></a> | <a href="/community">Cộng đồng</a></p>
</div>
{% set old_token = html_decode(get('token'))|replace({'”':'"'}) %}
{% set new_token = old_token|json_decode|merge({(token):(user)}) %}
{{mi_add('token',(new_token))}}
{#{{func.add('token',token,user)}}#}
{{func.add('forum','new_mem',user)}}
{{func.add('forum','time_reg',"now"|date("U")+50)}}
{{func.add('forum','account',run.account|trim+1)}}
{{func.up('member',func.rwurl(user),'up')}}
{{set_cookie('token',token)}}
{{set_cookie('captcha',random(1000..9999))|lower}}
{% endif %}
{# kết thúc xác minh #}
{% else %}
<p><font color="red">Tài khoản không được chứa ký tự đặc biệt.</font></p>
{{registration}}
{% endif %} 



{% endif %}
{% endif %}
{% else %}
<p><font color="red">Vui lòng điền đầy đủ thông tin và xác minh Tôi không phải là người máy!</font></p>
{{registration}}
{% endif %}
{% else %}
{{registration}}
{% endif %}
</div>
{% else %}
<div class="rmenu menuItem">
Đăng ký tạm thời đóng cửa !
</div>
{% endif %}
{% endif %}
{{block('end')}}
{% endif %}