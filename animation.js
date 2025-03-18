tailwind.config = {
    theme: {
      extend: {
        colors: {
          linkedin: {
            blue: '#0a66c2',
            dark: '#283e4a'
          }
        },
        boxShadow: {
          card: '0 4px 6px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.05)'
        }
      }
    }
  }

// login sign up
gsap.from("#b",{
    y:100,
    duration:1
})

gsap.from("#drop",{
    y:-30,
    duration:1,
    opacity:0,
    delay:1
})

gsap.from("#water",{
    x:30,
    opacity:0,
    duration:2,
})

gsap.from("#a",{
    y:100,
    duration:2,
})







