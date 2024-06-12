<?php
do
{
    // lege array
    $arr = array();
    
    // pak zes keer een random waarde en zet die in een array
    for($i = 0 ; $i < 6 ; $i++)
        $arr[] = rand(0, -10000);

  // er moeten minimaal twee verschillende getallen in de array aanwezig zijn.
  // zo niet begin dan weer van voor af aan
} while(count(array_unique($arr)) < 2);


// laat het resultaat zien:
foreach($arr as $num)
{
    $user_id = $num;
}
?>