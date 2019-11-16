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

    $('#feed-button').on('click', () => {
        $.ajax({
            url: "../rest/api/alimentacao/add",
            method: "POST",
            data: { id : 'blah' },
            dataType: "html"
        }).done(function( msg ) {
            alert( msg );
        });
    });

    $('#picture-button').on('click', () => {
        $.ajax({
            url: "../rest/api/photo/add",
            method: "POST",
            data: { id : 'blah' },
            dataType: "html"
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
