<?php
interface Price
{
    public function getPrice();
}
trait Gps
{
    protected $gpsHourCost = 15;
}
trait AdditionalDriver
{
    protected $driverCost = 100;
}

abstract class Tariff implements Price
{
    use Gps;
    protected $distance; //расстояние в км
    protected $kmCost; //стоимость одного км
    protected $ageMlt = 1; //возрастной коэффициент
    protected $time; //время использования авто в единицах (в каждом классе свои - минуты, часы, дни)
    protected $timeUnitCost; //стоимость единицы времени
    protected $servicesCost = 0; //стоимость доп. услуг

    public function __construct($distance, $time, $age, ...$services)
    {
        $this->distance = $distance;
        if ($age >= 18 && $age <= 21) $this->ageMlt = 1.1;
        elseif ($age < 18 || $age > 65) throw new Exception('Возраст должен быть в пределах 18-65 лет');

        if (in_array('gps', $services) && isset($this->gpsHourCost)) {
            $this->servicesCost += $this->gpsHourCost * ceil($time/60);
        }
        if (in_array('+driver', $services) && isset($this->driverCost)) {
            $this->servicesCost += 100;
        } elseif (in_array('+driver', $services) && !isset($this->driverCost)) {
            throw new Exception('Для данного тарифа не доступна опция "Дополнительный водитель"');
        }
    }
    public function getPrice()
    {
        return ($this->kmCost*$this->distance + $this->timeUnitCost*$this->time + $this->servicesCost)*$this->ageMlt;
    }
}
class BaseTariff extends Tariff
{
    public function __construct($distance, $time, $age, ...$services)
    {
        parent::__construct($distance, $time, $age, ...$services);
        $this->kmCost = 10;
        $this->time = $time;
        $this->timeUnitCost = 3;
    }
}
class HourlyTariff extends Tariff
{
    use AdditionalDriver;
    public function __construct($distance, $time, $age, ...$services)
    {
        parent::__construct($distance, $time, $age, $services);
        $this->kmCost = 0;
        $this->time = ceil($time/60);
        $this->timeUnitCost = 200;
    }
}
class DailyTariff extends Tariff
{
    use AdditionalDriver;
    public function __construct($distance, $time, $age, ...$services)
    {
        parent::__construct($distance, $time, $age, ...$services);
        $this->kmCost = 1;
        $days = $time/1440;
        $this->time = ($days > 1 && $time%1440 <= 30) ? $this->time = floor($days) : $this->time = ceil($days);
        $this->timeUnitCost = 1000;
    }
}
class StudentTariff extends Tariff
{
    public function __construct($distance, $time, $age, ...$services)
    {
        parent::__construct($distance, $time, $age, ...$services);
        $this->kmCost = 4;
        $this->time = $time;
        $this->timeUnitCost = 1;
        if ($age > 25) throw new Exception('Максимальный возраст водителя на этом тарифе 25 лет');
    }
}
echo (new StudentTariff(101, 120, 22, 'gps'))->getPrice().PHP_EOL;
echo (new DailyTariff(421, 2120, 25, 'gps', '+driver'))->getPrice().PHP_EOL;
