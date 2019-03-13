_Bbc(function ($) {
  if ($("#loading").length == 0) {
    $(document.body).append('<div id="loading">Loading...</div>')
  }
  $(document).ajaxStart(function () {
    $("#loading").show()
  }).ajaxStop(function () {
    $("#loading").hide()
  });
  var h = function (obj) {
    var a, b;
    if (typeof obj == "undefined") {
      obj={}
    }
    if (obj.length > 0) {
      a = $("div > b, div > small", obj);
      b = $("table td > div > h1", obj)
    } else {
      a = $(".bin-board table td > div > b, .bin-board table td > div > small");
      b = $(".bin-board table td > div > h1")
    }
    a.on("click", function () {
      if ($(this).hasClass("expander")) {
        var a = $(this).closest("td");
        var b = $("table:first", a);
        var c = $(this);
        if (b.length > 0) {
          if (b.is(":visible")) {
            b.hide("slow", function () {
              $(".glyphicon", c).removeClass("glyphicon-collapse-up").addClass("glyphicon-collapse-down")
            })
          } else {
            b.show("slow", function () {
              $(".glyphicon", c).removeClass("glyphicon-collapse-down").addClass("glyphicon-collapse-up")
            })
          }
        } else {
          $.ajax(_URL + "bin/fetch/" + $(this).data("id"), {
            success: function (d) {
              $(".glyphicon", a).removeClass("glyphicon-collapse-down").addClass("glyphicon-collapse-up");
              $(a).append(d);
              h(a);
              var b = a.offset();
              $('html, body').animate({
                scrollTop: b.top,
                scrollLeft: b.left
              },
              800)
            }
          })
        }
      } else {
        if ($(this).parent().hasClass("popup")) {
          var a = $(this).closest('td');
          var b = $("#bin-modal");
          var c = $("b", a).html();
          var d = $(".hidden", a).html();
          $(".modal-title", b).html(c);
          $(".modal-body", b).html(d);
          b.modal()
        }
      }
    });
    b.on("click", function () {
      var a = $(this).data("upline");
      var b = $(this).data("position");
      var c = $("#bin-create");
      var d = $("form", c);
      window.XX = $(this);
      $("input[name=params\\[upline\\]]", d).prop('readonly', true).val(a);
      $("#position" + b).trigger("click");
      c.modal();
      if (!window.noClonner) {
        $.ajax(_URL + 'bin/register?act=clonecheck', {
          method: "GET",
          data: {
            "upline": a,
            "position": b
          },
          dataType: "json",
          global: false,
          success: function (o) {
            if (o.ok) {
              if (o.result) {
                $("#btn-duplicate").removeClass("hidden")
              } else {
                window.noClonner = true;
                if ($("#btn-duplicate").is(":hidden")) {
                  $("#btn-duplicate").addClass("hidden")
                }
              }
            }
          }
        })
      }
    })
  };
  $("#btn-duplicate").on("click", function (e) {
    e.preventDefault();
    $(".output").html("");
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(".no-clonner").show("slow");
      if (window.cloner) {
        var c = window.cloner;
        var d = $("input[name=name]");
        d.val('');
        for (e in c.params) {
          d = $("input[name='params\\[" + e + "\\]']");
          d.val('')
        }
      }
      $("input[name=add_submit_add]").val("Register")
    } else {
      $(this).addClass("active");
      $(".no-clonner").hide("slow");
      $("input[name=add_submit_add]").val("Clone");
      if (window.cloner) {
        var c = window.cloner;
        var d = $("input[name=name]");
        var e = $("#completeudt").html() || "Please complete your data before cloning!";
        var g = true;
        d.val(c.name);
        for (f in c.params) {
          if (c.params[f] == "" && g) {
            g = false;
            if (confirm(e)) {
              document.location.href = _URL + "bin/profile_edit?return=" + encodeURIComponent(document.location.href);
              break
            }
          }
          d = $("input[name='params\\[" + f + "\\]']");
          d.val(c.params[f]).trigger("change")
        }
      }
    }
  });
  $("form", $("#bin-create")).on("submit", function (e) {
    e.preventDefault();
    var a = window.XX.parent();
    var c = window.XX.parent().parent();
    $.ajax(_URL + "bin/register?is_ajax=1", {
      method: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (o) {
        if (o.ok) {
          a.remove();
          c.append(o.html);
          $("#bin-create").modal("hide");
          h(c)
        } else {
          $(".output", $("#bin-create")).html(o.msg);
          $(".output", $("#bin-create")).focus();
          var b = $(".output", $("#bin-create")).offset();
          $('html, body, body').animate({
            scrollTop: b.top
          },
          300)
        }
      }
    })
  }).on("reset", function () {
    $("#bin-create").modal("hide")
  });
  $("#bin-create").on("hidden.bs.modal", function (e) {
    $(".output", $(this)).html("");
    $("form", $(this)).get(0).reset();
    if ($("#btn-duplicate").hasClass("active")) {
      $("#btn-duplicate").removeClass("active").trigger("click")
    }
    $("input, select", $("form", $(this))).popover('destroy').removeClass("text-danger").closest(".form-group").removeClass("has-error")
  });
  h()
});
var XX = {};
var noClonner = false;