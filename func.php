<?php
// подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "check-up";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// выбираем нужный слайд
$slide_id = 1; // здесь задаем нужный идентификатор слайда,но вообще это надо делать динамически
$sql = "SELECT service_id FROM Slide_Services WHERE slide_id = $slide_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // выводим все медицинские услуги для этого слайда
    while ($row = $result->fetch_assoc()) {
        $service_id = $row['service_id'];
        $sql = "SELECT service FROM Services WHERE id = $service_id";
        $service_result = $conn->query($sql);
        if ($service_result->num_rows > 0) {
            // выводим  медицинской услуги
            while ($service_row = $service_result->fetch_assoc()) {
                $service_service = $service_row['service'];
                echo "<li class='swiper-slide__item'>$service_name</li>";
            }
        }
    }
} else {
    echo "No services found for this slide";
}

// закрываем соединение с базой данных
$conn->close();
?>