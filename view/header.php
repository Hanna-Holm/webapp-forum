<?php 

if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
      echo '<div class="header">
      <a href="../index.php">
            <img src="../assets/placeholder-logo-7.png" alt="logo-image" id="logo">
      </a>
      <div id="menu">
            <form action="../forum/search-forum.php" method="get">
                  <input type="text" id="search-field" placeholder="Search..." name="search-input">
                  <input type="image" src="../assets/search-icon.png" alt="Search" id="search-icon">
            </form>';

            if ($_SERVER['REQUEST_URI'] == "/INDIVIDUELL%20UPPGIFT/forum/threads.php") {
                  echo '<p>Forum</p>
                  <a href="createthread.php">Create new thread</a>
                  <a href="../personalpage/myprofile.php">My profile</a>
                  <a href="../logoutscreen.php">Log out</a></div>
            </div>
            
            <div id="hamburger-menu" onclick="toggleMenu()">
                  <img src="../assets/hb-menu-icon.png">
                  <div class="menu-option"><p>Forum</p></div>
                  <div class="menu-option"><a href="createthread.php">Create new thread</a></div>
                  <div class="menu-option"><a href="../personalpage/myprofile.php">My profile</a></div>
                  <div class="menu-option"><a href="../logoutscreen.php">Log out</a></div></div>
            </div></div>';
            }
            else if ($_SERVER['REQUEST_URI'] == "/INDIVIDUELL%20UPPGIFT/forum/createthread.php") {
                  echo '<a href="threads.php">Forum</a>
                  <p>Create new thread</p>
                  <a href="../personalpage/myprofile.php">My profile</a>
                  <a href="../logoutscreen.php">Log out</a></div>
                  
                  <div id="hamburger-menu">
                        <img src="../assets/hb-menu-icon.png"  onclick="toggleMenu()">
                        <div class="menu-option"><a href="threads.php">Forum</a></div>
                        <div class="menu-option"><p>Create new thread</p></div>
                        <div class="menu-option"><a href="../personalpage/myprofile.php">My profile</a></div>
                        <div class="menu-option"><a href="../logoutscreen.php">Log out</a></div></div>
                  </div></div>';
            }
            else if ($_SERVER['REQUEST_URI'] == "/INDIVIDUELL%20UPPGIFT/personalpage/myprofile.php") {
                  echo '<a href="../forum/threads.php">Forum</a>
                  <a href="../forum/createthread.php">Create new thread</a>
                  <p>My profile</p>
                  <a href="../logoutscreen.php">Log out</a></div>

                  <div id="hamburger-menu" onclick="toggleMenu()">
                        <img src="../assets/hb-menu-icon.png">
                        <div class="menu-option"><a href="../forum/threads.php">Forum</a></div>
                        <div class="menu-option"><a href="../forum/createthread.php">Create new thread</a></div>
                        <div class="menu-option"><p>My profile</p></div>
                        <div class="menu-option"><a href="../logoutscreen.php">Log out</a></div></div>
                  </div></div>';
            }
            else {
                  echo '<a href="../forum/threads.php">Forum</a>
                        <a href="../forum/createthread.php">Create new thread</a>
                        <a href="../personalpage/myprofile.php">My profile</a>
                        <a href="../logoutscreen.php">Log out</a></div>
                        
                        <div id="hamburger-menu" onclick="toggleMenu()">
                              <img src="../assets/hb-menu-icon.png">
                              <div class="menu-option"><a href="../forum/threads.php">Forum</a></div>
                              <div class="menu-option"><a href="../forum/createthread.php">Create new thread</a></div>
                              <div class="menu-option"><a href="../personalpage/myprofile.php">My profile</a></div>
                              <div class="menu-option"><a href="../logoutscreen.php">Log out</a></div>
                        </div></div>';
            }
      }

?>