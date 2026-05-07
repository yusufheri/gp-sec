import AOS from "aos";
import "./styles/app.css";
import "aos/dist/aos.css";

AOS.init({
  initClassName: "aos-init",
  animatedClassName: "aos-animate",
  once: true, // L'animation ne se joue qu'une seule fois
});

window.AOS = AOS;
