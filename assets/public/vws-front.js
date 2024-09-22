const hostName = window.location.origin;
const widgetStylesUrl = hostName + "/wp-content/plugins/video-widget-simple/assets/public/vws-front.min.css";
const linkStyle = `
        <style id="vws-front-css">
            @import url("${widgetStylesUrl}");
        </style>`;

const getContent = hostName + "/wp-content/plugins/video-widget-simple/widget-get.php?key=vws-video-widget-simple";

let thisPage = window.location.origin + window.location.pathname;
let thisPage_ = thisPage.slice(0, -1);
let thisPath = window.location.pathname;
let thisPath_ = thisPath.slice(0, -1);

// GET OPTIONS
fetch(getContent)
    .then(res => {
        return res.json();
    })
    .then(data => {
        if (data.video.length > 20) {
            if (thisPage === data.page || thisPage_ === data.page) {
                buildWidget(data);
            }
            if (data.page === "home" || data.page === "main" || data.page === thisPath || data.page === thisPath_) {
                buildWidget(data);
            }
            if (data.page === "") {
                buildWidget(data);
            }
        }
    })
    .catch(err => {
        console.err("Error: ", err);
    });

// BUILD WIDGET
const buildWidget = (object) => {
    console.log(object);

    let width = object.width > 160 && object.width <= 720 ? object.width : 240;
    let delay = object.delay >= 0 ? object.delay : 2000;

    const wrapEl = document.createElement("div");
    wrapEl.classList.add("vws-widget-wrap");
    if (object.color) {
        wrapEl.style.borderColor = object.color;
    }

    const videoEl = document.createElement("video");
    videoEl.classList.add("vws-widget-video");
    videoEl.setAttribute("width", width);
    videoEl.dataset.status = "none";
    videoEl.muted = true;
    videoEl.loop = true;
    videoEl.controls = false;
    videoEl.autoplay = true;

    const sourceEl = document.createElement("source");
    sourceEl.src = object.video;
    sourceEl.setAttribute("type", "video/mp4");

    videoEl.append(sourceEl);
    wrapEl.append(videoEl);

    const buttonClose = document.createElement("button");
    buttonClose.classList.add("vws-widget-close");
    buttonClose.innerHTML = "&#10005;";

    const buttonMin = document.createElement("button");
    buttonMin.classList.add("vws-widget-min");
    buttonMin.innerHTML = "&#8212;"
    wrapEl.append(buttonClose, buttonMin);

    document.body.insertAdjacentHTML("beforeend", linkStyle);

    setTimeout(() => {
        document.body.append(wrapEl);
        setWidgetEvents();
    },
        delay);


    // SET EVENTS
    const setWidgetEvents = () => {
        let wrap = document.querySelector(".vws-widget-wrap");
        let video = document.querySelector(".vws-widget-video");
        document.documentElement.addEventListener("click", (e) => {

            if (e.target.className === "vws-widget-close") {
                wrap.remove();
                document.getElementById("vws-front-css").remove();
                document.getElementById("vws-front-js").remove();
            }
            if (e.target.className === "vws-widget-min") {
                wrap.classList.remove('playing');
                video.muted = true;
                video.currentTime = 0;
                video.play();
                video.dataset.status = "none";
            }

            if (e.target.className === "vws-widget-video") {
                if (video.dataset.status == "play") {
                    video.pause();
                    video.dataset.status = "none";
                } else {
                    if (!wrap.classList.contains('playing')) {
                        wrap.classList.add('playing');
                        video.currentTime = 0;
                        video.muted = false;
                        video.play();
                        video.dataset.status = "play";
                    }
                    video.play();
                    video.dataset.status = "play";
                }
            }

            if (wrap.classList.contains('playing') && e.target.className != "vws-widget-video" && e.target.className != "vws-widget-wrapper" && e.target.className != "vws-widget-min") {
                wrap.classList.remove('playing');
                video.muted = true;
                video.currentTime = 0;
                video.play();
                video.dataset.status = "none";
            }
        });
    }
}
