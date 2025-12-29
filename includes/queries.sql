create table ph_population (
    id int auto_increment primary key,
    province varchar(255) not null,
    capital varchar(255) not null,
    region varchar(50) not null,
    island_group varchar(50) not null,
    year_2020 decimal(15,2) not null,
    year_2000 decimal(15,2) not null,
    year_2010 decimal(15,2) not null,
    year_2015 decimal(15,2) not null
);

SELECT island_group,
    SUM(year_2000) AS total_population_2000,
    SUM(year_2010) AS total_population_2010,
    SUM(year_2015) AS total_population_2015,
    SUM(year_2020) AS total_population_2020 
FROM ph_population WHERE island_group IN ('Luzon', 'Visayas', 'Mindanao')
GROUP BY island_group;

SELECT region, COUNT(*) AS province_count
FROM ph_population
GROUP BY region ORDER BY region;

SELECT capital, region FROM ph_population WHERE island_group IN ('Luzon');

SELECT province, year_2020 AS population 
FROM ph_population
GROUP BY year_2020 DESC
LIMIT 5;

SELECT region,
    SUM(year_2000) AS total_population_2000,
    SUM(year_2010) AS total_population_2010,
    SUM(year_2015) AS total_population_2015,
    SUM(year_2020) AS total_population_2020 
FROM ph_population WHERE region IN ('NCR');

SELECT province, year_2000, year_2010, year_2015, year_2020
FROM ph_population WHERE province IN (
    'Metro Manila
Cebu
Cavite
Bulacan
Laguna
Rizal
Negros Occidental
Pangasinan
Batangas
Pampanga
Iloilo
Davao del Sur
Nueva Ecija
Quezon
Camarines Sur
Leyte
Zamboanga del Sur
Isabela
Misamis Oriental
South Cotabato
Maguindanao
Bukidnon
Tarlac
Cotabato
Negros Oriental
Bohol
Albay
Cagayan
Palawan
Lanao del Sur
Davao del Norte
Lanao del Norte
Zamboanga del Norte
Sulu
Zambales
Masbate
Oriental Mindoro
Sultan Kudarat
Bataan
Sorsogon
Benguet
La Union
Capiz
Samar
Compostela Valley
Agusan del Norte
Agusan del Sur
Ilocos Sur
Zamboanga Sibugay
Surigao del Sur
Northern Samar
Camarines Norte
Misamis Occidental
Aklan
Antique
Ilocos Norte
Davao Oriental
Sarangani
Basilan
Surigao del Norte
Occidental Mindoro
Nueva Vizcaya
Eastern Samar
Tawi-Tawi
Southern Leyte
Davao Occidental
Romblon
Catanduanes
Abra
Marinduque
Aurora
Kalinga
Ifugao
Quirino
Guimaras
Biliran
Mountain Province
Dinagat Islands
Apayao
Siquijor
Camiguin
Batanes

);

NCR
VII
IV-A
III
IV-A
IV-A
VI
I
IV-A
III
VI
XI
III
IV-A
V
VIII
IX
II
X
XII
BARMM
X
III
XII
VII
VII
V
II
Mimaropa
BARMM
XI
X
IX
BARMM
III
V
Mimaropa
XII
III
V
CAR
I
VI
VIII
XI
XIII
XIII
I
IX
XIII
VIII
V
X
VI
VI
I
XI
XII
BARMM
XIII
Mimaropa
II
VIII
BARMM
VIII
XI
Mimaropa
V
CAR
Mimaropa
III
CAR
CAR
II
VI
VIII
CAR
XIII
CAR
VII
X
II
