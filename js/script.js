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
});

function feed (){
    alert('teste');
    $.ajax({
        url: "../rest/api/alimentacao/add",
        method: "POST",
        data: { id : 'blah' },
        dataType: "html"
    }).done(function( msg ) {
        alert( "Data Saved: " + msg );
    });
}

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('../sw.js', {
        scope: '/si-pet/' // <--- THIS BIT IS REQUIRED
    }).then(function(registration) {
        // Registration was successful
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
        // registration failed :(
        console.log('ServiceWorker registration failed: ', err);
    });
}
