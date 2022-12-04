function selectYear() {
    var x = document.getElementById("chon_nam").value;
    $.ajax({
        url: "showlocnam.php",
        method: "POST",
        data: {
            id: x
        },
        success: function(data) {
            $("#myTable").html(data);
        }
    })
}

function selectQuan() {
    var x = document.getElementById("chon_quan").value;
    $.ajax({
        url: "showlocquan.php",
        method: "POST",
        data: {
            id: x
        },
        success: function(data) {
            $("#TableList").html(data);
        }
    })
}

function selectTrangThai() {
    var x = document.getElementById("chon_trangthai").value;
    $.ajax({
        url: "showloctrangthai.php",
        method: "POST",
        data: {
            id: x
        },
        success: function(data) {
            $("#TableList").html(data);
        }
    })
}