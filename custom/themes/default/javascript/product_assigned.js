$(document).ready(function () {
    $('.products-table').DataTable({
        //"paging":   false,
        "pageLength": 20,
        //    "info":     false,
        "bLengthChange": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "index.php?entryPoint=getallproducts",
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "sSearch": "Search all columns:",
            "oPaginate": {
                "sFirst": "<i class='fa fa-angle-double-left fa-2x ' aria-hidden='true'></i>",
                "sLast": "<i class='fa fa-angle-double-right fa-2x ' aria-hidden='true'></i>",
                "sNext": "<i class='fa fa-angle-right fa-2x ' aria-hidden='true'></i>",
                "sPrevious": "<i class='fa fa-angle-left fa-2x ' aria-hidden='true'></i>"
            }
        }
    });



    $(".products-table").on("click", ".update-users-button", function () {
        var id = (this.id)
        var pid = id.split("_");
//        var selected_users = $("#user_list_" + pid[1]).val();
        var product = $("#user_list_" + pid[1]).data('product');

        var selected_users = [];
        $('#assigned_attributes_' + pid[1] + ' li').each(function () {
            selected_users.push($(this).attr("id"));

        });

        if (!selected_users) {
            alert("Please select users...");
        } else {
            $.ajax({
                url: "index.php?entryPoint=updateproductusers",
                type: "post",
                data: {id: id, pid: pid[1], product: product, users: selected_users},
                success: function (result) {

                    alert(result);
                }});

        }

    })

    $(".products-table").on("change", ".user_list", function () {
        var selectedKey = $(this).find('option:selected').map(function () {
            return '<li class="list_element">' + $(this).text() + '</li>';
        }).get();
        var id = (this.id)

        $('#show_' + id + ' ul').html(selectedKey);

    });


})

$(document).ajaxStart(function () {
    $('.loading-overlay').show();
});
// Hide loading overlay when ajax request completes
$(document).ajaxStop(function () {
    $('.loading-overlay').hide();
});
