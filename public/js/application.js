window.addEventListener('load', function () {
    loader_fade_out()
    data_table_div()
    all_images()
    datepicker_format()
})

function loader_fade_out() {
    $('.loader').fadeOut();
}

function data_table_div() {
    var myTable = $('.table-data-div').DataTable({ paging: false });
}

function all_images() {
    var allimages = document.getElementsByTagName('img');
    for (var i = 0; i < allimages.length; i++) {
        if (allimages[i].getAttribute('data-src')) {
            allimages[i].setAttribute('src', allimages[i].getAttribute('data-src'));
        }
    }
}

function datepicker_format() {
    $('.datepicker').datepicker({format: 'yyyy-mm-dd'});
}
var sidenav = document.getElementById("side-navbar");
if (sidenav) {
    $("#title").css({
        "background-color": "var(--theme)",
    });
    $("#title-text").css("color", "#fff");
}

$("#menu-btn").on("click", function () {
    $("#side-navbar").toggleClass("hiddennav");
    
    if (window.getComputedStyle(sidenav).getPropertyValue("opacity") != 0) {
        $("#title").css({
            "background-color": "var(--theme)",
        });
        $("#title-text,#menu-btn").css("color", "#fff");
        $("#main-container").css("margin-left", "16.667%");
        $("#main-container").removeClass("col-md-12");
        $("#main-container").addClass("col-md-10");
    } else {
        $("#title").css("background-color", "#fff");
        $("#title-text, #menu-btn").css("color", "unset");
        $("#main-container").css("margin-left", "0");
        $("#main-container").removeClass("col-md-10");
        $("#main-container").addClass("col-md-12");
    }
})