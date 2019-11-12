$(document).ready(function () {
    $("#dismiss, .overlay").on("click", function () {
        $("#sidebar").removeClass("active");
    });
    $("#sidebarCollapse").on("click", function () {
        $("#sidebar").addClass("active");
        $(".collapse.in").toggleClass("in");
        $("a[aria-expanded=true]").attr("aria-expanded", "false");
    });
});
