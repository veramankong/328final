$(document).ready(function()
{
    $("#show").on("click", function () {
        var estimate = $("#estimate").val();
        alert(estimate);
        // display the id in div
        // $("#detail").html(petid);
        // $.post(
        //     "lookup.php",
        //     {pid: petid},
        //     function (result) {
        //         $("#detail").html(result);
        //     }
        // )

    });
}