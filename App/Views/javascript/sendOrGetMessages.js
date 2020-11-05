$(function ()
{
	//Получение списка сообщений:
	setInterval(function ()
	{
		$(".message-list").load("../Models/MessengerModel.php");
	}, 500);
	
	//Отправка данных в model
	$("button").click(function () 
	{
		let messageText = $(".message").val();
		
		let ajaxObject = 
		{	
			method: "POST",
			url: "../Models/MessengerModel.php",
			data: {message: messageText}
		};
		
		$.ajax(ajaxObject);
	});+
});