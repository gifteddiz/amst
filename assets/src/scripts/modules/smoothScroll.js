class SmoothScroll {
  constructor() {
    $(".smoothscroll").click(function(e) {
      e.preventDefault();
      var target = $($(this).attr("href"));
      var offset = target.offset().top - $(".header").height() - 70;
      $("html, body").animate(
        {
          scrollTop: offset
        },
        500
      );
    });
  }
}
export default SmoothScroll;
