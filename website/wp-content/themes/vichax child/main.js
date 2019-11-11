jQuery(document).ready(function($) {
  console.log("main.js: loaded");

  var win = $(window);
  var body = $("body");

  $("#sf-future-events-select").change(function() {
    var str = "";
    $("#sf-future-events-select option:selected").each(function() {
      str = $(this).attr("value");
    });
    console.log(str);

    //ajax call
    var data = {
      action: "sf_future_events_select",
      select: str
    };

    jQuery.post(ajax_var.url, data, function(response) {
      $("#sf-future-events-content").html(response);
    });
  });

  if ($(".sf-event-legend").length) {
    win.on("load", function() {
      $(".sf-event-legend").insertAfter(".fc-toolbar");
    });
  }

  if ($(".site-content_wrap #sidebar").length) {
    var a = new StickySidebar("#sidebar", {
      topSpacing: 120,
      bottomSpacing: 50,
      containerSelector: ".site-content_wrap",
      innerWrapperSelector: ".inner-wrapper-sticky",
      minWidth: 992
    });
  }
});
