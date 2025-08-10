/* ポップアップ */
$(function () {
    $('.popup_open').on('click', function (event) {
        event.preventDefault();

        const popupId = '#' + $(this).attr('data-target');
        const $popupGroup = $(popupId).parents('.popup_content');
        const $popups = $popupGroup.children('.popup_box');
        let currentIndex = $(popupId).index();

        // ポップアップ表示
        $(popupId).fadeIn();
        $('body').append('<div class="popup_bg"></div>');
        $('.popup_bg').fadeIn();

        // 閉じるボタン追加
        const popupClose = `
            <div class="popup_close">
                <span></span>
                <span></span>
            </div>`;
        $(popupId).append(popupClose);

        // 背景や閉じるボタンでポップアップを閉じる
        $('.popup_bg, .popup_close').on('click', function () {
            $popups.eq(currentIndex).fadeOut();
            $('.popup_bg, .popup_nav, .popup_close').fadeOut(function () {
                $('.popup_bg, .popup_nav, .popup_close').remove();
            });
        });

        updateNav();
    });
});


/* リストに画像を追加・削除 */
document.addEventListener('DOMContentLoaded', function () {
  const deckArea = document.querySelector('#addListArea');
  const deckList = [];

  document.querySelectorAll('.addList').forEach(button => {
    button.addEventListener('click', function () {
      const cardElement = this.closest('.img-contents');
      const cardImg = cardElement.querySelector('img')?.getAttribute('src');
      if (!cardImg) return;

      const index = deckList.findIndex(card => card.img === cardImg);
      if (index === -1) {
        deckList.push({ img: cardImg, element: cardElement.cloneNode(true), num: 1 });
      } else if (deckList[index].num < 4) {
        deckList[index].num += 1;
      }

      updateDeck();
    });
  });

  document.querySelectorAll('.removeList').forEach(button => {
    button.addEventListener('click', function () {
      const cardElement = this.closest('.img-contents');
      const cardImg = cardElement.querySelector('img')?.getAttribute('src');
      if (!cardImg) return;

      const index = deckList.findIndex(card => card.img === cardImg);
      if (index !== -1) {
        deckList[index].num -= 1;
        if (deckList[index].num <= 0) {
          deckList.splice(index, 1);
        }
      }

      updateDeck();
    });
  });

  function updateDeck() {
    deckArea.innerHTML = '';
    deckList.forEach(card => {
      const cloned = card.element.cloneNode(true);
      const qty = document.createElement('div');
      qty.className = 'cardQty';
      qty.textContent = card.num;

      // 既存の cardQty を削除
      cloned.querySelectorAll('.cardQty').forEach(el => el.remove());
      cloned.appendChild(qty);

      deckArea.appendChild(cloned);
    });
  }
});