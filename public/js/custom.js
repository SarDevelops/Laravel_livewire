
var player = videojs('video_watch')
// player.ready(function(){
//     console.log('ready');
// })

player.on('timeupdate',function(){
    if (this.currentTime() > 3) {
        this.off('timeupdate')
        Livewire.emit('VideoViewed')
    }
})
