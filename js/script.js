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

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then(function () {
            console.log('service worker registered');
        })
        .catch(function () {
            console.warn('service worker failed');
        });
}
