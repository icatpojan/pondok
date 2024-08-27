<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Current;
use App\Forecast;
use Illuminate\Support\Facades\Http;
use App\Segment;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = Segment::where('nama_jalur', 'CAWANG - BOGOR')->orWhere('nama_jalur', 'CAWANG - CIKAMPEK')->get(['lat_mulai', 'lon_mulai']);
        // foreach ($data as $value) {
        //     echo ('https://api.weatherapi.com/v1/forecast.json?key=bd4307938678417898c41207221204&q=' . $value->lat_mulai . ',' . $value->lon_mulai);
        //     echo '<br>';
        // }
        foreach ($data as $value) {
            $jam = now()->format('H');
            $response1 =  Http::get('https://api.weatherapi.com/v1/forecast.json?key=bd4307938678417898c41207221204&q=' . $value->lat_mulai . ',' . $value->lon_mulai);
            $Current = Current::create([
                'name' => $response1['location']['name'],
                'region' => $response1['location']['region'],
                'country' => $response1['location']['country'],
                'lat' => $response1['location']['lat'],
                'lon' => $response1['location']['lon'],
                'tz_id' => $response1['location']['tz_id'],
                'localtime_epoch' => $response1['location']['localtime_epoch'],
                'localtime_weather' => $response1['location']['localtime'],
                'condition' => $response1['current']['condition']['text'],
                'code' => $response1['current']['condition']['code'],
                'icon' => $response1['current']['condition']['icon'],
                'last_updated_epoch' => $response1['current']['last_updated_epoch'],
                'last_updated' => $response1['current']['last_updated'],
                'temp_c' => $response1['current']['temp_c'],
                'temp_f' => $response1['current']['temp_f'],
                'is_day' => $response1['current']['is_day'],
                'wind_mph' => $response1['current']['wind_mph'],
                'wind_kph' => $response1['current']['wind_kph'],
                'wind_degree' => $response1['current']['wind_degree'],
                'wind_dir' => $response1['current']['wind_dir'],
                'pressure_mb' => $response1['current']['pressure_mb'],
                'pressure_in' => $response1['current']['pressure_in'],
                'precip_mm' => $response1['current']['precip_mm'],
                'precip_in' => $response1['current']['precip_in'],
                'humidity' => $response1['current']['humidity'],
                'cloud' => $response1['current']['cloud'],
                'feelslike_c' => $response1['current']['feelslike_c'],
                'feelslike_f' => $response1['current']['feelslike_f'],
                'vis_km' => $response1['current']['vis_km'],
                'vis_miles' => $response1['current']['vis_miles'],
                'uv' => $response1['current']['uv'],
                'gust_mph' => $response1['current']['gust_mph'],
                'gust_kph' => $response1['current']['gust_kph']
            ]);
            $jam++;
            for ($i = 0; $i < 3; $i++) {
                $Forecast = Forecast::create([
                    'id_current' => $Current->id,
                    'condition' => $response1['forecast']['forecastday'][0]['hour'][$jam]['condition']['text'],
                    'code' => $response1['forecast']['forecastday'][0]['hour'][$jam]['condition']['code'],
                    'icon' => $response1['forecast']['forecastday'][0]['hour'][$jam]['condition']['icon'],
                    'time_epoch' => $response1['forecast']['forecastday'][0]['hour'][$jam]['time_epoch'],
                    'time' => $response1['forecast']['forecastday'][0]['hour'][$jam]['time'],
                    'temp_c' => $response1['forecast']['forecastday'][0]['hour'][$jam]['temp_c'],
                    'temp_f' => $response1['forecast']['forecastday'][0]['hour'][$jam]['temp_f'],
                    'is_day' => $response1['forecast']['forecastday'][0]['hour'][$jam]['is_day'],
                    'wind_mph' => $response1['forecast']['forecastday'][0]['hour'][$jam]['wind_mph'],
                    'wind_kph' => $response1['forecast']['forecastday'][0]['hour'][$jam]['wind_kph'],
                    'wind_degree' => $response1['forecast']['forecastday'][0]['hour'][$jam]['wind_degree'],
                    'wind_dir' => $response1['forecast']['forecastday'][0]['hour'][$jam]['wind_dir'],
                    'pressure_mb' => $response1['forecast']['forecastday'][0]['hour'][$jam]['pressure_mb'],
                    'pressure_in' => $response1['forecast']['forecastday'][0]['hour'][$jam]['pressure_in'],
                    'precip_mm' => $response1['forecast']['forecastday'][0]['hour'][$jam]['precip_mm'],
                    'precip_in' => $response1['forecast']['forecastday'][0]['hour'][$jam]['precip_in'],
                    'humidity' => $response1['forecast']['forecastday'][0]['hour'][$jam]['humidity'],
                    'cloud' => $response1['forecast']['forecastday'][0]['hour'][$jam]['cloud'],
                    'feelslike_c' => $response1['forecast']['forecastday'][0]['hour'][$jam]['feelslike_c'],
                    'feelslike_f' => $response1['forecast']['forecastday'][0]['hour'][$jam]['feelslike_f'],
                    'windchill_c' => $response1['forecast']['forecastday'][0]['hour'][$jam]['windchill_c'],
                    'windchill_f' => $response1['forecast']['forecastday'][0]['hour'][$jam]['windchill_f'],
                    'heatindex_c' => $response1['forecast']['forecastday'][0]['hour'][$jam]['heatindex_c'],
                    'heatindex_f' => $response1['forecast']['forecastday'][0]['hour'][$jam]['heatindex_f'],
                    'dewpoint_c' => $response1['forecast']['forecastday'][0]['hour'][$jam]['dewpoint_c'],
                    'dewpoint_f' => $response1['forecast']['forecastday'][0]['hour'][$jam]['dewpoint_f'],
                    'will_it_rain' => $response1['forecast']['forecastday'][0]['hour'][$jam]['will_it_rain'],
                    'chance_of_rain' => $response1['forecast']['forecastday'][0]['hour'][$jam]['chance_of_rain'],
                    'will_it_snow' => $response1['forecast']['forecastday'][0]['hour'][$jam]['will_it_snow'],
                    'chance_of_snow' => $response1['forecast']['forecastday'][0]['hour'][$jam]['chance_of_snow'],
                    'vis_km' => $response1['forecast']['forecastday'][0]['hour'][$jam]['vis_km'],
                    'vis_miles' => $response1['forecast']['forecastday'][0]['hour'][$jam]['vis_miles'],
                    'gust_mph' => $response1['forecast']['forecastday'][0]['hour'][$jam]['gust_mph'],
                    'gust_kph' => $response1['forecast']['forecastday'][0]['hour'][$jam]['gust_kph'],
                    'uv' => $response1['forecast']['forecastday'][0]['hour'][$jam]['uv']
                ]);
                $jam++;
                $jam > 23 ? $jam = 0 : $jam;
            }
        }
        $this->info('berhasil');
    }
}
