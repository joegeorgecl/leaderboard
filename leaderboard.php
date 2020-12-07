<?php

/*
 * Complete the 'climbingLeaderboard' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY ranked
 *  2. INTEGER_ARRAY player
 */

function climbingLeaderboard($scores, $alice) {
    $result = [];
    $scores = array_unique($scores, SORT_NUMERIC);
    rsort($scores);
    $rank = count($scores)-1;

    foreach($alice as $v){
        while($rank >= 0){
            if($rank > count($scores)-1){
                $rank = count($scores)-1;
            }
            if($v >= $scores[$rank]){
                $rank--;
            } else {
                $rank = $rank+2;
                break;
            }
        }
        if($rank < 0){
            $rank = 1;
        }
        array_push($result, $rank);
    }
    return $result;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $scores_count);

fscanf($stdin, "%[^\n]", $scores_temp);

$scores = array_map('intval', preg_split('/ /', $scores_temp, -1, PREG_SPLIT_NO_EMPTY));

fscanf($stdin, "%d\n", $alice_count);

fscanf($stdin, "%[^\n]", $alice_temp);

$alice = array_map('intval', preg_split('/ /', $alice_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = climbingLeaderboard($scores, $alice);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);