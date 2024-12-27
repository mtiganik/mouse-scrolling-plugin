console.log("Hello world")

document.addEventListener("DOMContentLoaded", ()=> {
    fetch("mouse.svg")
    .then(response => response.text())
    .then(svgContent => {
        document.getElementById("svgContainer").innerHTML = svgContent;
        setupAnimation();
    })
})

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