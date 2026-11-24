jQuery(document).ready(function ($) {
  $('.count').counterUp({
    delay: 10,
    time: 3000
  })

  
  // Match Height
  if ($('.blog-posts-wrapper .post-item').length) {
    $('.blog-posts-wrapper .post-item').matchHeight();
  }

  // Initialize color picker
  if ($('.my-color-field').length) {
    $('.my-color-field').wpColorPicker();
  }



  // /////////about section youtube image text circle //////////////

  let circle = new CircleType(document.getElementById('Circle-Txt'));
  circle.radius(45);
});



////////////////////

function baseball_sports_club_searchEmail() {
  const email = document.getElementById("email").value;
  const error = document.getElementById("error");
  const success = document.getElementById("success");

  if (emailRegex.test(email)) {
    success.textContent = "Thank you for Subscription!";
    success.style.display = "block";
    success.style.opacity = 1;

    setTimeout(function () {
      success.style.opacity = 0;
      setTimeout(function () {
        success.style.display = "none";
      }, 300);
    }, 3000);
  } else {
    error.textContent = "Invalid email";
    error.style.display = "block";
    error.style.opacity = 1;

    setTimeout(function () {
      error.style.opacity = 0;
      setTimeout(function () {
        error.style.display = "none";
      }, 300);
    }, 3000);
  }
}

