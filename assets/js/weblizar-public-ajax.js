jQuery(document).ready(function ($) {
  /* Add or update record */
  function save(selector, form = null, alert = false, reset = true) {
    var loaderContainer = $("<span/>", {
      class: "weblizar-loader ml-2",
    });
    var loader = $("<img/>", {
      src: WEBLIZARAdminUrl + "images/spinner.gif",
      class: "weblizar-loader-image mb-1",
    });
    $(form).ajaxForm({
      beforeSubmit: function (arr, $form, options) {
        /* Disable submit button */
        jQuery(selector).prop("disabled", true);
        /* Show loading spinner */
        loaderContainer.insertAfter($(selector));
        loader.appendTo(loaderContainer);
        return true;
      },
      success: function (response) {
        if (response.success) {
          $("span.text-danger").remove();
          $(".is-valid").removeClass("is-valid");
          $(".is-invalid").removeClass("is-invalid");
          if (alert) {
            $(".wl_im_container .alert").remove();
            var alertBox =
              '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-check"></i> &nbsp;' +
              response.data.message +
              "</strong></div>";
            $(alertBox).insertBefore(form);
          }
          toastr.success(response.data.message);
          if (response.data.hasOwnProperty("reload") && response.data.reload) {
            console.log(response);
            window.location.reload();
          } else {
            if (reset) {
              $(form)[0].reset();
            }
          }
        } else {
          $("span.text-danger").remove();
          if (response.data && $.isPlainObject(response.data)) {
            $(form + " :input").each(function () {
              var input = this;
              $(input).removeClass("is-valid");
              $(input).removeClass("is-invalid");
              if (response.data[input.name]) {
                var errorSpan =
                  '<span class="text-danger">' +
                  response.data[input.name] +
                  "</span>";
                $(input).addClass("is-invalid");
                $(errorSpan).insertAfter(input);
              } else {
                $(input).addClass("is-valid");
              }
            });
          } else {
            var errorSpan =
              '<span class="text-danger">' + response.data + "<hr></span>";
            $(errorSpan).insertBefore(form);
            toastr.error(response.data);
          }
        }
      },
      error: function (response) {
        $(selector).prop("disabled", false);
        toastr.error(response.statusText);
      },
      complete: function (event, xhr, settings) {
        /* Enable submit button */
        $(selector).prop("disabled", false);
        /* Hide loading spinner */
        loaderContainer.remove();
      },
    });
  }

  /* Action to signup user */
  save(".weblizar-signup-submit", "#weblizar-signup-form", true);

  /* Action to login user */
  save(".weblizar-login-submit", "#weblizar-login-form", true);

  /* Action to update account settings */
  save(".weblizar-account-submit", "#weblizar-account-form", true);

  /* Action to register cv */
  save(".weblizar-cv-submit", "#weblizar-cv-form", true);

  /* Action to update cv */
  save(".weblizar-cv-update-submit", "#weblizar-cv-update-form", true);

  /* Action to register company */
  save(".weblizar-company-submit", "#weblizar-company-form", true);

  /* Action to update company */
  save(
    ".weblizar-company-update-submit",
    "#weblizar-company-update-form",
    true
  );

  /* Action to post job */
  save(".weblizar-post-job-submit", "#weblizar-post-job-form", true);

  /* Action to update job */
  save(
    ".weblizar-post-job-update-submit",
    "#weblizar-post-job-update-form",
    true,
    false
  );

  /* Perform action on click */
  function performActionOnClick(
    selector,
    action,
    confirmAction,
    target = null,
    htmlBefore = "",
    htmlAfter = ""
  ) {
    $(document).on("click", selector, function (e) {
      var confirmMessage = $(this).data("message");
      var id = $(this).data("id");
      if (!confirmAction || (confirmMessage && confirm(confirmMessage))) {
        var loaderContainer = $("<span/>", {
          class: "weblizar-loader ml-2",
        });
        var loader = $("<img/>", {
          src: WEBLIZARAdminUrl + "/images/spinner.gif",
          class: "weblizar-loader-image mb-1",
        });
        /* Disable submit button */
        $(selector).prop("disabled", true);
        /* Show loading spinner */
        loaderContainer.insertAfter($(selector));
        loader.appendTo(loaderContainer);

        $.ajax({
          type: "post",
          url: weblizarajaxurl,
          data: {
            security: WEBLIZARAjax.security,
            action: action,
            id: id,
          },
          success: function (response) {
            if (response.success) {
              toastr.success(response.data.message);
              if (target) {
                $(target).replaceWith(
                  htmlBefore + response.data.message + htmlAfter
                );
              }
              if (
                response.data.hasOwnProperty("reload") &&
                response.data.reload
              ) {
                if (
                  response.data.hasOwnProperty("redirect") &&
                  response.data.redirect
                ) {
                  window.location.href = response.data.redirect;
                } else {
                  window.location.reload();
                }
              }
            } else {
              toastr.error(response.data);
            }
          },
          error: function (response) {
            $(selector).prop("disabled", false);
            toastr.error(response.statusText);
          },
          complete: function (event, xhr, settings) {
            /* Enable submit button */
            $(selector).prop("disabled", false);
            /* Hide loading spinner */
            loaderContainer.remove();
          },
          dataType: "json",
        });
      }
    });
  }

  /* On apply to job */
  performActionOnClick(
    "#weblizar-job-apply-button",
    "weblizar-job-apply",
    true,
    "#weblizar-job-apply-button",
    '<div id="weblizar-job-apply-message"><i class="fa fa-check-circle text-success"></i> <span>',
    "</span></div>"
  );

  /* Delete CV */
  performActionOnClick(
    "#weblizar-cv-delete-button",
    "weblizar-cv-delete",
    true,
    "#weblizar-cv-delete-button",
    '<div id="weblizar-cv-delete-message"><i class="fa fa-check-circle text-success"></i> <span>',
    "</span></div>"
  );

  /* Delete company */
  performActionOnClick(
    "#weblizar-company-delete-button",
    "weblizar-company-delete",
    true,
    "#weblizar-company-delete-button",
    '<div id="weblizar-company-delete-message"><i class="fa fa-check-circle text-success"></i> <span>',
    "</span></div>"
  );

  /* Delete job */
  performActionOnClick(
    ".weblizar-post-job-delete-button",
    "weblizar-job-delete",
    true
  );

  /* Trigger TinyMCE on submit */
  function triggerSaveTinyMCE(button) {
    $(button).mousedown(function () {
      tinyMCE.triggerSave();
    });
  }

  triggerSaveTinyMCE(".weblizar-company-submit");
  triggerSaveTinyMCE(".weblizar-company-update-submit");
  triggerSaveTinyMCE(".weblizar-post-job-submit");
  triggerSaveTinyMCE(".weblizar-post-job-update-submit");
});
