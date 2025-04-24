
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
</head>
<body>
  <div class="container">
    <h1>Teacher Directory</h1>
    <input type="text" id="searchInput" placeholder="Search by name, room, or subject...">
    <div id="teacherList"></div>
  </div>

  <script>
    const classes = [
      { name: "Alley, Christina", room: "Room 855", subject: "Social Science" },
      { name: "Alvarado, Marisa", room: "Room1125", subject: "Biology/APES" },
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

    function highlightMatch(text, query) {
      const re = new RegExp(`(${query})`, 'gi');
      return text.replace(re, '<span class="highlight">$1</span>');
    }

    function displayTeachers(teachers, query = '') {
      teacherList.innerHTML = '';
      teachers.forEach(teacher => {
        const div = document.createElement('div');
        div.className = 'teacher-card';
        const name = query ? highlightMatch(teacher.name, query) : teacher.name;
        const room = query ? highlightMatch(teacher.room, query) : teacher.room;
        const subject = query ? highlightMatch(teacher.subject, query) : teacher.subject;
        div.innerHTML = `<strong>${name}</strong><br>${room}<br>${subject}`;
        teacherList.appendChild(div);
      });
    }

    searchInput.addEventListener('input', () => {
      const query = searchInput.value.toLowerCase();
      const filtered = classes.filter(t =>
        t.name.toLowerCase().includes(query) ||
        t.room.toLowerCase().includes(query) ||
        t.subject.toLowerCase().includes(query)
      );
      displayTeachers(filtered, query);
    });

    displayTeachers(classes);
  </script>
</body>
</html>
