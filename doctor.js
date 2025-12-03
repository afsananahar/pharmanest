// Search + Filter
const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const doctorList = document.getElementById("doctorList");
const doctors = doctorList.getElementsByClassName("doctor-card");

function filterDoctors() {
  const searchValue = searchInput.value.toLowerCase();
  const categoryValue = categoryFilter.value;

  Array.from(doctors).forEach(doctor => {
    const name = doctor.querySelector("h2").textContent.toLowerCase();
    const speciality = doctor.querySelector("p").textContent.toLowerCase();
    const category = doctor.getAttribute("data-category");

    if (
      (name.includes(searchValue) || speciality.includes(searchValue)) &&
      (categoryValue === "all" || category === categoryValue)
    ) {
      doctor.style.display = "flex";
    } else {
      doctor.style.display = "none";
    }
  });
}

searchInput.addEventListener("input", filterDoctors);
categoryFilter.addEventListener("change", filterDoctors);

// 📌 Appointment Modal Logic
const modal = document.getElementById("appointmentModal");
const closeModal = document.getElementById("closeModal");
const doctorNameField = document.getElementById("doctorName");

document.querySelectorAll(".book-btn").forEach(button => {
  button.addEventListener("click", () => {
    const doctorName = button.getAttribute("data-doctor");
    doctorNameField.textContent = "Book Appointment with " + doctorName;
    modal.style.display = "flex";
  });
});

closeModal.addEventListener("click", () => {
  modal.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});

// Form Submit
document.getElementById("appointmentForm").addEventListener("submit", (e) => {
  e.preventDefault();
  alert("✅ Appointment Confirmed!");
  modal.style.display = "none";
});
