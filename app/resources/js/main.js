console.log(window.Echo)

window.Echo.channel('base-channel')
    .listen('BroadcastEvent', (e) => {
        console.log(e.message);
    });
