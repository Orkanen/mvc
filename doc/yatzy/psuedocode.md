function Game() {
    $round = 0;
    $rolls = 0;

    while ($round < 6) {
        while ($rolls < 4) {
            if ($rolls < 1) {
                $rolls += 1;
            } else if ($rolls < 4) {
                $rolls += Choice();
            }
        }
        $rolls = 0;
        $round += 1;
    }
}

function Choice($var) {
    $rolls = 1;
    if ($var == "hold") {
        rolls = 4;
    }
    return $rolls;
}
