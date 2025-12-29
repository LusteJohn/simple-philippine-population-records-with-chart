<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/css/all.css">
    <link rel="stylesheet" href="css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="css/chartcss.css">
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="header-overlay">
            <div class="header-content">
                <h1 class="text-center mt-3">Philippine Population</h1>
                <p>This data record from year 2000, 2010, 2015, and 2020</p>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-3">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav gap-4">
                                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Data</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        
    </div>

    <!-- Main Content -->
<div class="container mt-4">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="dashboard-box p-3">
                <h5 class="text-center">Overall Population Data of Island Group</h5>
                <div class="d-flex justify-content-between align-items-center gap-2 mt-3 mb-2">
                    <form id="filterYear" method="post" action="">
                        <button class="btn btn-outline-info" data-group="year_2000">2000</button>
                        <button class="btn btn-outline-info"  data-group="year_2010">2010</button>
                        <button class="btn btn-outline-info"  data-group="year_2015">2015</button>
                        <button class="btn btn-outline-info" data-group="year_2020">2020</button>
                    </form>
                </div>
                <canvas id="myPieChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboard-box p-3">
                <h5 class="text-center">Number of Provinces Per Region</h5>
                <canvas id="myLineBarChart"></canvas>
            </div>
        </div>
        <div class="col-md-12">
            <div class="dashboard-box p-3">
                <h5 class="text-center">Province Population from (2000, 2010, 2015, 2020)</h5>
                <canvas id="myBarChart"></canvas>
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <form id="filterProvince" method="post" action="">
                        <label for="province">Select Province:</label>
                        <select name="provinceList" id="provinceList" style="width: 100%;">
                            <option value="Metro Manila">Metro Manila</option>
                            <option value="Cebu">Cebu</option>
                            <option value="Cavite">Cavite</option>
                            <option value="Bulacan">Bulacan</option>
                            <option value="Laguna">Laguna</option>
                            <option value="Rizal">Rizal</option>
                            <option value="Negros Occidental">Negros Occidental</option>
                            <option value="Pangasinan">Pangasinan</option>
                            <option value="Batangas">Batangas</option>
                            <option value="Pampanga">Pampanga</option>
                            <option value="Iloilo">Iloilo</option>
                            <option value="Davao del Sur">Davao del Sur</option>
                            <option value="Nueva Ecija">Nueva Ecija</option>
                            <option value="Quezon">Quezon</option>
                            <option value="Camarines Sur">Camarines Sur</option>
                            <option value="Leyte">Leyte</option>
                            <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                            <option value="Isabela">Isabela</option>
                            <option value="Misamis Oriental">Misamis Oriental</option>
                            <option value="South Cotabato">South Cotabato</option>
                            <option value="Maguindanao">Maguindanao</option>
                            <option value="Bukidnon">Bukidnon</option>
                            <option value="Tarlac">Tarlac</option>
                            <option value="Cotabato">Cotabato</option>
                            <option value="Negros Oriental">Negros Oriental</option>
                            <option value="Bohol">Bohol</option>
                            <option value="Albay">Albay</option>
                            <option value="Cagayan">Cagayan</option>
                            <option value="Palawan">Palawan</option>
                            <option value="Tagum"></option>
                            <option value="Tubod"></option>
                            <option value="Dipolog"></option>
                            <option value="Jolo"></option>
                            <option value="Iba"></option>
                            <option value="Masbate City"></option>
                            <option value="Calapan"></option>
                            <option value="Isulan"></option>
                            <option value="Balanga"></option>
                            <option value="Sorsogon City"></option>
                            <option value="La Trinidad"></option>
                            <option value="San Fernando"></option>
                            <option value="Roxas"></option>
                            <option value="Catbalogan"></option>
                            <option value="Nabunturan"></option>
                            <option value="Cabadbaran"></option>
                            <option value="Prosperidad"></option>
                            <option value="Vigan"></option>
                            <option value="Ipil"></option>
                            <option value="Tandag"></option>
                            <option value="Daet"></option>
                            <option value="Oroquieta"></option>
                            <option value="Kalibo"></option>
                            <option value="San Jose de Buenavista"></option>
                            <option value="Laoag"></option>
                            <option value="Mati"></option>
                            <option value="Alabel"></option>
                            <option value="Lamitan"></option>
                            <option value="Surigao City"></option>
                            <option value="Mamburao"></option>
                            <option value="Bayombong"></option>
                            <option value="Borongan"></option>
                            <option value="Bongao"></option>
                            <option value="Maasin"></option>
                            <option value="Malita"></option>
                            <option value="Romblon"></option>
                            <option value="Virac"></option>
                            <option value="Bangued"></option>
                            <option value="Boac"></option>
                            <option value="Baler"></option>
                            <option value="Tabuk"></option>
                            <option value="Lagawe"></option>
                            <option value="Cabarroguis"></option>
                            <option value="Jordan"></option>
                            <option value="Naval"></option>
                            <option value="Bontoc"></option>
                            <option value="San Jose"></option>
                            <option value="Kabugao"></option>
                            <option value="Siquijor"></option>
                            <option value="Mambajao"></option>
                            <option value="Basco"></option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboard-box p-3">
                <h5 class="text-center">Top 5 Most Populated Provinces of 2020</h5>
                <canvas id="myDonutChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboard-box p-3 w-100">
                <h5 class="text-center">List of Capital and Region in Island Group</h5>
                <div class="d-flex justify-content-end mb-2">
                    <form id="filterIsland" method="POST" action="">
                        <button class="btn btn-outline-info" data-group="Luzon">Luzon</button>
                        <button class="btn btn-outline-info" data-group="Visayas">Visayas</button>
                        <button class="btn btn-outline-info" data-group="Mindanao">Mindanao</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-border table-striped text-center w-100" id="tbl_display">
                        <thead class="table-dark">
                            <tr>
                                <th>Capital</th>
                                <th>Region</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- display the result-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="dashboard-box p-3">
                <h5 class="text-center">Region Population from (2000, 2010, 2015, 2020)</h5>
                <canvas id="mylineChart"></canvas>
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <form id="filterRegion" method="post" action="">
                        <label for="region">Select Region:</label>
                        <select name="regionList" id="regionList" style="width: 100%;">
                            <option value="NCR">NCR</option>
                            <option value="VII">VII</option>
                            <option value="IV-A">IV-A</option>
                            <option value="III">III</option>
                            <option value="VI">VI</option>
                            <option value="I">I</option>
                            <option value="XI">XI</option>
                            <option value="V">V</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                            <option value="II">II</option>
                            <option value="X">X</option>
                            <option value="XII">XII</option>
                            <option value="BARMM">BARMM</option>
                            <option value="Mimaropa">Mimaropa</option>
                            <option value="CAR">CAR</option>
                            <option value="XIII">XIII</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer class="footer mt-4">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?>. All rights reserved</p>
        </div>
    </footer>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/chartdata.js"></script>
</body>
</html>
