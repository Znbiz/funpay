$(document).ready(function () {
    /**
     * Функция для второго тестового задания
     * @param  {[type]} url адрес
     */
    function urlResponse(url){
        $.ajax({
          url: url,
          beforeSend: function() {
            $('#response-body').html('<span><img src="src/jpg/loading.gif" width="40px;"/></span> Загрузка...');
          },
          success: function(data, textStatus, jqXHR) {
            $("#response-body").html('<p class="text-justify"><code id="html-data"></code></p>');
            $("#html-data").text(data);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $("#response-body").html('<p class="text-justify text-danger">'+textStatus +"<br/>" + errorThrown +'</p>');
          }
        });
    }
    $('#button-url').bind('click', function() {urlResponse($('#url').val());});
})