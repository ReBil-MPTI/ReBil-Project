import AOS from "aos";
import "aos/dist/aos.css";

AOS.init({
    duration: 800,
    once: true,
    easing: "ease-in-out",
});

document.addEventListener("livewire:load", () => {
    Livewire.hook("message.processed", () => {
        AOS.refresh();
    });
});
import "./bootstrap";
