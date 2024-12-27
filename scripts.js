console.log("Hello world")

document.addEventListener("DOMContentLoaded", ()=> {
    fetch("mouse.svg")
    .then(response => response.text())
    .then(svgContent => {
        document.getElementById("svgContainer").innerHTML = svgContent;
        setupScrollTracking();
        // setupAnimation()
    })
    .catch(err => console.error("Failed to load Mouse SVG"))
})

function setupScrollTracking(){
    const svgContainer = document.getElementById("svgContainer");

    // Track scrolling
    window.addEventListener("scroll",() => {
        const scrollTop = window.scrollY; // How much user has scrolled

        const docHeight = document.body.scrollHeight; // Total document height
        const winHeight = window.innerHeight; // Height of the viewport
        const scrollPercent = scrollTop / (docHeight - winHeight)
        console.log("Percent: ", scrollPercent)

        const maxMove = window.innerWidth;
        const newX = maxMove *(scrollPercent);
        console.log("newx:",newX)

        svgContainer.style.transform =`translateX(-${newX}px)`
        // svgContainer.style.transform =`translateX(-10px)`
    });
}

function setupAnimation(){
    const mouse = document.querySelector("#svgContainer svg")
    // const animate = decodeURIComponent
    const animateMouseButton = document.getElementById("animateMouse");

    animateMouseButton.addEventListener("click", () => {
        mouse.classList.add("animate");
        setTimeout(() => {
            mouse.classList.remove("animate");
        },600);
    });

    document.addEventListener("keydown", (event) => {
        if(event.code === "Space"){
            mouse.classList.add("animate");
            setTimeout(() => {
                mouse.classList.remove("animate");
            }, 600);
        }
    })
}