$(document).ready(() => {

    var path = filesPath;

    console.log(path)

    $('#searchInput').keyup(() => {

        var input = $('#searchInput').val();

        if(input != '') {
            $.ajax({
                url: path + '/scripts/search.php',
                method: 'POST',
                data: {input:input},
                success: function(result) {
                    $('#searchres').html(result);
                }
            });
        }

    });
});