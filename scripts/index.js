// Scroll header

$(document).ready(function () {
  const headerElement = $(".private-header");
  const searchContainer = $(".header-search-container");

  document.addEventListener('scroll', () => {
    if (window.scrollY > 0) {
      headerElement.addClass("scrolled");
      searchContainer.addClass("scrolled");
    } else {
      headerElement.removeClass("scrolled");
      searchContainer.removeClass("scrolled");
    }
  });

  $(".header-search").click(function () {
    $(".header-search-container").slideToggle("slow");
    $(".private-header").addClass("hovered");
  });

  $(".js-menu-btn").click(function () {
    $('#js-navbar').css({ "left": "0px" });
    $("#overlay").css({ "display": "block" });
    $("body").css({ "overflow": "hidden" });
  });

  $(".nav-close").click(function () {
    closeMenuBar();
  });

  $("#overlay").click(function (event) {
    closeMenuBar();
  });

  function closeMenuBar() {
    $("#js-navbar").css({ "left": "-500px" });
    $("#overlay").css({ "display": "none" });
    $("body").css({ "overflow": "scroll" });
  }

});
