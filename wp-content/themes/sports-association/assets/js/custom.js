// Progress Bar
document.addEventListener("DOMContentLoaded", function () {
  const sports_association_boxes = document.querySelectorAll(".bar-box");

  sports_association_boxes.forEach((box) => {
    const sports_association_percentText = box.querySelector(".percent")?.innerText || "0%";
    const sports_association_bar = box.querySelector(".bar");

    const sports_association_value = parseInt(sports_association_percentText, 10);

    const sports_association_totalDots = 10; // total dots like your image
    const sports_association_activeDots = Math.round((sports_association_value / 100) * sports_association_totalDots);

    sports_association_bar.innerHTML = "";

    for (let sports_association_i = 0; sports_association_i < sports_association_totalDots; sports_association_i++) {
      const sports_association_dot = document.createElement("span");

      if (sports_association_i < sports_association_activeDots) {
        sports_association_dot.classList.add("active");
      }

      sports_association_bar.appendChild(sports_association_dot);
    }
  });
});