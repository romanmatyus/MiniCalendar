MiniCalendar
============

Nette component for fast creating mini calendar.

Use in factory
--------------

    $control = new \NRomiix\MiniCalendar;
    $control->addDayOfTheWeek("Dnes je %s");
    $control->addDayFromCsv(" <i>(%s)</i>","public.sk.csv");
    $control->addDate(", %s","j.n.Y. ");
    $control->addDayFromCsv("Meniny má %s. ","name_day.sk.csv");
    $control->addDayFromCsv("Zajtra má meniny %s. ","name_day.sk.csv","+1 day");
    return $control;

Format of CSV files
-------------------

If is option year empty, option is ignored.
If is value different from the current year, file is ignored.
