$('input').on('keyup',function(){
    
    let url = "/admin/searchUserOnInput?user="+$(this).val();
    
    $.ajax({
        type: "get", //HTTP通信の種類
        url: url,
        dataType: "json",
      })
        //通信が成功したとき
        .done((res) => { // resの部分にコントローラーから返ってきた値 $users が入る
           console.log(res);
          $('.hit').text('ユーザーを検索'+String(res)+'件ヒット');
        })
        //通信が失敗したとき
        .fail((error) => {
          console.log(error.statusText);
        });
})
$('#js-ajax-button').click(function(){
    value3 = $("#js-input3").val();
    url = "/admin/searchUser?user="+value3;
    $.ajax({ 
        type: "get", //HTTP通信の種類
        url: url,
        dataType: "json",
      })
        //通信が成功したとき
        .done((res) => { // resの部分にコントローラーから返ってきた値 $users が入る
            
            $('.table').empty();
            
            $.each(res, function (index, value) {
                target = value.name.replace(new RegExp(value3, 'gi'),"<span style='background-color:yellow'>$&</span>");   
                console.log(target);
                html = `
                              <tr >
                                  <td>${target}</td><td>${value.created_at}</td>
                              </tr>
                 `;
              $(".table").append(html); //できあがったテンプレートを user-tableクラスの中に追加
              });
              
          
        })
        //通信が失敗したとき
        .fail((error) => {
          console.log(error.statusText);
        });

})