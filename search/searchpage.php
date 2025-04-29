<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Directory</title>
  <link rel="stylesheet" href="/css2/styles.css">
  <?php 
        include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
  ?>
  <style>
    /* Additional Styling to Match CSS Theme */

    .search-container {
      display: flex;
      width: 100%;
      margin: 0.5rem 0;
    }

    #searchInput {
      flex-grow: 1;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 10px 0 0 10px;
      font-size: 1rem;
      box-sizing: border-box;
    }

    #searchButton {
      padding: 0.75rem 1.5rem;
      background: linear-gradient(45deg, #1F0E58, #004EA9);
      color: white;
      border: none;
      border-radius: 0 10px 10px 0;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    #searchButton:hover {
      background: linear-gradient(45deg, #004EA9, #1F0E58);
    }

    .filter-container {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin: 1rem 0;
    }

    .filter-container select {
      flex-grow: 1;
      min-width: 150px;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 1rem;
    }

    #clearButton {
      margin: 1rem auto;
      display: block;
    }

    .teacher-card {
      background-color: #f9f9f9;
      color: #333;
      padding: 1rem;
      border-radius: 12px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
      margin-bottom: 1rem;
      text-align: left;
    }

    .highlight {
      background-color: yellow;
      font-weight: bold;
    }

    #teacherList {
      margin-top: 1rem;
    }

    .sort-options {
      display: flex;
      justify-content: center;
      margin: 1rem 0;
    }

    .sort-button {
      padding: 0.5rem 1rem;
      background: linear-gradient(45deg, #1F0E58, #004EA9);
      color: white;
      border: none;
      border-radius: 10px;
      margin: 0 0.5rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .sort-button:hover {
      background: linear-gradient(45deg, #004EA9, #1F0E58);
      transform: translateY(-2px);
    }

    .sort-button.active {
      box-shadow: 0 0 0 3px rgba(31, 14, 88, 0.3);
    }

    /* Subject grouping styles */
    .subject-group {
      margin-bottom: 2rem;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      overflow: hidden;
      background-color: #ffffff;
    }

    .subject-header {
      background: linear-gradient(45deg, #1F0E58, #004EA9);
      color: white;
      padding: 0.75rem 1rem;
      font-size: 1.1rem;
      font-weight: 500;
    }

    .subject-content {
      padding: 1rem;
    }

    .subject-content .teacher-card {
      box-shadow: 0 3px 6px rgba(0,0,0,0.08);
      border-left: 3px solid #1F0E58;
    }

    .subject-content .teacher-card:last-child {
      margin-bottom: 0;
    }
  </style>
</head>
<body>
  <div class="container schedule-page">
    <h1>Teacher Directory</h1>
    
    <div class="search-container">
      <input type="text" id="searchInput" placeholder="Search for teachers...">
      <button id="searchButton">Search</button>
    </div>

    <div class="filter-container">
      <select id="filterType">
        <option value="all">Search All</option>
        <option value="name">Search by Name</option>
        <option value="subject">Search by Subject</option>
      </select>
      
      <select id="subjectFilter">
        <option value="">All Subjects</option>
      </select>
    </div>

    <div class="sort-options">
      <button id="sortAlphabetically" class="sort-button active">View Alphabetically</button>
      <button id="sortBySubject" class="sort-button">View By Subject</button>
    </div>

    <button id="clearButton" class="button">Clear All Filters</button>
    
    <div id="teacherList"></div>
  </div>

  <script>
    const teachers = [
      { name: "Alley, Christina", room: "Room 855", subject: "Social Science" },
      { name: "Alvarado, Marisa", room: "Room 1125", subject: "Biology/APES" },
      { name: "Arellano, Kristopher", room: "Room 1130", subject: "Chemistry" },
      { name: "Baer, Kevin", room: "Room 820", subject: "Math" },
      { name: "Barela, Kaitlin", room: "Room 510", subject: "Sp Ed Mod/Sev" },
      { name: "Bartell, Ross", room: "Room 1406", subject: "Learning Center" },
      { name: "Beckhard, Kathryn", room: "Room 815", subject: "Math" },
      { name: "Beckman, Tana", room: "Room 555", subject: "Social Science" },
      { name: "Bell, Todd", room: "Room 1452", subject: "English" },
      { name: "Benrud, Todd", room: "Room 540", subject: "Tech and Web Design" },
      { name: "Boeger, Jodie", room: "Library", subject: "DC" },
      { name: "Bradel, Kara", room: "Room 1416/1456", subject: "MH Transition" },
      { name: "Bradley, Kevin", room: "Room 845", subject: "Social Science" },
      { name: "Brinkerhoff, Dwight", room: "Auto", subject: "DC" },
      { name: "Carlino, Kimberly", room: "Room 1454", subject: "English" },
      { name: "Carpenter, Brian", room: "Room 775", subject: "Math" },
      { name: "Chestnut, Katie", room: "Room P4", subject: "EL/ELA Teacher" },
      { name: "Cooke, Jeremy", room: "Room P1/1310", subject: "Math/Guitar" },
      { name: "Cox, Jennifer", room: "Room 1110", subject: "Science/CEIS" },
      { name: "Di Carlo Wagner, Jesse", room: "Room 730", subject: "SLP" },
      { name: "Earley, James", room: "PE", subject: "DC" },
      { name: "Eaton, Jennifer", room: "Room 550", subject: "Math" },
      { name: "Ecker, Amity", room: "Drama 370", subject: "Drama" },
      { name: "Espley, Kristina", room: "Room 1451", subject: "" },
      { name: "Fanning, Michele", room: "Room 1457", subject: "English" },
      { name: "Flisher, Matt", room: "Room 750", subject: "Alg/DC" },
      { name: "Freeland, Bryan", room: "Off-Site", subject: "Transition/Spec Ed" },
      { name: "French, Aaron", room: "Room 750/715/810/780", subject: "Traveling/LH" },
      { name: "Garrett, Amber", room: "Room 1408", subject: "English" },
      { name: "Ginn, Donald", room: "Room 825", subject: "Soc Sci/GATE" },
      { name: "Ginn, LeAnne", room: "Room 1466", subject: "English" },
      { name: "Giovengo, Patrick", room: "Room 535", subject: "Comp Tech/Giovengo" },
      { name: "Goodrich, Danny", room: "PE", subject: "" },
      { name: "Goycoochea, Gabe", room: "Room 1105", subject: "Science" },
      { name: "Hersch, Jeremy", room: "Room 200", subject: "Soc Sci/ASB" },
      { name: "Heubach, Phlyn", room: "Room 720", subject: "Math" },
      { name: "Hoeben, Trinity", room: "Room 755", subject: "Math" },
      { name: "Hourigan, Melissa", room: "Room 1416", subject: "SpedEd" },
      { name: "Hull, Melissa (Odom)", room: "PE", subject: "Weights" },
      { name: "Ipapo-Glass, Caryn", room: "Room 300", subject: "Dance/REC/DC" },
      { name: "Jacobs, Anna", room: "Room 1414", subject: "Spanish" },
      { name: "Jensen, Laurie", room: "Room 1462", subject: "English" },
      { name: "Jerabek, Alyssa", room: "Room P2/1130", subject: "SpEd" },
      { name: "Jones, Sean", room: "Room 545", subject: "Social Science" },
      { name: "Joyce, Mercedes", room: "Room 1411", subject: "Spanish" },
      { name: "Jungman, Carolyn", room: "Room 225", subject: "Photo/Digital Arts" }
    ];

    const teacherList = document.getElementById('teacherList');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const clearButton = document.getElementById('clearButton');
    const subjectFilter = document.getElementById('subjectFilter');
    const filterType = document.getElementById('filterType');
    const sortAlphabetically = document.getElementById('sortAlphabetically');
    const sortBySubject = document.getElementById('sortBySubject');

    // Populate subject filter dropdown
    const uniqueSubjects = [...new Set(teachers.map(t => t.subject).filter(s => s))].sort();
    uniqueSubjects.forEach(subj => {
      const option = document.createElement('option');
      option.value = subj;
      option.textContent = subj;
      subjectFilter.appendChild(option);
    });

    function highlightMatch(text, query) {
      if (!query || !text) return text || '';
      const regex = new RegExp(`(${query})`, 'gi');
      return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function createTeacherCard(teacher, query = '') {
      let { name, room, subject } = teacher;
      if (query) {
        name = highlightMatch(name, query);
        room = highlightMatch(room, query);
        subject = highlightMatch(subject, query);
      }
      
      const div = document.createElement('div');
      div.className = 'teacher-card';
      div.innerHTML = `<strong>${name}</strong><br>${room}<br>${subject}`;
      return div;
    }

    function displayTeachers(teachersToDisplay, query = '') {
      teacherList.innerHTML = '';
      
      if (teachersToDisplay.length === 0) {
        teacherList.innerHTML = '<div class="teacher-card">No teachers found matching your criteria.</div>';
        return;
      }
      
      // Check if we're in subject view
      if (sortBySubject.classList.contains('active')) {
        displayTeachersBySubject(teachersToDisplay, query);
      } 
      // Default alphabetical view
      else {
        teachersToDisplay.forEach(teacher => {
          teacherList.appendChild(createTeacherCard(teacher, query));
        });
      }
    }

    function displayTeachersBySubject(teachersToDisplay, query = '') {
      // Group teachers by subject
      const subjectGroups = {};
      
      teachersToDisplay.forEach(teacher => {
        const subject = teacher.subject || "Unspecified";
        if (!subjectGroups[subject]) {
          subjectGroups[subject] = [];
        }
        subjectGroups[subject].push(teacher);
      });
      
      // Create subject groups in DOM
      Object.keys(subjectGroups).sort().forEach(subject => {
        const subjectGroup = document.createElement('div');
        subjectGroup.className = 'subject-group';
        
        const subjectHeader = document.createElement('div');
        subjectHeader.className = 'subject-header';
        subjectHeader.textContent = subject || "Unspecified Subject";
        
        const subjectContent = document.createElement('div');
        subjectContent.className = 'subject-content';
        
        // Add teacher cards to this subject
        subjectGroups[subject].sort((a, b) => a.name.localeCompare(b.name)).forEach(teacher => {
          subjectContent.appendChild(createTeacherCard(teacher, query));
        });
        
        subjectGroup.appendChild(subjectHeader);
        subjectGroup.appendChild(subjectContent);
        teacherList.appendChild(subjectGroup);
      });
    }

    function filterTeachers() {
      const query = searchInput.value.toLowerCase();
      const subjectValue = subjectFilter.value;
      const searchType = filterType.value;
      
      const filtered = teachers.filter(teacher => {
        // Handle subject filter
        const matchesSubject = !subjectValue || teacher.subject === subjectValue;
        
        // If no search query, just check subject
        if (!query) return matchesSubject;
        
        // Otherwise apply search query based on filter type
        let matchesSearch = false;
        
        switch (searchType) {
          case 'name':
            matchesSearch = teacher.name.toLowerCase().includes(query);
            break;
          case 'room':
            matchesSearch = teacher.room.toLowerCase().includes(query);
            break;
          case 'subject':
            matchesSearch = teacher.subject.toLowerCase().includes(query);
            break;
          case 'all':
          default:
            matchesSearch = teacher.name.toLowerCase().includes(query) ||
                            teacher.room.toLowerCase().includes(query) ||
                            teacher.subject.toLowerCase().includes(query);
        }
        
        return matchesSearch && matchesSubject;
      });
      
      return filtered;
    }

    function applyFiltersAndSort() {
      let filtered = filterTeachers();
      
      // Default alphabetical sort if not in subject view
      if (!sortBySubject.classList.contains('active')) {
        filtered.sort((a, b) => a.name.localeCompare(b.name));
      }
      
      displayTeachers(filtered, searchInput.value.toLowerCase());
    }

    // Event listeners
    searchButton.addEventListener('click', applyFiltersAndSort);
    
    searchInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        applyFiltersAndSort();
      }
    });
    
    subjectFilter.addEventListener('change', applyFiltersAndSort);
    filterType.addEventListener('change', applyFiltersAndSort);
    
    clearButton.addEventListener('click', () => {
      searchInput.value = '';
      subjectFilter.value = '';
      filterType.value = 'all';
      
      // Reset to alphabetical sorting
      setActiveSort(sortAlphabetically);
      
      // Display all teachers alphabetically
      const sorted = [...teachers].sort((a, b) => a.name.localeCompare(b.name));
      displayTeachers(sorted);
    });

    function setActiveSort(button) {
      // Remove active class from all sort buttons
      sortAlphabetically.classList.remove('active');
      sortBySubject.classList.remove('active');
      
      // Add active class to clicked button
      button.classList.add('active');
    }

    sortAlphabetically.addEventListener('click', () => {
      setActiveSort(sortAlphabetically);
      applyFiltersAndSort();
    });

    sortBySubject.addEventListener('click', () => {
      setActiveSort(sortBySubject);
      applyFiltersAndSort();
    });

    // Initial display - alphabetically sorted
    const initialDisplay = [...teachers].sort((a, b) => a.name.localeCompare(b.name));
    displayTeachers(initialDisplay);
  </script>
</body>
</html>