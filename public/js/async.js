$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
  }
});

$(function() {
                
  //削除処理
  $('.delete_btn').on('click', function() {
    const deleteConfirm = confirm('本当に削除しますか？');
 //メッセージをOKした時（true)の場合、次に進みます 
        if(deleteConfirm) {
            const productID = $(this).attr('data-product_id');

  // .ajaxメソッドでルーティングを通じて、コントローラへ非同期通信を行います。                        
            $.ajax({
                type: 'POST',
                url: '/destroy/'+productID, //productID にはレコードのIDが代入されています
                dataType: 'json',
                data: {'id':productID},
                        });
 //”本当に削除しますか？”のメッセージで”いいえ”を選択すると処理がキャンセルされます
          } else {
            return false;
          }
      });

      //検索機能
      $('.search_btn').on('click', function() {      
        // 検索条件を取得
        const formData = $(this).closest('form').serialize();
        
        const SearchRoute =  $(this).closest('form').attr('action');
        
        // Ajaxリクエストを送信
        $.ajax({
          type: 'GET',
          url: SearchRoute,
          dataType: 'json',
          data: formData,
        });

    });

    //tablesorterの処理
    $(document).ready(function(){
      $("#list_table").tablesorter();
  });
});