const articles = document.getElementById('doctable');

if(articles) {
    articles.addEventListener('click',e => {
        if(e.target.className === 'btn btn-danger delete-article') {
            if(confirm('Are You Sure')) {
                const id = e.target.getAttribute('id');

                fetch(`/article/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }

    });

}

/*$(document).ready(function(){
    $("#submit").on("click", function(event) {
        event.preventDefault();

        var form = $('#form').serialize();

        $.ajax({
            url: '/articles/new',
            type: 'POST',
            data:form,
            success: function (data, status) {

                console.log(data);


            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Ajax request failed');
            }
        });
    });
});

*/

