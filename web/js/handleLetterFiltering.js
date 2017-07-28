function submitLetterFiltering() {
  var letterSelect = document.getElementsByClassName('letter-filtering')[0];
  var text = letterSelect.options[letterSelect.selectedIndex].text;
  document.cookie = "letterOption=" + text;
  document.location.reload(true);
}