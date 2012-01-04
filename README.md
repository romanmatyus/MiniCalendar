MiniCalendar
============

component for fast creating mini calendar

Use in factory
--------------

    $control = new \NRomiix\MiniCalendar;
    $control->addDayOfTheWeek("Dnes je %s");
    $control->addDate(", %s","j.n.Y. ");
    $control->addNameDay("Meniny má %s. ","sk");
    $control->addNameDay("Zajtra má meniny %s.","sk","+1 day");
    return $control;
