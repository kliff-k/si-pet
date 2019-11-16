$(()=>{
    let close_sidenav_callback = function(){
        $('#sidenav').removeClass('active');
        $('#sidenav-overlay').removeClass('active');
    };

    $('#sidenav-overlay, #sidenav-dismiss').on('click', close_sidenav_callback);
    $(window).resize(close_sidenav_callback);

    $('#sidenav-toggle').on('click', function(){
        $('#sidenav').addClass('active');
        $('#sidenav-overlay').addClass('active');
    });

    $('#activate-id').on('click', () => {
        const id = $('#si-pet-id').val();
        if(!id)
        {
            alert('É necessário informar um id');
            return 0;
        }

        $.ajax({
            url: "../rest/api/login",
            method: "POST",
            data: {id: id}
        }).done(function( msg ) {
            window.location.reload();
        });
    });

    $('#feed-button').on('click', () => {
        $.ajax({
            url: "../rest/api/alimentacao/deploy",
            method: "POST"
        }).done(function( msg ) {
            alert( msg );
        });
    });

    $('#picture-button').on('click', () => {
        $.ajax({
            url: "../rest/api/photo",
            method: "POST"
        }).done(function( msg ) {
            alert( msg );
        });
    });
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('../sw.js', {
        scope: '/si-pet/'
    }).then(function(registration) {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
        console.log('ServiceWorker registration failed: ', err);
    });
}

const btn = document.querySelector('#share-button');
btn.addEventListener('click', () => {
        navigator.share({
            title: 'Pet Picture',
            text: 'Compartilhe as fotos dos seus animais',
            url: 'https://singlehorizon.com/si-pet/app/home',
        })
        .then(() =>
            resultPara.textContent = 'MDN shared successfully'
        )
        .catch((error) => console.log('Error sharing', error));
});
