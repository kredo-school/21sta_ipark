
<div class="container">
    <div class="row justify-content-center">
        <div class="modal fade" id="reviewModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content btn-navy:hover">
                    <div class="modal-body">
                        <form action="{{ route('review.store') }}" method="POST" id="reviewForm">
                            @csrf
                            <input type="hidden" name="reservation_id" id="reservation_id">
                            <input type="hidden" name="parking_place_id" id="parking_place_id">
                            <input type="hidden" name="selected_star" id="selected_star">
                            <div class="header text-center">
                                <div class="row h1">
                                    <i class="fa-solid fa-pen-to-square color4_navy"></i>
                                </div>
                                <div class="row h1">
                                    <div class=" color4_navy mb-1">Write a Review</div>
                                    <hr>
                                </div>
                            </div>
                            <div class="row h3 px-4 mb-3 fw-bold">
                                <span class="text-start" id="modal_parking_name"></span>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col">
                                    <div class="h3 color2_red">
                                        <div class="h3 color2_red" id="stars"></div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <label for="comment" class="col-form-label h5 col-8 text-start">Comment</label>
                                        <div class="col-8">
                                            <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter your comment here"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom text-center justify-content-center">
                                <button type="submit" class="btn rounded-pill fw-bold px-4 btn-navy fs-5 btn-sm">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
      // Write a Review ボタンがクリックされた時の処理
      $('.review-btn').click(function() {
          // ボタンに設定されているデータ属性を取得
          var parkingName = $(this).data('parking-name');
          var reservationId = $(this).data('reservation-id');
          var parkingPlaceId = $(this).data('parking-place-id');
          var modalStar = $(this).data('star');
          var comment = $(this).data('comment');
          
          // モーダルの該当箇所に取得した情報を反映
          $('#reviewModal').find('.modal-body #modal_parking_name').text(parkingName);
          $('#reviewModal').find('.modal-body #comment').val(comment);
          
          // 星の表示処理
          var modalStarHtml = '';
          for (var i = 1; i <= 5; i++) {
              if (i <= modalStar) {
                  modalStarHtml += '<i class="fa-solid fa-star star-select"></i>';
              } else {
                  modalStarHtml += '<i class="fa-regular fa-star star-select"></i>';
              }
          }
          $('#reviewModal').find('.modal-body #stars').html(modalStarHtml);
    
            // フォームのhiddenフィールドに値を設定
            $('#reservation_id').val(reservationId);
            $('#parking_place_id').val(parkingPlaceId);
            $('#selected_star').val(modalStar);
            $('#selected_star').val(modalStar);
    
          // 星の選択を処理する
          $('.star-select').click(function() {
              var selectedStar = $(this).index() + 1; // インデックスを基準に1から始める
              var modalStarHtml = '';
              for (var i = 1; i <= 5; i++) {
                  if (i <= selectedStar) {
                      modalStarHtml += '<i class="fa-solid fa-star star-select"></i>';
                  } else {
                      modalStarHtml += '<i class="fa-regular fa-star star-select"></i>';
                  }
              }
              $('#reviewModal').find('.modal-body #stars').html(modalStarHtml);
              $('#selected_star').val(selectedStar); // 選択された星の値を更新
          });
      });

    // フォームの送信処理
    $('#reviewForm').one('submit', function(event) {
        // 選択された星の数を取得
        var selectedStar = parseInt($('#selected_star').val());

        // 星が0個の場合は送信をキャンセルしてエラーを表示
        if (selectedStar === 0) {
            event.preventDefault(); // フォームの送信をキャンセル
            alert('Please select at least 1 star before posting.'); // エラーメッセージを表示
            return false;
        }
        // 星が1個以上の場合はフォームを送信
        return true;
    });
    
      // モーダルが閉じられた時、星の選択イベントを解除する
      $('#reviewModal').on('hidden.bs.modal', function() {
          $('.star-select').off('click');
      });
    });
</script>
  
