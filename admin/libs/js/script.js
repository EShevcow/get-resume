// 1) Select
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});

// 2) Dropdown
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.dropdown-trigger');
  var instances = M.Dropdown.init(elems);
});

// 3) Modal
$(document).ready(function(){
  $('.modal').modal();
});

// 4) Collapsible
$(document).ready(function(){
  $('.collapsible').collapsible();
});

// 5) Tabs 
$(document).ready(function(){
  $('.tabs').tabs();
});