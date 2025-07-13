document.addEventListener("DOMContentLoaded", () => {
  // === Fonctions utilitaires ===
  const animateCascade = (elements, className = "visible", baseDelay = 0, step = 400) => {
    elements.forEach((el, i) => {
      setTimeout(() => el.classList.add(className), baseDelay + i * step);
    });
  };

  const observeOnce = (target, callback, options = { threshold: 0.3 }) => {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          callback(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, options);
    observer.observe(target);
  };

  // === Partie About ===
  const photo = document.querySelector(".image img");
  const words = document.querySelectorAll(".word");
  const aboutItems = document.querySelectorAll(".about-intro");
  const arrow = document.getElementById("scrollArrow");

  const aboutSection = document.querySelector("#about");
  if (aboutSection) {
    observeOnce(aboutSection, () => {
      photo.classList.add("show");

      const baseDelay = 500;
      const stepDelay = 300;
      animateCascade(words, "visible", baseDelay, stepDelay);

      const totalWordAnimationTime = baseDelay + (words.length - 1) * stepDelay;

      setTimeout(() => {
        aboutItems.forEach(el => el.classList.add("visible"));
      }, totalWordAnimationTime + 500); 

      setTimeout(() => {
        arrow.classList.add("visible");
      }, totalWordAnimationTime + 1000);
    }, { threshold: 0.3 });
  }

  // === Canvas animé ===
  const canvas = document.getElementById('networkCanvas');
  const ctx = canvas.getContext('2d');

  let width, height, scale;
  let points = [];
  const maxDistance = 120;
  const pointCount = 60;
  let drawLoopId;

  const resizeCanvas = () => {
    scale = window.devicePixelRatio || 1;
    width = canvas.width = canvas.offsetWidth * scale;
    height = canvas.height = canvas.offsetHeight * scale;
    canvas.style.width = `${canvas.offsetWidth}px`;
    canvas.style.height = `${canvas.offsetHeight}px`;
    ctx.setTransform(scale, 0, 0, scale, 0, 0);
  };

  const initPoints = () => {
    points = Array.from({ length: pointCount }, () => ({
      x: Math.random() * canvas.offsetWidth,
      y: Math.random() * canvas.offsetHeight,
      vx: (Math.random() - 0.5) * 0.3,
      vy: (Math.random() - 0.5) * 0.3,
      radius: 1.5 + Math.random(),
    }));
  };

  const drawNetwork = () => {
    ctx.clearRect(0, 0, canvas.offsetWidth, canvas.offsetHeight);
    points.forEach(p => {
      p.x += p.vx;
      p.y += p.vy;
      if (p.x < 0 || p.x > canvas.offsetWidth) p.vx *= -1;
      if (p.y < 0 || p.y > canvas.offsetHeight) p.vy *= -1;
    });

    for (let i = 0; i < points.length; i++) {
      for (let j = i + 1; j < points.length; j++) {
        const dx = points[i].x - points[j].x;
        const dy = points[i].y - points[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < maxDistance) {
          const alpha = 1 - dist / maxDistance;
          ctx.strokeStyle = `rgba(255, 255, 255, ${alpha * 0.8})`;
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(points[i].x, points[i].y);
          ctx.lineTo(points[j].x, points[j].y);
          ctx.stroke();
        }
      }
    }

    points.forEach(p => {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
      ctx.fill();
    });

    drawLoopId = requestAnimationFrame(drawNetwork);
  };

  const startCanvas = () => {
    cancelAnimationFrame(drawLoopId);
    resizeCanvas();
    initPoints();
    drawNetwork();
  };

  window.addEventListener('resize', () => {
    resizeCanvas();
    initPoints();
  });

  if (canvas) {
    observeOnce(canvas, startCanvas, { threshold: 0.1 });
  }

  // === Partie Skills ===
  const skillSection = document.querySelector("#skills");
  const skillBars = document.querySelectorAll(".skill-bar");
  const skillsItem = document.querySelectorAll(".skills-item");

  if (skillSection) {
    observeOnce(skillSection, () => {
      skillBars.forEach((bar, i) => {
        const skill = bar.getAttribute("data-skill");
        setTimeout(() => { bar.style.width = skill; }, i * 150);
      });
      animateCascade(skillsItem, "visible", 1000, 300);
    }, { threshold: 0.3 });
  }

  // === Partie Expérience ===
  const timelineItems = document.querySelectorAll("#experience .timeline-item.hidden-on-load");
  timelineItems.forEach((item, i) => {
    item.dataset.index = i;
    observeOnce(item, () => {
      setTimeout(() => {
        item.classList.add("visible");
      }, i * 300);
    }, { threshold: 0.3 });
  });

  // === Partie Formation ===
  const formationSection = document.querySelector("#formation");
  const formationItems = document.querySelectorAll(".formation-item");

  if (formationSection) {
    observeOnce(formationSection, () => {
      animateCascade(formationItems, "visible", 0, 300);
    }, { threshold: 0.4 });
  }

  // === Partie Portfolio ===
  const portfolioItems = document.querySelectorAll(".portfolio-item.hidden-on-load");
  portfolioItems.forEach((item, i) => {
    item.dataset.index = i;
    observeOnce(item, () => {
      setTimeout(() => {
        item.classList.add("visible");
      }, i * 300);
    }, { threshold: 0.3 });
  });

// === Toast auto-disparition  ===
setTimeout(() => {
  const toast = document.querySelector("#toast-container");
  if (toast) {
    setTimeout(() => {
      toast.style.opacity = "0";
      toast.style.transform = "translateY(-10px)";
      toast.style.transition = "opacity 0.5s ease, transform 0.5s ease";
      setTimeout(() => {
        toast.remove();
      }, 600);
    }, 15000); 
  }
}, 100);

});
