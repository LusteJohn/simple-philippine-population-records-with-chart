<?php
require_once('config.php');
$cn = new config();
$conn = $cn->connectDB();

// first chart
if(isset($_POST['action']) && $_POST['action']=="getData") {
    $year = $_POST['year'];
    
    try {
        $sql = "SELECT island_group,
                    SUM($year) AS total_population
                FROM ph_population WHERE island_group IN ('Luzon', 'Visayas', 'Mindanao')
                GROUP BY island_group";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56']; // Different colors for courses

        $data['labels'] = [];  // Island groups (Luzon, Visayas, Mindanao)
        $data['datasets'] = [
            'data' => [],
            'backgroundColor' => []
        ];
    
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['island_group'];
                $data['data'][] = $row['total_population'];
                $data['backgroundColor'][] = $colors[$i % count($colors)]; // Assign colors cyclically
                $i++;
            }
        }
    
        $conn->close();
    }
    catch(Exception $e) {
        $response = array("success" => false, "message" => "Failed to Save Record!");
    }
    finally {
        $stmt->close();
    }
    
    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}

// Second chart
else if (isset($_POST['action']) && $_POST['action'] == "getProvinces") {
    try {
        $sql = "SELECT region, 
                    COUNT(*) AS province_count 
                FROM ph_population 
                GROUP BY region 
                ORDER BY region";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#8E44AD', '#F39C12', '#00FFCC', '#990000', '#66FF33', '#FFFF00', '#FF66FF', '#CC00FF', '#99FFCC', '#9999FF', '#6633FF', '#660066', '#00FFFF']; // Different colors for courses

        $data['labels'] = [];  
        $data['datasets'] = [
            'data' => [],
            'backgroundColor' => []
        ];
    
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['region'];
                $data['data'][] = $row['province_count'];
                $data['backgroundColor'][] = $colors[$i % count($colors)]; // Assign colors cyclically
                $i++;
            }
        }
    
        $conn->close();
    }
    catch(Exception $e) {
        $response = array("success" => false, "message" => "Failed to Save Record!");
    }
    finally {
        $stmt->close();
    }
    
    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}

// Third chart
else if (isset($_POST['action']) && $_POST['action'] == "getYear") {
    $province = $_POST['provinceList'];

    try {
        // change into province the capital
        $sql = "SELECT province, year_2000, year_2010, year_2015, year_2020
                FROM ph_population WHERE province = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $province);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50']; // Different colors for courses

        $data['labels'] = ['Year 2000', 'Year 2010', 'Year 2015', 'Year 2020'];; 
        $data['datasets'] = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataset = [
                    'label' => $row['province'], // province name as dataset label
                    'data' => [
                        $row['year_2000'],
                        $row['year_2010'],
                        $row['year_2015'],
                        $row['year_2020']
                    ],
                    'backgroundColor' => $colors
                ];
                $data['datasets'][] = $dataset; // Append dataset
            }
        }
    
        $conn->close();
    }
    catch(Exception $e) {
        $response = array("success" => false, "message" => "Failed to Save Record!");
    }
    finally {
        $stmt->close();
    }
    
    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}

// Fourth chart
else if (isset($_POST['action']) && $_POST['action'] == "getTopProvinces") {
    try {
        $sql = "SELECT province, year_2020 AS population 
                FROM ph_population 
                ORDER BY year_2020 
                DESC LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#8E44AD']; // Different colors for courses

        $data['labels'] = [];  
        $data['datasets'] = [
            'data' => [],
            'backgroundColor' => []
        ];
    
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['province'];
                $data['data'][] = $row['population'];
                $data['backgroundColor'][] = $colors[$i % count($colors)]; // Assign colors cyclically
                $i++;
            }
        }
    
        $conn->close();
    }
    catch(Exception $e) {
        $response = array("success" => false, "message" => "Failed to Save Record!");
    }
    finally {
        $stmt->close();
    }
    
    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}

// Fifth chart
else if (isset($_GET['action']) && $_GET['action'] == 'getData') {
    if (!isset($_GET['island_group']) || empty($_GET['island_group'])) {
        echo json_encode(["success" => false, "message" => "Island group not provided"]);
        exit;
    }

    $island_group = $_GET['island_group'];

    try {
        $sql = "SELECT capital, region 
                FROM ph_population 
                WHERE island_group = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $island_group);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $response = array("success" => true, "data" => $data);
        }
        else {
            $response = array("success" => false, "message" => "Failed to load data"); 
        }

    }
    catch(Exception $e) {
        $response = array("success" => false, "message" => "Failed to Save Record!");
    }
    finally {
        $stmt->close();
    }
    
    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}

// Sixth chart
else if (isset($_POST['action']) && $_POST['action'] == "getRegion") {
    $region = $_POST['regionList'];

    try {
        $sql = "SELECT region, 
                    SUM(year_2000) AS total_population_2000,
                    SUM(year_2010) AS total_population_2010,
                    SUM(year_2015) AS total_population_2015,
                    SUM(year_2020) AS total_population_2020 
                FROM ph_population WHERE region = ?
                GROUP BY region"; 

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $region);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        $colors = ['#66FF33', '#36A2EB', '#FFCE56', '#4CAF50']; 

        $data['labels'] = ['Year 2000', 'Year 2010', 'Year 2015', 'Year 2020']; 
        $data['datasets'] = [];

        if ($result->num_rows > 0) {
            $colorIndex = 0;
            while ($row = $result->fetch_assoc()) {
                $dataset = [
                    'label' => $row['region'], // Use province name
                    'data' => [
                        $row['total_population_2000'],
                        $row['total_population_2010'],
                        $row['total_population_2015'],
                        $row['total_population_2020']
                    ],
                    'borderColor' => $colors[$colorIndex % count($colors)], // Ensure colors cycle
                    'fill' => false,
                    'tension' => 0.4
                ];
                $data['datasets'][] = $dataset;
                $colorIndex++;
            }
        }

        $conn->close();
    }
    catch(Exception $e) {
        $response = array("success" => false, "message" => "Failed to fetch data!");
    }
    finally {
        $stmt->close();
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);
}


?>