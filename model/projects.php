<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
              /* Style for the pagination links */
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #133054;
    color: #f9c013;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

/* Style for the current page number */
.pagination .current-page {
    display: inline-block;
    padding: 5px 10px;
    background-color: #f9c013;
    color: #133054;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

/* Style for the "Previous" and "Next" buttons */
.pagination .previous,
.pagination .next {
    padding: 5px 10px;
    background-color: #133054;
    color: #f9c013;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

/* Hover effect for the buttons */
.pagination a:hover,
.pagination .previous:hover,
.pagination .next:hover {
    background-color: #f9c013;
    color: #133054;
}
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f9c013;
            background-color: #133054;
            padding: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            border: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        .search-bar button {
            background-color: #133054;
            color: #f9c013;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        /* Reset some default styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Light gray background */
        }

        /* Card and Line Styles */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .line {
            border-top: 2px solid #133054; /* Colored line */
            width: 100%;
            margin-top: 20px;
        }

        .card {
            flex-basis: calc(33.33% - 20px); /* Three cards in a row with spacing */
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s; /* Add hover animation */
        }

        .card:hover {
            transform: scale(1.05); /* Enlarge the card on hover */
        }

        .card h2 {
            font-size: 1.25rem;
            color: #333;
            font-weight: 500;
        }

        .view {
            display: inline-block;
            background-color: #00004d;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .view:hover {
            background-color: #000030;
        }

        .delete {
            display: inline-block;
            background-color: #ff0000;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .delete:hover {
            background-color: #992600;
        }

        .pro {
            display: inline-block;
            background-color: #00004d;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .pro:hover {
            background-color: #000030;
        }
    </style>
</head>
<body>
    <?php
    include('sidebar.php');
    ?>

    <div class="content">
        <div class="header">
            <h1>Projects</h1>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>

        <!-- Container for total projects and Add Project button -->
        <div class="summary-container">
            <div class="card">
                <h2>Total Projects</h2>
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';

                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch total number of projects from the database
                $sql = "SELECT COUNT(*) as total_projects FROM projects";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo '<p>' . $row['total_projects'] . '</p>';
                } else {
                    echo '<p>0</p>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>

            <div class="card">
                <h2>Add Project</h2>
                <a class="pro" href="add_project.php">Add Project</a>
            </div>
        </div>


        <div class="line"></div>

        

        <!-- Container for project cards -->
        <div class="card-container">
            <!-- ... your previous cards ... -->
            <?php
            // Fetch project records from the database and populate the cards
            $conn = mysqli_connect($host, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT id, name, description, author, link FROM projects";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card">';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Author: ' . $row['author'] . '</p>';
                    echo '<a  href="' . $row['link'] . '" target="_blank" class="view">View Project</a>';

                    // Add the Delete Project button with a link to the delete_project.php script
                    echo '<a href="../controller/delete_project.php?id=' . $row['id'] . '" class="delete">Delete Project</a>';

                    echo '</div>';
                }
            } else {
                echo '<p>No Projects found</p>';
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>

        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>

        <?php
        include('footer.php');
        ?>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        // Function to load project records
        function loadProjectRecords() {
            var searchText = $('#search-input').val();

            // Make an AJAX request to fetch matching project records
            $.ajax({
                url: 'search/search_projects.php',
                method: 'POST',
                data: { searchText: searchText },
                success: function(response) {
                    // Update the card-container with the search results
                    $('.card-container').html(response);
                }
            });
        }

        // Search input change event
        $('#search-input').on('input', function() {
            loadProjectRecords();
        });

        // Initial load of project records
        loadProjectRecords();
    });
</script>
</html>
