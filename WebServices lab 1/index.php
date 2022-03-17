<?php
  spl_autoload_register(function($class)
  {
    include "$class.php";
  });

  $EgyptianCities = WeatherAPI::get_cities('eg');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<form action="" method="get" id="chooseCityForm">
  <select name="city" id="city">
    <?php for($i = 0; $i < count($EgyptianCities); $i++) { ?>
      <option value="<?= $i ?>" data-lat="<?= $EgyptianCities[$i]['coord']['lat'] ?>"
              data-lon="<?= $EgyptianCities[$i]['coord']['lon'] ?>"><?= $EgyptianCities[$i]['name'] ?></option>
    <?php } ?>
  </select>
  <button type="submit">Show Weather</button>
</form>

<div id="weatherData"></div>
<script>
  const form = document.getElementById("chooseCityForm");
  const cityWeather = document.getElementById("weatherData");
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const cityIndex = parseInt(form.city.value, 10);
    const option = document.getElementsByTagName("option")[cityIndex];
    const lon = option.getAttribute("data-lon");
    const lat = option.getAttribute("data-lat");
    fetch(`get_weather.php?lat=${lat}&lon=${lon}`)
        .then(r => r.json())
        .then(result => {
          cityWeather.innerHTML = ' ';
          cityWeather.innerHTML += `<h2>${result.name}</h2>`;
          for (let w of result.weather) {
            cityWeather.innerHTML += `<p>${w.main}: &nbsp; ${w.description}</p>`;
          }
          cityWeather.innerHTML += `<p>Wind Speed: ${result.wind.speed} - Direction: ${result.wind.deg} - Gust: ${result.wind.gust}</p>`;
          cityWeather.innerHTML += `<p>Temperature: ${(result.main.temp - 273.15).toFixed(2)}</p>`;
          cityWeather.innerHTML += `<p>Feels Like: ${result.main.feels_like}</p>`;
          cityWeather.innerHTML += `<p>Pressure: ${result.main.pressure}</p>`;
          cityWeather.innerHTML += `<p>Humidity: ${result.main.humidity}%</p>`;
          cityWeather.innerHTML += `<p>Minimum Temperature: ${(result.main.temp_min - 273.15).toFixed(2)}</p>`;
          cityWeather.innerHTML += `<p>Maximum Temperature: ${(result.main.temp_max - 273.15).toFixed(2)}</p>`;
          cityWeather.innerHTML += `<p>Pressure on Sea Level: ${result.main.sea_level}</p>`;
          cityWeather.innerHTML += `<p>Pressure on Ground Level: ${result.main.grnd_level}</p>`;
        }).catch(console.error);
  });
</script>
</body>
</html>
