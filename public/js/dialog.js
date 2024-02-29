//削除ボタン押下時のダイアログ
function confirmDelete() {
  if (confirm("本当に削除しますか？")) {
      return true;
  } else {
      return false;
  }
}