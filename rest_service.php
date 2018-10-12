<?php

class KnapSacsk
{
    public function calc()
    {
        $buckets = array(
            '10' => 10,
            '5' => 5,
            '2' => 2,
            '1' => 1
        );
        $results = array();
        // $iteration нужна чтобы остановить цикл и заполнять только ОДИН бак
        $iteration = 0;
        do {
            $iteration++;
            // кол-во вариантов
            $counter = 0;

            // обьем резервуара рандомный (10;200)
            $tankSize = 0;
            if (!isset($_GET['tankSize'])) {
                echo "Ярік, бачок потік!"; // место под Ваш мем
            } else {
                $tankSize = (integer)$_GET['tankSize'];
            }
            // кол-во ведер для полного наполнения бака
            $bucket10Times = $tankSize / $buckets['10'];
            $bucket5Times = $tankSize / $buckets['5'];
            $bucket2Times = $tankSize / $buckets['2'];
            $bucket1Times = $tankSize / $buckets['1'];

            if ($tankSize == 0) {
                echo "Купите бак!";
            } elseif ($tankSize != 0) {
                // перебираем количество раз для каждого ведра
                for ($bucket10Times = 0; $bucket10Times <= $tankSize / $buckets['10']; $bucket10Times++) {
                    for ($bucket5Times = 0; $bucket5Times <= $tankSize / $buckets['5']; $bucket5Times++) {
                        for ($bucket2Times = 0; $bucket2Times <= $tankSize / $buckets['2']; $bucket2Times++) {
                            for ($bucket1Times = 0; $bucket1Times <= $tankSize / $buckets['1']; $bucket1Times++) {
                                //если объем резервуара равен сложению наших множителей, то засчитывается вариант
                                if ($tankSize == $buckets['10'] * $bucket10Times + $buckets['5'] * $bucket5Times
                                    + $buckets['2'] * $bucket2Times + $buckets['1'] * $bucket1Times) {
                                    // записываем все варианты
                                    $results[] = "Наливаем " . $bucket10Times . " по 10л. " . $bucket5Times . " по 5л. "
                                        . $bucket2Times . " по 2л. " . $bucket1Times . " по 1л.";
                                    $counter++;
                                }
                            }
                        }
                    }
                }
                // добавим значение всех возможных вариантов в начало массива
                $results[] = array_unshift($results, $counter);
            }
            $json = json_encode($results);
            return $json;
        } while ($iteration == 0);
    }
}

$init = new KnapSacsk();
echo $init->calc();