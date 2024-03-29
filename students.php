<?php
require_once "userconnection.php";
require "formfunctions.php";
usercheck_login();

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['createStudentAccount'])) {
        $errors = createStudentAccount($_POST);
    } elseif (isset($_POST['updateStudentAccount'])) {
        $errors = updateStudentAccount($_POST);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="students.css">
    <title>Document</title>
</head>
<body>
    <div class="sidebar"> 
        <div class="top">
        </div>
        <div class="user">
            <img src="images/user.jpg" alt="">
            <div>
                <p class="name">Administrator</p>
                <p class="rank">Admin</p>
            </div>
        </div>
        <ul>
            <li>
                <a href="adminhomepage.php">
                    <i class="bx bxs-flag"></i>
                    <span class="nav-item">Departments</span>
                </a>
            </li>
            <li>
                <a href="semesters.php">
                    <i class="bx bx-sitemap"></i>
                    <span class="nav-item">Semesters</span>
                </a>
            </li>
            <li>
                <a href="teachers.php">
                    <i class="bx bx-user"></i>
                    <span class="nav-item">Teachers</span>
                </a>
            </li>
            <li>
                <a href="" class="admindashboard_btn">
                    <i class="bx bxs-user"></i>
                    <span class="nav-item">Students</span>
                </a>
            </li>
            <li>
                <a href="logout.php" onclick="return confirm('Log out account?');">
                    <i class="bx bx-log-out"></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="maincontainer">
            <div class="studentboxcontainer">
                <div class="createbtncontainer">
                    <button class="create_btn" id="createStudentAccount" onclick="openCreateModal()">Create student account</button>
                </div>
                <div class="container">
                    <div class="studenttxt">Student List :</div>
                    <div class="student-box">
                    <div class="studenttxt">First Year :</div>
                        <?php
                        require_once("userconnection.php");
                        $newconnection = new Connection();
                        $connection = $newconnection->openConnection();

                        $sql = "SELECT * FROM students WHERE year_level = '1st Year' ORDER BY department_id";
                        $result = $connection->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            $department = $row['department_id'];

                            $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = $department");
                            $stmt->execute();
                            $departments = $stmt->fetch(PDO::FETCH_OBJ);

                        ?>
                                <div class="student-card">
                                    <div class="studentprofileinfo">
                                        <div class="student-profile">
                                            <img src="<?= $departments->department_logo?>" alt="">
                                        </div>
                                        <div class="student-info">
                                            <div class="student-nametype">
                                                <div class="student-name">
                                                    <?= $row['student_name'] ?>
                                                </div>
                                                <div class="student-type">
                                                    <?= $row['department_name'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courselevel">
                                        <?= $row['year_level'] ?> - <?= $row['course_name'] ?>
                                    </div>
                                    <div class="buttons">

                                        <button class="update-student-button" id="updateStudentButton" onclick="openUpdateModal(<?= $row['student_id'] ?>)"><img src="https://cdn-icons-png.flaticon.com/128/9497/9497023.png" alt=""></button>

                                        <a href="deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"><button class="delete-student-button"><img src="https://cdn-icons-png.flaticon.com/128/9789/9789276.png" alt=""></button></a>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="nostudent">No student available.</div>
                        <?php
                        }
                        $newconnection->closeConnection();
                        ?>
                    </div>
                    <div class="student-box">
                    <div class="studenttxt">Second Year :</div>
                        <?php
                        require_once("userconnection.php");
                        $newconnection = new Connection();
                        $connection = $newconnection->openConnection();

                        $sql = "SELECT * FROM students WHERE year_level = '2nd Year' ORDER BY department_id";
                        $result = $connection->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            $department = $row['department_id'];

                            $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = $department");
                            $stmt->execute();
                            $departments = $stmt->fetch(PDO::FETCH_OBJ);

                        ?>
                                <div class="student-card">
                                    <div class="studentprofileinfo">
                                        <div class="student-profile">
                                            <img src="<?= $departments->department_logo?>" alt="">
                                        </div>
                                        <div class="student-info">
                                            <div class="student-nametype">
                                                <div class="student-name">
                                                    <?= $row['student_name'] ?>
                                                </div>
                                                <div class="student-type">
                                                    <?= $row['department_name'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courselevel">
                                        <?= $row['year_level'] ?> - <?= $row['course_name'] ?>
                                    </div>
                                    <div class="buttons">

                                        <button class="update-student-button" id="updateStudentButton" onclick="openUpdateModal(<?= $row['student_id'] ?>)"><img src="https://cdn-icons-png.flaticon.com/128/9497/9497023.png" alt=""></button>

                                        <a href="deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"><button class="delete-student-button"><img src="https://cdn-icons-png.flaticon.com/128/9789/9789276.png" alt=""></button></a>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="nostudent">No student available.</div>
                        <?php
                        }
                        $newconnection->closeConnection();
                        ?>
                    </div>
                    <div class="student-box">
                    <div class="studenttxt">Third Year :</div>
                        <?php
                        require_once("userconnection.php");
                        $newconnection = new Connection();
                        $connection = $newconnection->openConnection();

                        $sql = "SELECT * FROM students WHERE year_level = '3rd Year' ORDER BY department_id";
                        $result = $connection->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            $department = $row['department_id'];

                            $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = $department");
                            $stmt->execute();
                            $departments = $stmt->fetch(PDO::FETCH_OBJ);

                        ?>
                                <div class="student-card">
                                    <div class="studentprofileinfo">
                                        <div class="student-profile">
                                            <img src="<?= $departments->department_logo?>" alt="">
                                        </div>
                                        <div class="student-info">
                                            <div class="student-nametype">
                                                <div class="student-name">
                                                    <?= $row['student_name'] ?>
                                                </div>
                                                <div class="student-type">
                                                    <?= $row['department_name'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courselevel">
                                        <?= $row['year_level'] ?> - <?= $row['course_name'] ?>
                                    </div>
                                    <div class="buttons">

                                        <button class="update-student-button" id="updateStudentButton" onclick="openUpdateModal(<?= $row['student_id'] ?>)"><img src="https://cdn-icons-png.flaticon.com/128/9497/9497023.png" alt=""></button>

                                        <a href="deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"><button class="delete-student-button"><img src="https://cdn-icons-png.flaticon.com/128/9789/9789276.png" alt=""></button></a>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="nostudent">No student available.</div>
                        <?php
                        }
                        $newconnection->closeConnection();
                        ?>
                    </div>
                    <div class="student-box">
                    <div class="studenttxt">Fourth Year :</div>
                        <?php
                        require_once("userconnection.php");
                        $newconnection = new Connection();
                        $connection = $newconnection->openConnection();

                        $sql = "SELECT * FROM students WHERE year_level = '4th Year' ORDER BY department_id";
                        $result = $connection->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            $department = $row['department_id'];

                            $stmt = $connection->prepare("SELECT * FROM department WHERE department_id = $department");
                            $stmt->execute();
                            $departments = $stmt->fetch(PDO::FETCH_OBJ);

                        ?>
                                <div class="student-card">
                                    <div class="studentprofileinfo">
                                        <div class="student-profile">
                                            <img src="<?= $departments->department_logo?>" alt="">
                                        </div>
                                        <div class="student-info">
                                            <div class="student-nametype">
                                                <div class="student-name">
                                                    <?= $row['student_name'] ?>
                                                </div>
                                                <div class="student-type">
                                                    <?= $row['department_name'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courselevel">
                                        <?= $row['year_level'] ?> - <?= $row['course_name'] ?>
                                    </div>
                                    <div class="buttons">

                                        <button class="update-student-button" id="updateStudentButton" onclick="openUpdateModal(<?= $row['student_id'] ?>)"><img src="https://cdn-icons-png.flaticon.com/128/9497/9497023.png" alt=""></button>

                                        <a href="deleteStudent.php?studentId=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');"><button class="delete-student-button"><img src="https://cdn-icons-png.flaticon.com/128/9789/9789276.png" alt=""></button></a>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="nostudent">No student available.</div>
                        <?php
                        }
                        $newconnection->closeConnection();
                        ?>
                    </div>
                </div>
            </div>
            <?php
                require_once('userconnection.php');

                $newconnection = new Connection();
                $connection = $newconnection->openConnection();

                $stmt = $connection->prepare("SELECT * FROM department");
                $stmt->execute();
                $departments = $stmt->fetchAll(PDO::FETCH_OBJ);

                $stmt = $connection->prepare("SELECT * FROM course");
                $stmt->execute();
                $courses = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                $stmt = $connection->prepare("SELECT * FROM yearlevels");
                $stmt->execute();
                $yearlevels = $stmt->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 id="modalTitle">Create student's account</h2>
                    <form method="POST" enctype="multipart/form-data" id="studentForm" class="createModal">
                        <div class="namedepartment">
                            <div class="name">
                                <label for="studentName">Name:</label>
                                <input type="text" name="studentName" id="studentName" placeholder="Enter name" required>
                            </div>
                            <div class="department">
                                <label for="studentDepartment">Department:</label>
                                <select name="studentDepartment" id="studentDepartment" required>
                                    <option></option>
                                    <?php
                                    foreach ($departments as $department) { 
                                    ?>
                                        <option value="<?=$department->department_id?>|<?=$department->department_name?>"><?=$department->department_name?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="namedepartment">
                            <div class="name">
                                <label for="studentCourse">Course:</label>
                                <select name="studentCourse" id="studentCourse" required>
                                    <option></option>
                                    <?php
                                    foreach ($courses as $course) { 
                                    ?>
                                        <option value="<?=$course->course_id?>|<?=$course->course_name?>"><?=$course->course_name?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="department">
                                <label for="studentYearlevel">Year Level:</label>
                                <select name="studentYearlevel" id="studentYearlevel" required>
                                    <option></option>
                                    <?php
                                    foreach ($yearlevels as $yearlevel) { 
                                    ?>
                                        <option value="<?=$yearlevel->yearlevel_id?>|<?=$yearlevel->year_level?>"><?=$yearlevel->year_level?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for="studentEmail">Email:</label>
                        <input type="text" name="studentEmail" id="studentEmail" placeholder="Enter email" required>
                        <label for="studentPassword">Password:</label>
                        <div class="eyebutton"><img src="https://cdn-icons-png.flaticon.com/128/179/179531.png" alt="" class="icon" id="eyeicon"></div>
                        <input type="password" name="studentPassword" id="studentPassword" placeholder="Enter password" required>
                        <button class="submitbtn" name="createStudentAccount" onclick="submitForm()">Create</button>
                    </form>
                </div>
            </div>
            <div id="updateModal" class="modal">
                <div class="modal-content">
                    <span class="closeupdate" onclick="closeUpdateModal()">&times;</span>
                    <h2 id="modalTitle">Update Student's Account</h2>
                    <form method="POST" enctype="multipart/form-data" id="updateForm" class="updateModal">
                        <div class="namedepartment">
                            <div class="name">
                                <label for="updateStudentName">Name:</label>
                                <input type="text" name="updateStudentName" id="updateStudentName" placeholder="Enter name" required>
                            </div>
                            <div class="department">
                                <label for="updateStudentDepartment">Department:</label>
                                <select name="updateStudentDepartment" id="updateStudentDepartment" required>
                                    <option></option>
                                    <?php
                                    foreach ($departments as $department) {
                                    ?>
                                        <option value="<?= $department->department_id ?>|<?= $department->department_name ?>"><?= $department->department_name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="namedepartment">
                            <div class="name">
                                <label for="updateStudentCourse">Course:</label>
                                <select name="updateStudentCourse" id="updateStudentCourse" required>
                                    <option></option>
                                    <?php
                                    foreach ($courses as $course) {
                                    ?>
                                        <option value="<?= $course->course_id ?>|<?= $course->course_name ?>"><?= $course->course_name ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="department">
                                <label for="updateStudentYearlevel">Year Level:</label>
                                <select name="updateStudentYearlevel" id="updateStudentYearlevel" required>
                                    <option></option>
                                    <?php
                                    foreach ($yearlevels as $yearlevel) {
                                    ?>
                                        <option value="<?= $yearlevel->yearlevel_id ?>|<?= $yearlevel->year_level ?>"><?= $yearlevel->year_level ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for="updateStudentEmail">Email:</label>
                        <input type="text" name="updateStudentEmail" id="updateStudentEmail" placeholder="Enter email" required>
                        <label for="updateStudentPassword">Password:</label>
                        <div class="eyebutton"><img src="https://cdn-icons-png.flaticon.com/128/179/179531.png" alt="" class="icon" id="updateEyeIcon"></div>
                        <input type="password" name="updateStudentPassword" id="updateStudentPassword" placeholder="Enter password" required>
                        <input type="hidden" name="updateStudentId" id="updateStudentId">
                        <button class="submitbtn" name="updateStudentAccount" onclick="submitUpdateForm()">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="students.js"></script>
</body>
</html>