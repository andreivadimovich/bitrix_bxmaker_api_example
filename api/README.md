Модуль - <a href="http://marketplace.1c-bitrix.ru/solutions/bxmaker.api">bxmaker.api</a>
Для авторизации советуют использовать <a href="https://bxmaker.ru/doc/api/primery/avtorizatsiya/">bxmaker.avtorizatsiya</a>


<h3>Порядок выполнения API методов</h3>

<b>1.</b> Получение <u>sessid</u>
<pre>
	$.ajax({ 
	   url: 'http://l/api/',
	    type: 'GET',
	    dataType: 'json',
	    data: {
	        method: 'sale.sessid',
	    },
	    success: function (data) {
	        console.log(data.responseText);
	    }
	});
</pre>

Результат:
<pre>
	{"sessid":"71a86e073dc65e24a5ed0daf67674553"}
</pre>

<br /><br />

<b>2.</b> Получение категорий каталога
<pre>
	$.ajax({ 
	   url: 'http://l/api/',
	    type: 'GET',
	    dataType: 'json',
	    data: {
	        method: 'sale.catalog',
	        sessid : '71a86e073dc65e24a5ed0daf67674553'
	    },
	    success: function (data) {
	        console.log(data.responseText);
	    }
	});
</pre>

Результат: список подкатегорий каталога.

<br /><br />


<b>3.</b> Получение товаров по ID категории
<pre>
	$.ajax({ 
	   url: 'http://l/api/',
	    type: 'GET',
	    dataType: 'json',
	    data: {
	        method: 'sale.category',
	        sessid : '71a86e073dc65e24a5ed0daf67674553',
	        category_id : 1107
	    },
	    success: function (data) {
	        console.log(data.responseText);
	    }
	});
</pre>

Результат: список товаров подкатегории.


<i>p.s : удобно делать запросы через Advanced REST Client</i>
