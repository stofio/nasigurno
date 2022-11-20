$(document).ready(() => {

    var path = filesPath;

    console.log(path)

    $('#searchInput').on('keyup focus', () => {
        $('#searchres').css('display', 'none');
        var input = $('#searchInput').val();

        if(input != '') {
            $.ajax({
                url: path + '/scripts/search.php',
                method: 'POST',
                data: {input:input},
                success: function(result) {
                    $('#searchres').css('display', 'block');
                    $('#searchres').html(result);
                }
            });
        }

    });

    
    $(document).on('click', (e) => {
        if( $(e.target).attr('id') !== 'searchres' ) {
            $('#searchres').css('display', 'none');
        }
    })


});