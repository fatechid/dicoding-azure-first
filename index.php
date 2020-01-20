<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Azure Submission - First">
    <meta name="author" content="FATechID">
    <meta name="keywords" content="FATechID - Registration">
    <link rel="icon" type="image/png" href="assets/images/favicon/favicon-192x192.png"/>

    <title>FATechID - Register</title>
    <link href="assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="assets/css/main-register.css" rel="stylesheet" media="all">

</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>

                    <form method="post" action="index.php" enctype="multipart/form-data" >

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Name</label>
                                    <input class="input--style-4" type="text" name="name">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Job</label>
                                    <input class="input--style-4" type="text" name="job">
                                </div>
                            </div>

                        </div>


                        <div class="row row-space">

                            <div class="col-2">
                                <div class="input-group" data-validate = "Valid email is required: ex@abc.xyz">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="text" name="username">
                                </div>
                            </div>

                        </div>

                        <div class="row row-space">

                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--green" type="submit" name="submit">Submit</button>
                        </div>

                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="load_users" name="load_users">Load Data</button>
                        </div>
                        
                        </div>

                    </form>   

        
                    <?php
    $host = "faqs-server.database.windows.net";
    $user = "FATechID";
    $pass = "KamisamaTasukatta127";
    $db = "faqsdb";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $job = $_POST['job'];
            // Insert data
            $sql_insert = "INSERT INTO users (name, username, job) 
                        VALUES (?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $username);
            $stmt->bindValue(3, $job);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<br><strong>Register Successfully</strong>";
        
    } else if (isset($_POST['load_users'])) {
        try {
            $sql_select = "SELECT * FROM users";
            $stmt = $conn->query($sql_select);
            $users = $stmt->fetchAll(); 
            if(count($users) > 0) {
                echo "<br><br><h5><strong>People who are registered:</strong></h5><br>";
                echo "<table class='highlight'>";
                echo "<tr><th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Job</th>";
                echo "<th>Create At</th></tr>";
                foreach($users as $users) {
                    echo "<tr><td>".$users['name']."</td>";
                    echo "<td>".$users['username']."</td>";
                    echo "<td>".$users['job']."</td>";
                    echo "<td>".$users['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<br><h5><strong>No one is currently registered</strong></h5>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>

                    
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="assets/js/global.js"></script>



</body>

</html>