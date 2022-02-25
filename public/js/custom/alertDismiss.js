$(function() {
  if ($(".alert-dismiss").length) {
      setTimeout(() => {
          $('.alert-dismiss').fadeOut(1500)
      }, 2000);
      setTimeout(() => {
          $('.alert-dismiss').alert('close')
      }, 3500);
  }
});
