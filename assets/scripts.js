
document.addEventListener("DOMContentLoaded", ()=> {
    const svgContainer = document.getElementById("svgContainer");
    const svgUrl = svgContainer.getAttribute("data-svg-url");
    console.log("script loaded")

    fetch(svgUrl)
        .then(response => response.text())
        .then(svgContent => {
            svgContainer.innerHTML = svgContent;
            setupScrollTracking();
        })
        .catch(err => console.error("Failed to load Mouse SVG"))
})

function setupScrollTracking(){
    const svgContainer = document.getElementById("svgContainer");
    let lastScrollTop = 0
    // Track scrolling
    window.addEventListener("scroll",() => {
        const scrollTop = window.scrollY; // How much user has scrolled

        const docHeight = document.body.scrollHeight; // Total document height
        const winHeight = window.innerHeight; // Height of the viewport
        const scrollPercent = scrollTop / (docHeight - winHeight)

        const maxMove = window.innerWidth;
        const newX = maxMove *(scrollPercent);

        const scrollDirection = scrollTop > lastScrollTop ? "down" : "up"
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

        if (scrollDirection === "down"){

            svgContainer.style.transform =`translateX(-${newX}px) scaleX(1)`
        }else{
            svgContainer.style.transform =`translateX(-${newX}px) scaleX(-1)`
        }

        svgContainer.classList.add("animate")
        setTimeout(() => {
            svgContainer.classList.remove("animate")
        },600)
    });
}
