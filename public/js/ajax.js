let value;
let id;
function write(){
    $('.table').empty();
    $.ajax({
        type: "get", //HTTP通信の種類
        url: "/getdata",
        dataType: "json",
      })
        //通信が成功したとき
        .done((res) => { // resの部分にコントローラーから返ってきた値 $users が入る
          $.each(res, function (index, value) {
            html = `
                          <tr >
                              <td>${value.post}</td><td><button class="button is-danger js-delete-target" id="${value.id}">消去</button>
                          </tr>
             `;
          $(".table").append(html); //できあがったテンプレートを user-tableクラスの中に追加
          });
        })
        //通信が失敗したとき
        .fail((error) => {
          console.log(error.statusText);
        });
    
}
write();


    $("#js-send-target").click(function () {
        value = $("#js-value-target").val();
        $("#js-value-target").val('');
        $(this).addClass('is-loading');
        $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });
        $.ajax({
          //POST通信
          type: "post",
          //ここでデータの送信先URLを指定します。
          url: "/ajax",
          //dataType: "json",
          data: {
            
            post: value,
          },
      
        })
          //通信が成功したとき
          .then((res) => {
            $(this).removeClass('is-loading'); 
           write();
          })
          //通信が失敗したとき
          .fail((error) => {
            console.log('失敗');
          });
      });
    $(document).on('click','.js-delete-target',function () {
        id = $(this).attr('id');
        console.log('hoge');
        $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });
        $.ajax({
          //POST通信
          type: "post",
          //ここでデータの送信先URLを指定します。
          url: "/ajax/delete",
          //dataType: "json",
          data: {
            
            post: id,
          },
      
        })
          //通信が成功したとき
          .then((res) => {
           write();
          })
          //通信が失敗したとき
          .fail((error) => {
            console.log('失敗');
          });
      });
      $('#logout').click(function(event){
        console.log('hogehoge');
        event.preventDefault();
        $("#logout-form").submit();
    })