$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
    });
    
    $(function() {      

        function deleteClick(){
            // ボタンクリック時の処理を定義
            $('.delete_btn').on('click', function(e) {
                e.preventDefault();
                const deleteConfirm = confirm('本当に削除しますか？');
                let clickEle = $(this);
                const deleteID = clickEle.data('product_id');
                if (deleteConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: 'products/' + deleteID,
                        dataType: 'json',
                        data: {'id': deleteID},
                        success: function(response) {
                            console.log(response); // 応答をコンソールに出力
                            clickEle.closest('tr').remove();
                        },
                        error: function(xhr, status, error) {
                            console.error(error); // エラーをコンソールに出力
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            deleteClick(); // ボタンクリック時の処理を有効にする
        });
        
        //tablesorterの処理
        $(document).ready(function(){
            $("#list_table").tablesorter();
        });

        $('.search_btn').on('click', function(e) {
            e.preventDefault();
            let formData = $(this).closest('form').serialize();
            const SearchRoute =  $(this).closest('form').attr('action');
        $.ajax({
            type: 'GET',
            url: SearchRoute,
            dataType: 'html',
            data: formData,
            success: function(response) {
                let newTable = $(response).find("#table_wrap");
                $("#table_wrap").replaceWith(newTable);
                $(document).ready(function(){
                    $("#list_table").tablesorter();
                });
                deleteClick();
            },
                error: function(xhr, status, error) {
                console.error(error); // エラーをコンソールに出力
            }
        });
    });
    });
