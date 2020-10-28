{% import '_functions' as func %}
{% from '_functions' import get,ago,bbcode %}
{% import '_avatar' as avatar %}
{% import 'chat_module_bot' as bot %}
{% set login = func.signin()|trim %}
{% set name = login %}
{% set ubot = get_data('user_apple')[0].data|json_decode %}
{% set id = func.get('guestbook')|split('@')[19]|trim %}
{% set msg = get_post('msg') %}
{% set now = "now"|date("U") %}
{% if msg != '' and msg != '\r\n' and msg!=null and msg|length <= '16000' %}
{{func.add('user_'~login,'new',msg)}} 
{% if msg and func.get('user_'~login,'old')|trim|raw != func.get('user_'~login,'new')|trim|raw %}
{% set comment = {"name" :name,"time":now,"comment":msg} %}
{{func.add('chat_'~id,'name',name)}}
{{func.add('chat_'~id,'time',now)}}
{{func.add('chat_'~id,'comment',msg)}} 
{{func.up('guestbook',id,'up') }}
{{func.add('user_'~login,'old',msg)}} 
{{func.add('user_'~login,'xu',get('user_'~login,'xu')|trim+2)}}
{{func.add('user_'~login,'postguest',get('user_'~login,'postguest')|trim+1)}}
{{bot.thayphan(msg,login)}}
{{bot.chemgio(msg,login)}}
{{bot.minigame(msg,'apple')}}
{{bot.ott(msg,'apple')}}
{% endif %}
{% endif %}
{% set data= func.get('guestbook')|trim|split('@') %}
{% set total=data|length-1 %} 
 {% set page_max=total//10 %}
{% if total//10 != total/10 %}
{% set page_max=total//10+1 %}
{% endif %}
 {% set url=get_uri_segments() %}
{% set p=url[1]|default(1) %} 

{% if p matches '/[a-zA-z]|%/' or p<1 %}
{% set p=1 %}
{% endif %}
{% if p>page_max %}
{% set p=page_max %}
{% endif %}
{% set st=p*10-10 %}
{% for id in data|slice(0,total)|slice(st,10) %}
{% set entry = get_data('chat_'~id|trim)[0].data|json_decode %}
{% set user='user_'~entry.name %}
{% set info=get_data(user)[0].data|json_decode %}
{% set nd = entry.comment %}
{% set time = entry.time %}
{% set jun = now-time %}
{% if jun > 1 %}
{% if time|date('d','Asia/Ho_Chi_Minh') == 'now'|date('d','Asia/Ho_Chi_Minh') %}
{% set agos = ago(time) %}
{% else %}
{% set agos = time|date("H:i, d/m/Y","Asia/Ho_Chi_Minh")|replace({(now|date("d/m/Y","Asia/Ho_Chi_Minh")):'Hôm nay'}) %}
{% endif %}
{% else %}
{% set agos = 'vừa xong' %}
{% endif %}
{% if entry.name %}


<div class="menu"><table id="chat" cellpadding="0" cellspacing="1"><tr><td width="auto"><img class="avt" src="{{avatar.avtdefault(entry.name)|trim}}" width="40" height="40" /></td><td><span name="online">{% if info['on'] < ('now'|date('U')-300) %}<font color="red"><i class="fa fa-toggle-off" aria-hidden="true"></i></font>{% else %}<font color="green"><i class="fa fa-toggle-on" aria-hidden="true"></i></font>{% endif %}</span> <a href="/user/{{entry.name}}.html">
{% if func.get(user,'ban') =='1' %}<s>{{get(user,'name')}}</s>{% else %}{{avatar.mau_nick(entry.name,info.right)}}{% endif %}
</a> <br/><i class="fa fa-clock-o"></i> {{agos}} {% if login!=entry.name and login %}<br/><a href="javascript:tag('@{{entry.name}} ', '')">[Tag]</a> <a href="javascript:tag('[quote]{{id|trim}}[/quote] ', '')">[Trả lời]</a>{% endif %}</td></tr></table><div class="chatbox"><span class="textchat"> </span> {% if info.ban!=null %}Nội dung đã bị ẩn do người này đã vi phạm quy định của weblog{% else %}{{bbcode(nd|raw)}}{% endif %} </div> </div>

{% endif %} 
{% endfor %}
{% if login and login not in func.get('show_online')|split('@') %}
{{func.up('show_online',login,'up')}}
{{func.add('user_'~login,'on','now'|date('U'))}}
{% endif %}
