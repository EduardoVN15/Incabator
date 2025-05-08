document.addEventListener("DOMContentLoaded", () => {
  const teacherList = document.getElementById("teacherList");
  const searchInput = document.getElementById("searchInput");
  const searchButton = document.getElementById("searchButton");
  const filterType = document.getElementById("filterType");
  const subjectFilter = document.getElementById("subjectFilter");
  const sortAlphabeticallyBtn = document.getElementById("sortAlphabetically");
  const sortBySubjectBtn = document.getElementById("sortBySubject");
  const clearButton = document.getElementById("clearButton");

  let currentView = "alphabetical";

  // Get unique subjects for filter dropdown
  const subjects = [...new Set(teachers.map(t => t.subject).filter(Boolean))].sort();
  subjects.forEach(subject => {
    const option = document.createElement("option");
    option.value = subject;
    option.textContent = subject;
    subjectFilter.appendChild(option);
  });

  const renderTeachersAlphabetically = (filtered = teachers) => {
    const sorted = [...filtered].sort((a, b) => a.name.localeCompare(b.name));
    teacherList.innerHTML = sorted.map(t => createTeacherCard(t)).join("");
  };

  const renderTeachersBySubject = (filtered = teachers) => {
    const grouped = {};
    filtered.forEach(t => {
      if (!grouped[t.subject]) grouped[t.subject] = [];
      grouped[t.subject].push(t);
    });

    teacherList.innerHTML = Object.entries(grouped).sort().map(([subject, list]) => {
      const cards = list.map(t => createTeacherCard(t)).join("");
      return `
        <div class="subject-group">
          <div class="subject-header">${subject}</div>
          <div class="subject-content">${cards}</div>
        </div>
      `;
    }).join("");
  };

  const createTeacherCard = (t) => `
    <div class="teacher-card">
      <strong>${t.name}</strong><br/>
      ${t.room ? `<div><strong>Room:</strong> ${t.room}</div>` : ""}
      ${t.subject ? `<div><strong>Subject:</strong> ${t.subject}</div>` : ""}
      ${t.class ? `<div><strong>Classes:</strong> ${t.class}</div>` : ""}
    </div>
  `;

  const applyFilters = () => {
    const query = searchInput.value.trim().toLowerCase();
    const filter = filterType.value;
    const subject = subjectFilter.value;

    let filtered = teachers.filter(t => {
      const matchQuery = (field) => field?.toLowerCase().includes(query);

      let match = false;
      if (filter === "all") {
        match = [t.name, t.subject, t.class, t.room].some(f => matchQuery(f || ""));
      } else if (filter === "name") {
        match = matchQuery(t.name);
      } else if (filter === "subject") {
        match = matchQuery(t.subject);
      }

      if (subject) {
        match = match && t.subject === subject;
      }

      return match;
    });

    if (currentView === "alphabetical") {
      renderTeachersAlphabetically(filtered);
    } else {
      renderTeachersBySubject(filtered);
    }
  };

  // Initial render
  renderTeachersAlphabetically();

  searchButton.addEventListener("click", applyFilters);
  searchInput.addEventListener("keyup", (e) => {
    if (e.key === "Enter") applyFilters();
  });
  filterType.addEventListener("change", applyFilters);
  subjectFilter.addEventListener("change", applyFilters);

  sortAlphabeticallyBtn.addEventListener("click", () => {
    currentView = "alphabetical";
    sortAlphabeticallyBtn.classList.add("active");
    sortBySubjectBtn.classList.remove("active");
    applyFilters();
  });

  sortBySubjectBtn.addEventListener("click", () => {
    currentView = "subject";
    sortBySubjectBtn.classList.add("active");
    sortAlphabeticallyBtn.classList.remove("active");
    applyFilters();
  });

  clearButton.addEventListener("click", () => {
    searchInput.value = "";
    filterType.value = "all";
    subjectFilter.value = "";
    currentView === "alphabetical" ? renderTeachersAlphabetically() : renderTeachersBySubject();
  });
});
