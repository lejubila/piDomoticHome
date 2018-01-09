require('./bootstrap');

import Echo from 'laravel-echo'

let e = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
})

e.channel('example-channel')
    .listen('ExampleEvent', function(e){
        console.log('ExampleEvent', e)
})

e.private('example-private-channel.1')
    .listen('ExamplePrivateEvent', function (e) {
        console.log('ExamplePrivateEvent', e)
    })

$('#button-event').click(function(e){
    e.preventDefault()
    $.get('/admin/dashboard/example/event');
})