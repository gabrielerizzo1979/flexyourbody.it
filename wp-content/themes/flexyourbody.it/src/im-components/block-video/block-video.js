// IMPORT SCSS PER LA COMPILAZIONE
import './block-video.scss';

// EXPORT COMPONENTE
const blockVideo = () => {
    let allBlockVideo = document.querySelectorAll('.im-block-video');
    if (!allBlockVideo.length) return;

    allBlockVideo.forEach((el) => {
        let videoToPlay = el.querySelector('video');
        let playButton = el.querySelector('.im-block-video__button-play');
        if (!playButton || !videoToPlay) return;

        playButton.addEventListener('click', () => {
            videoToPlay.play();
            videoToPlay.controls = true;
            playButton.classList.add('hide');
        });

        videoToPlay.onpause = () => {
            playButton.classList.remove('hide');
            videoToPlay.controls = false;
        };
    });
};

export default blockVideo;
