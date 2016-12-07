{% if flash.global %}
    <div class="danger-message">{{ flash.global }}</div>
{% endif %}
{% if flash.danger %}
<div class="danger-message">{{ flash.danger }}</div>
{% endif %}
{% if flash.success %}
<div class="success-message">{{ flash.success }}</div>
{% endif %}