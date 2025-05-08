<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Teacher Directory</title>
  <link rel="stylesheet" href="/css2/styles.css" />
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php'; ?>
  <style>
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
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1rem;
    }

    .subject-content .teacher-card {
      border-left: 3px solid #1F0E58;
    }
	  /* Add these styles to your existing CSS */

/* Add these styles to your existing CSS */

/* Alphabetical view styling to match subject view */
.letter-group {
  margin-bottom: 3rem;
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  overflow: hidden;
  background-color: #ffffff;
}

.letter-header {
  background: linear-gradient(45deg, #1F0E58, #004EA9);
  color: white;
  padding: 0.75rem 1rem;
  font-size: 1.1rem;
  font-weight: 500;
}

.letter-content {
  padding: 1.5rem;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.letter-content .teacher-card {
  border-left: 3px solid #1F0E58;
  margin-bottom: 0.5rem;
}

/* Search results styling */
.search-results {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-top: 1.5rem;
  padding: 1rem;
}

.search-results .teacher-card {
  border-left: 3px solid #1F0E58;
}

/* Enhanced teacher card styling for all views */
.teacher-card {
  background-color: #f9f9f9;
  color: #333;
  padding: 1.25rem;
  border-radius: 8px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
  margin: 0.25rem;
}

.teacher-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Class information styling */
.class-info {
  margin-top: 0.75rem;
  font-style: italic;
  color: #555;
}

/* Additional spacing for subject groups to match letter groups */
.subject-group {
  margin-bottom: 3rem;
}

.subject-content {
  padding: 1.5rem;
  gap: 1.5rem;
}

/* Consistent spacing between sections */
#teacherList > div {
  margin-bottom: 2.5rem;
}
  </style>
</head>

<body>
  <div class="container schedule-page">
    <h1>Teacher Directory</h1>

    <div class="search-container">
      <input type="text" id="searchInput" placeholder="Search for teachers..." />
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
  { name: "Alley, Christina", room: "Room 855", subject: "Social Science", class: "World History, US History" },
  { name: "Alvarado, Marisa", room: "Room 1125", subject: "Science", class: "Biology, AP Environmental Science, Space and Earth Science" },
  { name: "Arellano, Kristopher", room: "Room 1130", subject: "Science", class: "Chemistry"},
  { name: "Baer, Kevin", room: "Room 820", subject: "Math" },
  { name: "Barela, Kaitlin", room: "Room 510", subject: "Special Education Moderate/Severe" },
  { name: "Bartell, Ross", room: "Room 1406", subject: "Learning Center" },
  { name: "Beckhard, Kathryn", room: "Room 815", subject: "Math", class: "IM 1" },
  { name: "Beckman, Tana", room: "Room 555", subject: "Social Science" },
  { name: "Bell, Todd", room: "Room 1452", subject: "English", class: "Film Lit, AP English Literature" },
  { name: "Benrud, Todd", room: "Room 540", subject: "Technology", class: "Web Development, Global IT, Personal Finance" },
  { name: "Bradel, Kara", room: "Room 1416/1456", subject: "MH Transition" },
  { name: "Bradley, Kevin", room: "Room 845", subject: "Social Science", class: "AP European History, AP Psychology, Geography, World History" },
  { name: "Brinkerhoff, Dwight", room: "Auto", subject: "Auto Shop" },
  { name: "Carlino, Kimberly", room: "Room 1454", subject: "English" },
  { name: "Carpenter, Brian", room: "Room 775", subject: "Math" },
  { name: "Chestnut, Katie", room: "Room P4", subject: "EL/ELA Teacher" },
  { name: "Cooke, Jeremy", room: "Room P1", subject: "Math", class: "IM 3" },  
  { name: "Cooke, Jeremy", room: "Room 1310", subject: "Guitar", class: "Beginning Guitar, Advanced/Intermediate Guitar" },
  { name: "Cox, Jennifer", room: "Room 1110", subject: "Science" },
  { name: "Di Carlo Wagner, Jesse", room: "Room 730", subject: "SLP" },
  { name: "Earley, James", room: "Locker Room", subject: "Physical Education", class: "PE" },
  { name: "Eaton, Jennifer", room: "Room 550", subject: "Math" },
  { name: "Ecker, Amity", room: "Room 370", subject: "Theater Arts", class: "Beginning Theater, Intermediate/Advanced Theater, Technical Theater" },
  { name: "Fanning, Michele", room: "Room 1457", subject: "English", class: "English 1-2C, English 7-8C" },
  { name: "Flisher, Matt", room: "Room 750", subject: "Math", class: "IM3-PreCalculus, Financial Literacy, IM1, IM2, AP Calc" },
  { name: "Garrett, Amber", room: "Room 1408", subject: "English", class: "Sophomore English" },
  { name: "Ginn, Donald", room: "Room 825", subject: "Social Science", class: "AP United States History, US History" },
  { name: "Ginn, LeAnne", room: "Room 1466", subject: "English", class: "English For Business, AP English Language, AP English Literature" },
  { name: "Giovengo, Patrick", room: "Room 535", subject: "Technology", class: "AP Computer Science Principles, Technical Discoveries, Yearbook" },
  { name: "Goodrich, Danny", room: "Locker Room", subject: "Physical Education", class: "PE" },
  { name: "Goycoochea, Gabe", room: "Room 1105", subject: "Science", class: "Biology" },
  { name: "Hersch, Jeremy", room: "Room 200", subject: "Social Science", class: "US History" },
  { name: "Hersch, Jeremy", room: "Room 200", subject: "Associated Student Body", class: "ASB" },
  { name: "Heubach, Phlyn", room: "Room 720", subject: "Math", class: "IM2, IM3" },
  { name: "Hoeben, Trinity", room: "Room 755", subject: "Math", class: "IM3-Precalc, Financial Literacy" },
  { name: "Hourigan, Melissa", room: "Room 1416", subject: "Special Education" },
  { name: "Hull, Melissa (Odom)", room: "Locker Room", subject: "Weights" },
  { name: "Ipapo-Glass, Caryn", room: "Room 300", subject: "Dance", class: "Beginning Dance, Intermediate/Advanced Dance" },
  { name: "Jacobs, Anna", room: "Room 1414", subject: "Spanish" },
  { name: "Jensen, Laurie", room: "Room 1462", subject: "English" },
  { name: "Jerabek, Alyssa", room: "Room P2/1130", subject: "Special Education" },
  { name: "Jones, Sean", room: "Room 545", subject: "Social Science" },
  { name: "Joyce, Mercedes", room: "Room 1411", subject: "Spanish" },
  { name: "Jungman, Carolyn", room: "Room 225", subject: "Art", class: "AME Pathway, Photography, Digital Arts, AP 2D Design" },
  { name: "La-Berge, Stephanie", room: "Room 1120", subject: "Science", class: "Physiology, Excel Biology" },
  { name: "Leathers, Laura", room: "Room 1463", subject: "English", class: "Child Development" },
  { name: "Lee, Jeffrey", room: "Room 1135", subject: "Science", class: "Chemistry" },
  { name: "Lee, Jeffrey", room: "Room 1140", subject: "Science", class: "Engineering" },
  { name: "Lindsay, Peyton", room: "Room 530", subject: "Social Science" },
  { name: "Long, Megan", room: "Room 805", subject: "Social Science", class: "Excel Geography, PRIDE" },
  { name: "LoPrell, Kristen", room: "Room 745", subject: "Math", class: "IM1, AP Calculus AB" },
  { name: "McLaughin, Marcy", room: "Room 760", subject: "Math", class: "IM3, AP Statistics" },
  { name: "Miller, Lara", room: "Room 1403", subject: "English" },
  { name: "Morrison, Grace", room: "Room 350", subject: "Choir", class: "Chamber Choir, Bella Voce Choir, Vox Forte, Beginning Choir" },
  { name: "Ortiz, Sara", room: "Room 1458", subject: "English", class: "English 2H" }, 
  { name: "Pagarigan, Gwenne", room: "Room 210", subject: "Art", class: "3D Design, Advanced 3D Design" },
  { name: "Pantoja, Carmelina", room: "Room 1407", subject: "Spanish" }, 
  { name: "Park, Hillary", room: "Room 1413", subject: "Spanish" }, 
  { name: "Payne, Yvonne", room: "Room 1453", subject: "English" }, 
  { name: "Phillips, Susan", room: "Room 230", subject: "Art", class: "Art 1/2, Art 3/4, AP Studio Art" }, 
  { name: "Price, Tom", room: "Room 1150", subject: "Science", class: "Chemistry" }, 
  { name: "Ray, Chris", room: "Room 901", subject: "Sports Medicine" }, 
  { name: "Raymond, Jennifer", room: "Room 835", subject: "Geography" }, 
  { name: "Ross, Micela", room: "Locker Room", subject: "Physical Education", class: "PE" }, 
  { name: "Rutherford, Justin", room: "Room 865", subject: "Social Science", class: "World History" },
  { name: "Schlaht, Shelby", room: "Room P3", subject: "English" },
  { name: "Schultz, Heidi", room: "Room 1467", subject: "English" },
  { name: "Sheahan, Donald", room: "Room 1145", subject: "Science", class: "Physics" },
  { name: "Shrestha, Devon", room: "Room 810", subject: "Math", class: "IM2" },
  { name: "Smith, Mike", room: "Room 860", subject: "Social Science", class: "Economics, Geography, Government" },
  { name: "Stellin, Bill", room: "Room 1468", subject: "Special Education" },
  { name: "Stellin, Elizabeth", room: "Room 1459", subject: "English" },
  { name: "Steveson, Ethan", room: "Room 840", subject: "Social Science", class: "US History, AP Government" },
  { name: "Talley, Robert", room: "Room 850", subject: "Social Science" },
  { name: "Thren, Sydney", room: "Room 1464", subject: "English" },
  { name: "Valoria, Daniel", room: "Room 715", subject: "Math" },
  { name: "Velarde, Melissa", room: "Room 1412", subject: "Spanish" },
  { name: "Velasquez, Max", room: "Room 610", subject: "NJROTC" },
  { name: "Villegas, James", room: "Room 1310", subject: "Music", class: "Beginning Orchestra, Advanced Orchestra, Symphonic Band, Beginning Band, Jazz, Colorguard" },
  { name: "West, Kara", room: "Room 1125", subject: "Science", class: "Biology" },
  { name: "West, Kara", room: "P2", subject: "Science", class: "Biology" },
  { name: "Wilkerson, Jermaine", room: "Room 620", subject: "NJROTC" },
  { name: "Williams, Nicole", room: "Room 830", subject: "Social Science", class: "US History" },
  { name: "Youngblood, David", room: "Room 1115", subject: "Science", class: "Earth Science, Chemistry" }
];
  function groupAndRenderTeachers() {
      const grouped = {};

      teachers.forEach(teacher => {
        if (!grouped[teacher.subject]) {
          grouped[teacher.subject] = { withClass: [], withoutClass: [] };
        }

        if (teacher.class) {
          grouped[teacher.subject].withClass.push(teacher);
        } else {
          grouped[teacher.subject].withoutClass.push(teacher);
        }
      });

      const teacherList = document.getElementById('teacherList');
      teacherList.innerHTML = "";

      Object.keys(grouped).sort().forEach(subject => {
        const group = grouped[subject];
        const section = document.createElement('div');
        section.className = 'subject-group';

        const header = document.createElement('div');
        header.className = 'subject-header';
        header.textContent = subject;

        const content = document.createElement('div');
        content.className = 'subject-content';

        [...group.withClass, ...group.withoutClass].forEach(teacher => {
          const card = document.createElement('div');
          card.className = 'teacher-card';
          card.innerHTML = `<strong>${teacher.name}</strong><br>${teacher.room}<br>${teacher.class ?? ''}`;
          content.appendChild(card);
        });

        section.appendChild(header);
        section.appendChild(content);
        teacherList.appendChild(section);
      });
    }

    window.addEventListener('DOMContentLoaded', () => {
      groupAndRenderTeachers();
    });
  </script>
</body>
		<script src="/search/searchLogic.js" defer></script>
</html>
