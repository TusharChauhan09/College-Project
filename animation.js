
gsap.from("#b", {
  y: 100,
  opacity: 0,
  duration: 1.2,
  ease: "power3.out",
});


gsap.from("#drop", {
  y: -50,
  opacity: 0,
  duration: 1,
  delay: 0.3,
  ease: "back.out(1.7)",
});

gsap.from("#water", {
  x: 50,
  opacity: 0,
  duration: 1,
  delay: 0.5,
  ease: "back.out(1.7)",
});


gsap.from("#a", {
  y: 30,
  opacity: 0,
  duration: 0.8,
  delay: 0.8,
  stagger: 0.2,
  ease: "power2.out",
});


gsap.from("input", {
  x: -30,
  opacity: 0,
  duration: 0.8,
  delay: 1.2,
  stagger: 0.2,
  ease: "power2.out",
});


gsap.from("button", {
  scale: 0.8,
  opacity: 0,
  duration: 0.6,
  delay: 1.6,
  ease: "back.out(1.7)",
});


gsap.from(".flex.justify-center", {
  y: 20,
  opacity: 0,
  duration: 0.6,
  delay: 1.8,
  ease: "power2.out",
});
